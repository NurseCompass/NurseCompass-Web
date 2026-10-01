<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    /* Hide scrollbar for IE, Edge and Firefox */
    .no-scrollbar {
        -ms-overflow-style: none;  /* IE and Edge */
        scrollbar-width: none;  /* Firefox */
    }
</style>

<div x-data="{ chatOpen: false }" class="fixed bottom-6 right-6 z-50 font-sans">
    
    <!-- Chat Window -->
    <div x-show="chatOpen" style="display: none;" 
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
         class="bg-white shadow-2xl rounded-2xl w-80 sm:w-96 border border-slate-200 flex flex-col overflow-hidden mb-4 h-[500px]">
        
        <!-- Header -->
        <div class="bg-teal-600 text-white px-5 py-4 flex justify-between items-center shadow-md z-10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-white/20 flex items-center justify-center shadow-sm">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm tracking-wide">NurseCompass AI</h3>
                    <p class="text-[10px] text-teal-100 uppercase tracking-wider font-semibold">Study Assistant</p>
                </div>
            </div>
            <button @click="chatOpen = false" class="text-teal-100 hover:text-white transition rounded-full hover:bg-white/10 p-1.5 focus:outline-none">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Chat History Box (Added no-scrollbar class here) -->
        <div id="bubble-chat-box" class="flex-1 p-4 overflow-y-auto bg-slate-50 space-y-5 no-scrollbar">
            <!-- Initial AI Welcome Message -->
            <div class="flex items-end gap-2">
                <div class="w-7 h-7 rounded-full bg-teal-100 flex items-center justify-center shrink-0 mb-1 shadow-sm">
                    <span class="text-teal-700 font-bold text-[10px]">AI</span>
                </div>
                <div class="bg-white text-slate-700 rounded-2xl rounded-bl-none px-4 py-3 max-w-[80%] text-sm shadow-sm border border-slate-200/60 leading-relaxed">
                    Hello! I'm your AI Study Assistant. What topic would you like to review today?
                </div>
            </div>
        </div>

        <!-- Input Form -->
        <div class="p-3 bg-white border-t border-slate-100">
            <form id="bubble-chat-form" class="relative">
                <textarea id="bubble-user-input" rows="2" class="w-full rounded-xl border border-slate-300 shadow-sm focus:border-teal-500 focus:ring-2 focus:ring-teal-100 text-sm pl-4 pr-12 py-3 outline-none transition text-slate-700 bg-slate-50 focus:bg-white resize-none no-scrollbar" placeholder="Type your question..." required></textarea>
                <button type="submit" id="bubble-send-btn" class="absolute right-2 bottom-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-lg p-2 flex items-center justify-center transition shadow-sm focus:outline-none">
                    <svg class="w-5 h-5 transform rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Floating Action Button -->
    <button @click="chatOpen = !chatOpen" class="bg-teal-600 hover:bg-teal-700 text-white rounded-full p-4 shadow-xl shadow-teal-600/30 focus:outline-none transition-transform transform hover:scale-105 flex items-center justify-center float-right relative">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        <span class="absolute top-0 right-0 block h-3.5 w-3.5 rounded-full bg-rose-500 ring-2 ring-white shadow-sm"></span>
    </button>
</div>

<script>
    // Let users press Enter to submit, and Shift+Enter for a new line
    document.getElementById('bubble-user-input').addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            document.getElementById('bubble-send-btn').click();
        }
    });

    document.getElementById('bubble-chat-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const inputField = document.getElementById('bubble-user-input');
        const message = inputField.value;
        const chatBox = document.getElementById('bubble-chat-box');
        const sendBtn = document.getElementById('bubble-send-btn');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        if(!message.trim()) return;

        // 1. Add User Message (Teal Bubble) - Tags hugging the variable to prevent extra whitespace
        chatBox.innerHTML += `
            <div class="flex items-end justify-end gap-2 mt-4">
                <div class="bg-teal-600 text-white rounded-2xl rounded-br-none px-4 py-3 max-w-[80%] text-sm shadow-sm leading-relaxed break-words whitespace-pre-wrap">${message}</div>
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
                body: JSON.stringify({ message: message })
            });

            const data = await response.json();

            // 3. Add AI Reply (White Bubble) - Tags hugging the variable
            chatBox.innerHTML += `
                <div class="flex items-end gap-2 mt-4">
                    <div class="w-7 h-7 rounded-full bg-teal-100 flex items-center justify-center shrink-0 mb-1 shadow-sm">
                        <span class="text-teal-700 font-bold text-[10px]">AI</span>
                    </div>
                    <div class="bg-white text-slate-700 rounded-2xl rounded-bl-none px-4 py-3 max-w-[80%] text-sm shadow-sm border border-slate-200/60 leading-relaxed break-words whitespace-pre-wrap">${data.reply}</div>
                </div>`;

        } catch (error) {
            // 4. Add Error Message (Rose Bubble) - Tags hugging the text
            chatBox.innerHTML += `
                <div class="flex items-end gap-2 mt-4">
                    <div class="w-7 h-7 rounded-full bg-rose-100 flex items-center justify-center shrink-0 mb-1 shadow-sm">
                        <span class="text-rose-700 font-bold text-[10px]">!</span>
                    </div>
                    <div class="bg-rose-50 text-rose-800 rounded-2xl rounded-bl-none px-4 py-3 max-w-[80%] text-sm shadow-sm border border-rose-200 font-medium leading-relaxed break-words whitespace-pre-wrap">Connection Error. Please check if the AI server is running.</div>
                </div>`;
        }

        chatBox.scrollTop = chatBox.scrollHeight;
        sendBtn.disabled = false;
        sendBtn.classList.remove('opacity-50', 'cursor-wait');
    });
</script>