<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;
        /* IE and Edge */
        scrollbar-width: none;
        /* Firefox */
    }
</style>

<div x-data="{ chatOpen: false }" class="fixed bottom-6 right-6 z-50 font-sans">

    <!-- Chat Window -->
    <div x-show="chatOpen" style="display: none;"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
        class="bg-white shadow-2xl rounded-3xl w-80 sm:w-96 border-2 border-gray-200 flex flex-col overflow-hidden mb-4 h-[500px]">

        <!-- Header -->
        <div class="bg-[#B91C1C] text-white px-5 py-4 flex justify-between items-center shadow-md z-10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center overflow-hidden shadow-sm">
                    <img src="<?php echo e(asset('images/chs logo.webp')); ?>" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="font-bold text-sm tracking-wide">NurseCompass AI</h3>
                    <p class="text-[9px] text-[#FCD34D] uppercase tracking-wider font-bold">Study Assistant</p>
                </div>
            </div>
            <button @click="chatOpen = false" class="text-white hover:text-gray-200 transition rounded-full hover:bg-white/20 p-1.5 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Chat History Box -->
        <div id="bubble-chat-box" class="flex-1 p-5 overflow-y-auto bg-gray-50 space-y-5 no-scrollbar">
            <!-- Initial AI Welcome Message -->
            <div class="flex items-start gap-2">
                <div class="w-8 h-8 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center shrink-0 mt-1 shadow-sm overflow-hidden">
                    <img src="<?php echo e(asset('images/chs logo.webp')); ?>" alt="Logo" class="w-full h-full object-cover">
                </div>
                <div class="bg-white text-gray-700 rounded-3xl rounded-tl-sm px-4 py-3 max-w-[80%] text-sm shadow-sm border-2 border-gray-200 leading-relaxed font-medium">
                    Hello! I am your AI Study Assistant. What topic would you like to review today?
                </div>
            </div>
        </div>

        <!-- Input Form -->
        <div class="p-4 bg-white border-t-2 border-gray-100">
            <form id="bubble-chat-form" class="relative flex items-center">
                <input type="text" id="bubble-user-input" class="w-full rounded-full border-2 border-gray-200 shadow-sm focus:border-[#0F5132] focus:ring-0 text-sm pl-5 pr-12 py-3 outline-none transition text-gray-700 bg-white" placeholder="Type a question..." required autocomplete="off">
                <button type="submit" id="bubble-send-btn" class="absolute right-1.5 bg-[#0F5132] hover:bg-green-900 text-white rounded-full p-2 flex items-center justify-center transition shadow-sm focus:outline-none h-9 w-9">
                    <svg class="w-4 h-4 transform rotate-90 translate-x-[1px]" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Floating Action Button -->
    <button @click="chatOpen = !chatOpen" class="bg-white border-2 border-[#B91C1C] hover:bg-red-50 text-[#B91C1C] rounded-full p-4 shadow-xl focus:outline-none transition-transform transform hover:scale-105 flex items-center justify-center float-right relative">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
        </svg>
        <span class="absolute top-0 right-0 block h-3.5 w-3.5 rounded-full bg-[#B91C1C] ring-2 ring-white"></span>
    </button>
</div>

<script>
    document.getElementById('bubble-chat-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const inputField = document.getElementById('bubble-user-input');
        const message = inputField.value;
        const chatBox = document.getElementById('bubble-chat-box');
        const sendBtn = document.getElementById('bubble-send-btn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if (!message.trim()) return;

        // 1. Add User Message (White Bubble, Gray Border)
        chatBox.innerHTML += `
            <div class="flex items-start justify-end gap-2 mt-4">
                <div class="bg-white text-gray-700 rounded-3xl rounded-tr-sm border-2 border-gray-200 px-4 py-3 max-w-[80%] text-sm shadow-sm leading-relaxed font-medium break-words whitespace-pre-wrap">${message}</div>
            </div>`;

        inputField.value = '';
        chatBox.scrollTop = chatBox.scrollHeight;

        // Disable button while thinking
        sendBtn.disabled = true;
        sendBtn.classList.add('opacity-50', 'cursor-wait');

        // 2. Send to Laravel Backend
        try {
            const response = await fetch('/study-assistant/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: message
                })
            });

            const data = await response.json();

            // 3. Add AI Reply (White Bubble, Gray Border)
            chatBox.innerHTML += `
                <div class="flex items-start gap-2 mt-4">
                    <div class="w-8 h-8 rounded-full bg-white border-2 border-gray-200 flex items-center justify-center shrink-0 mt-1 shadow-sm">
                        <span class="text-[#B91C1C] font-extrabold text-[10px]">AI</span>
                    </div>
                    <div class="bg-white text-gray-700 rounded-3xl rounded-tl-sm px-4 py-3 max-w-[80%] text-sm shadow-sm border-2 border-gray-200 leading-relaxed font-medium break-words whitespace-pre-wrap">${data.reply}</div>
                </div>`;

        } catch (error) {
            // 4. Add Error Message
            chatBox.innerHTML += `
                <div class="flex items-start gap-2 mt-4">
                    <div class="w-8 h-8 rounded-full bg-white border-2 border-red-200 flex items-center justify-center shrink-0 mt-1 shadow-sm">
                        <span class="text-red-600 font-extrabold text-[10px]">!</span>
                    </div>
                    <div class="bg-red-50 text-red-700 rounded-3xl rounded-tl-sm px-4 py-3 max-w-[80%] text-sm shadow-sm border-2 border-red-200 font-bold leading-relaxed break-words whitespace-pre-wrap">Connection Error. Please check if the AI server is running.</div>
                </div>`;
        }

        chatBox.scrollTop = chatBox.scrollHeight;
        sendBtn.disabled = false;
        sendBtn.classList.remove('opacity-50', 'cursor-wait');
    });
</script><?php /**PATH /var/www/capstone/NurseCompass-Web/resources/views/components/chat-bubble.blade.php ENDPATH**/ ?>