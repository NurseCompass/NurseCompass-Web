<div x-data="{ chatOpen: false }" class="fixed bottom-6 right-6 z-50">
    
    <div x-show="chatOpen" style="display: none;" 
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-4"
         class="bg-white dark:bg-gray-800 shadow-2xl rounded-2xl w-80 sm:w-96 border border-gray-200 dark:border-gray-700 flex flex-col overflow-hidden mb-4 h-[500px]">
        
        <div class="bg-teal-600 text-white px-4 py-3 flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                <h3 class="font-bold text-sm">NurseCompass AI Assistant</h3>
            </div>
            <button @click="chatOpen = false" class="text-teal-100 hover:text-white transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <div id="bubble-chat-box" class="flex-1 p-4 overflow-y-auto bg-gray-50 dark:bg-gray-900 space-y-4">
            <div class="flex items-start">
                <div class="bg-teal-100 text-teal-900 dark:bg-teal-900/30 dark:text-teal-300 rounded-2xl rounded-tl-none p-3 max-w-[85%] text-sm shadow-sm border border-teal-200 dark:border-teal-800">
                    Hello! I'm your AI Study Assistant. What topic would you like to review today?
                </div>
            </div>
        </div>

        <div class="p-3 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <form id="bubble-chat-form" class="flex gap-2">
                <input type="text" id="bubble-user-input" class="flex-1 rounded-full border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600 px-4" placeholder="Ask a question..." required autocomplete="off">
                <button type="submit" id="bubble-send-btn" class="bg-teal-600 hover:bg-teal-700 text-white rounded-full p-2 w-10 h-10 flex items-center justify-center transition shadow-sm">
                    <svg class="w-4 h-4 transform rotate-90" fill="currentColor" viewBox="0 0 20 20"><path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"></path></svg>
                </button>
            </form>
        </div>
    </div>

    <button @click="chatOpen = !chatOpen" class="bg-teal-600 hover:bg-teal-700 text-white rounded-full p-4 shadow-lg focus:outline-none transition-transform transform hover:scale-110 flex items-center justify-center float-right relative">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
        <span class="absolute top-0 right-0 block h-3 w-3 rounded-full bg-red-500 ring-2 ring-white"></span>
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

        if(!message) return;

        // 1. Add User Message
        chatBox.innerHTML += `
            <div class="flex items-start justify-end mt-4">
                <div class="bg-gray-800 text-white dark:bg-gray-700 rounded-2xl rounded-tr-none p-3 max-w-[85%] text-sm shadow-sm">
                    ${message}
                </div>
            </div>`;
        
        inputField.value = '';
        chatBox.scrollTop = chatBox.scrollHeight;
        
        // Disable button while thinking
        sendBtn.disabled = true;
        sendBtn.classList.add('opacity-50', 'cursor-not-allowed');

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

            // 3. Add AI Reply
            chatBox.innerHTML += `
                <div class="flex items-start mt-4">
                    <div class="bg-teal-100 text-teal-900 dark:bg-teal-900/30 dark:text-teal-300 rounded-2xl rounded-tl-none p-3 max-w-[85%] text-sm shadow-sm border border-teal-200 dark:border-teal-800">
                        ${data.reply}
                    </div>
                </div>`;

        } catch (error) {
            chatBox.innerHTML += `
                <div class="flex items-start mt-4">
                    <div class="bg-red-100 text-red-900 rounded-2xl rounded-tl-none p-3 max-w-[85%] text-sm shadow-sm border border-red-200">
                        Connection Error. Please check if the AI server is running.
                    </div>
                </div>`;
        }

        chatBox.scrollTop = chatBox.scrollHeight;
        sendBtn.disabled = false;
        sendBtn.classList.remove('opacity-50', 'cursor-not-allowed');
    });
</script>