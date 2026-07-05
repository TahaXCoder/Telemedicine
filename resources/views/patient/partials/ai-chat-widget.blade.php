<!-- Floating AI Assistant Widget -->
<div class="fixed bottom-6 right-6 z-50 font-sans">
    
    <!-- Floating Action Button (FAB) -->
    <button id="ai-chat-fab" 
            class="w-16 h-16 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white shadow-2xl flex items-center justify-center focus:outline-none hover:scale-105 active:scale-95 transition-all duration-300 relative group">
        <!-- Pulse Effect Ring -->
        <span class="absolute inset-0 rounded-full bg-blue-500 opacity-40 animate-ping group-hover:animate-none"></span>
        
        <!-- Assistant Icon (Cute Cartoon Bot SVG) -->
        <svg viewBox="0 0 100 100" class="w-12 h-12 relative z-10 select-none animate-bounce" xmlns="http://www.w3.org/2000/svg">
            <path d="M 25 50 A 25 25 0 0 1 75 50" fill="none" stroke="#ffffff" stroke-width="5" stroke-linecap="round" opacity="0.8"/>
            <line x1="50" y1="23" x2="50" y2="13" stroke="#ffffff" stroke-width="3.5" stroke-linecap="round"/>
            <circle cx="50" cy="11" r="3.5" fill="#38bdf8"/>
            <path d="M 44 7 A 6 6 0 0 1 56 7" fill="none" stroke="#38bdf8" stroke-width="1.5" stroke-linecap="round" opacity="0.8"/>
            <rect x="25" y="30" width="50" height="46" rx="12" fill="#ffffff" stroke="#e2e8f0" stroke-width="1.5"/>
            <rect x="30" y="35" width="40" height="36" rx="8" fill="#e0f2fe"/>
            <rect x="32" y="37" width="36" height="32" rx="6" fill="none" stroke="#38bdf8" stroke-width="2"/>
            <path d="M 39 48 Q 43 44 47 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M 53 48 Q 57 44 61 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M 43 57 Q 50 64 57 57 Z" fill="#ef4444"/>
            <path d="M 43 57 Q 50 64 57 57" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
            <path d="M 46 57.5 Q 50 59.5 54 57.5" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
            <rect x="18" y="44" width="7" height="18" rx="3.5" fill="#ffffff"/>
            <rect x="75" y="44" width="7" height="18" rx="3.5" fill="#ffffff"/>
            <rect x="20" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
            <rect x="75" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
        </svg>

        <!-- Tooltip -->
        <span class="absolute right-20 bg-gray-900 text-white text-xs font-semibold px-3 py-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-350 whitespace-nowrap shadow-md pointer-events-none">
            💬 Chat with AI Medical Assistant
        </span>
    </button>

    <!-- Chat Window Container -->
    <div id="ai-chat-window" 
         class="absolute bottom-20 right-0 w-96 max-w-[calc(100vw-2rem)] h-[550px] max-h-[calc(100vh-8rem)] bg-white rounded-2xl shadow-2xl border border-gray-100 flex flex-col transition-all duration-300 transform scale-90 translate-y-10 opacity-0 pointer-events-none">
        
        <!-- Header -->
        <div class="p-4 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-t-2xl flex items-center justify-between text-white shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center relative">
                    <!-- Cute Cartoon Bot SVG -->
                    <svg viewBox="0 0 100 100" class="w-8 h-8 select-none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 25 50 A 25 25 0 0 1 75 50" fill="none" stroke="#ffffff" stroke-width="5" stroke-linecap="round" opacity="0.8"/>
                        <line x1="50" y1="23" x2="50" y2="13" stroke="#ffffff" stroke-width="3.5" stroke-linecap="round"/>
                        <circle cx="50" cy="11" r="3.5" fill="#38bdf8"/>
                        <path d="M 44 7 A 6 6 0 0 1 56 7" fill="none" stroke="#38bdf8" stroke-width="1.5" stroke-linecap="round" opacity="0.8"/>
                        <rect x="25" y="30" width="50" height="46" rx="12" fill="#ffffff" stroke="#e2e8f0" stroke-width="1.5"/>
                        <rect x="30" y="35" width="40" height="36" rx="8" fill="#e0f2fe"/>
                        <rect x="32" y="37" width="36" height="32" rx="6" fill="none" stroke="#38bdf8" stroke-width="2"/>
                        <path d="M 39 48 Q 43 44 47 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 53 48 Q 57 44 61 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 43 57 Q 50 64 57 57 Z" fill="#ef4444"/>
                        <path d="M 43 57 Q 50 64 57 57" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 46 57.5 Q 50 59.5 54 57.5" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
                        <rect x="18" y="44" width="7" height="18" rx="3.5" fill="#ffffff"/>
                        <rect x="75" y="44" width="7" height="18" rx="3.5" fill="#ffffff"/>
                        <rect x="20" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
                        <rect x="75" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
                    </svg>
                    <!-- Online Dot -->
                    <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full bg-green-400 ring-2 ring-blue-600"></span>
                </div>
                <div>
                    <h4 class="font-semibold text-sm">TeleMedicine Assistant</h4>
                    <p class="text-xs text-blue-100 flex items-center gap-1">
                        <span class="inline-block w-1.5 h-1.5 rounded-full bg-green-400"></span>
                        AI Consultation
                    </p>
                </div>
            </div>
            
            <!-- Close Button -->
            <button id="ai-chat-close" class="hover:bg-white/20 p-1.5 rounded-full transition-colors focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div id="ai-chat-messages" class="flex-1 p-4 overflow-y-auto space-y-4 bg-gray-50/50">
            <!-- Welcome message -->
            <div class="flex items-start gap-2.5 max-w-[85%]">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 100 100" class="w-6 h-6 select-none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 25 50 A 25 25 0 0 1 75 50" fill="none" stroke="#2563eb" stroke-width="5" stroke-linecap="round"/>
                        <line x1="50" y1="23" x2="50" y2="13" stroke="#2563eb" stroke-width="3.5" stroke-linecap="round"/>
                        <circle cx="50" cy="11" r="3.5" fill="#38bdf8"/>
                        <path d="M 44 7 A 6 6 0 0 1 56 7" fill="none" stroke="#38bdf8" stroke-width="1.5" stroke-linecap="round" opacity="0.8"/>
                        <rect x="25" y="30" width="50" height="46" rx="12" fill="#1e293b" stroke="#0f172a" stroke-width="1.5"/>
                        <rect x="30" y="35" width="40" height="36" rx="8" fill="#f0f9ff"/>
                        <rect x="32" y="37" width="36" height="32" rx="6" fill="none" stroke="#38bdf8" stroke-width="2"/>
                        <path d="M 39 48 Q 43 44 47 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 53 48 Q 57 44 61 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 43 57 Q 50 64 57 57 Z" fill="#ef4444"/>
                        <path d="M 43 57 Q 50 64 57 57" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 46 57.5 Q 50 59.5 54 57.5" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
                        <rect x="18" y="44" width="7" height="18" rx="3.5" fill="#1d4ed8"/>
                        <rect x="75" y="44" width="7" height="18" rx="3.5" fill="#1d4ed8"/>
                        <rect x="20" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
                        <rect x="75" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
                    </svg>
                </div>
                <div class="bg-white p-3 rounded-2xl rounded-tl-none border border-gray-100 text-sm text-gray-700 shadow-sm leading-relaxed">
                    Hello, <strong>{{ auth()->user()->name }}</strong>! I'm your TeleMedicine Assistant. 🩺<br><br>
                    I can recommend doctors based on your symptoms, look up details of your recent appointments, check your prescriptions, or help you navigate the app.<br><br>
                    <strong>What would you like help with today?</strong>
                </div>
            </div>
        </div>

        <!-- Suggestion Chips -->
        <div id="ai-chat-suggestions" class="px-4 py-2 border-t border-gray-100 bg-white flex flex-wrap gap-2">
            <button class="ai-suggestion-chip text-xs bg-blue-50 text-blue-700 hover:bg-blue-100 hover:text-blue-800 border border-blue-100 px-3 py-1.5 rounded-full transition-all">
                Suggest doctors by symptoms 🤒
            </button>
            <button class="ai-suggestion-chip text-xs bg-blue-50 text-blue-700 hover:bg-blue-100 hover:text-blue-800 border border-blue-100 px-3 py-1.5 rounded-full transition-all">
                Show my appointments 📅
            </button>
            <button class="ai-suggestion-chip text-xs bg-blue-50 text-blue-700 hover:bg-blue-100 hover:text-blue-800 border border-blue-100 px-3 py-1.5 rounded-full transition-all">
                Check my prescriptions 💊
            </button>
        </div>

        <!-- Typing Indicator (hidden by default) -->
        <div id="ai-chat-typing" class="px-4 py-2.5 bg-gray-50/50 hidden">
            <div class="flex items-center gap-2 max-w-[85%]">
                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                    <svg viewBox="0 0 100 100" class="w-6 h-6 select-none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M 25 50 A 25 25 0 0 1 75 50" fill="none" stroke="#2563eb" stroke-width="5" stroke-linecap="round"/>
                        <line x1="50" y1="23" x2="50" y2="13" stroke="#2563eb" stroke-width="3.5" stroke-linecap="round"/>
                        <circle cx="50" cy="11" r="3.5" fill="#38bdf8"/>
                        <path d="M 44 7 A 6 6 0 0 1 56 7" fill="none" stroke="#38bdf8" stroke-width="1.5" stroke-linecap="round" opacity="0.8"/>
                        <rect x="25" y="30" width="50" height="46" rx="12" fill="#1e293b" stroke="#0f172a" stroke-width="1.5"/>
                        <rect x="30" y="35" width="40" height="36" rx="8" fill="#f0f9ff"/>
                        <rect x="32" y="37" width="36" height="32" rx="6" fill="none" stroke="#38bdf8" stroke-width="2"/>
                        <path d="M 39 48 Q 43 44 47 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 53 48 Q 57 44 61 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 43 57 Q 50 64 57 57 Z" fill="#ef4444"/>
                        <path d="M 43 57 Q 50 64 57 57" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                        <path d="M 46 57.5 Q 50 59.5 54 57.5" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
                        <rect x="18" y="44" width="7" height="18" rx="3.5" fill="#1d4ed8"/>
                        <rect x="75" y="44" width="7" height="18" rx="3.5" fill="#1d4ed8"/>
                        <rect x="20" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
                        <rect x="75" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
                    </svg>
                </div>
                <div class="bg-white px-4 py-3 rounded-2xl rounded-tl-none border border-gray-100 text-sm text-gray-500 shadow-sm flex items-center gap-1">
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0ms"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 150ms"></span>
                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 300ms"></span>
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <form id="ai-chat-form" class="p-3 border-t border-gray-100 bg-white rounded-b-2xl flex items-center gap-2">
            <input type="text" 
                   id="ai-chat-input" 
                   placeholder="Type your symptoms or questions..." 
                   autocomplete="off"
                   maxlength="500"
                   class="flex-1 text-sm border-gray-200 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 px-3 py-2.5 transition-all">
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white p-2.5 rounded-xl transition-all shadow-md focus:outline-none flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        const $fab = $('#ai-chat-fab');
        const $window = $('#ai-chat-window');
        const $close = $('#ai-chat-close');
        const $form = $('#ai-chat-form');
        const $input = $('#ai-chat-input');
        const $messages = $('#ai-chat-messages');
        const $typing = $('#ai-chat-typing');
        const $suggestions = $('#ai-chat-suggestions');
        
        let chatHistory = []; // Tracks messages locally for context retention

        // Toggle chat window open/close
        $fab.on('click', function () {
            const isOpen = !$window.hasClass('pointer-events-none');
            if (isOpen) {
                closeChat();
            } else {
                openChat();
            }
        });

        $close.on('click', function (e) {
            e.stopPropagation();
            closeChat();
        });

        function openChat() {
            $window.removeClass('pointer-events-none opacity-0 scale-90 translate-y-10')
                    .addClass('pointer-events-auto opacity-100 scale-100 translate-y-0');
            $input.focus();
            scrollToBottom();
        }

        function closeChat() {
            $window.addClass('pointer-events-none opacity-0 scale-90 translate-y-10')
                    .removeClass('pointer-events-auto opacity-100 scale-100 translate-y-0');
        }

        // Auto-scroll to bottom of messages container
        function scrollToBottom() {
            $messages.animate({ scrollTop: $messages[0].scrollHeight }, 300);
        }

        // Markdown-like basic formatter for chat bubble styling
        function parseMarkdown(text) {
            let escaped = text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;");

            // Format lists: bullet lines starting with "-" or "*"
            escaped = escaped.replace(/(?:^|\r?\n)[-*]\s+(.+)/g, '<li class="ml-4 list-disc text-gray-700 my-1">$1</li>');

            // Format bold text **text**
            escaped = escaped.replace(/\*\*(.*?)\*\*/g, '<strong class="font-bold text-gray-900">$1</strong>');

            // Wrap contiguous list items in an outer <ul> to style properly if found
            if (escaped.includes('<li')) {
                // Quick wrap logic
                // Simple placeholder, let's keep it simple with <br> and <li>
            }

            // Replace remaining linebreaks with HTML linebreaks
            escaped = escaped.replace(/\n/g, '<br>');

            return escaped;
        }

        // Insert message bubble to chat body
        function appendMessage(role, content) {
            const isUser = role === 'user' || role === 'patient';
            
            const avatarHtml = isUser 
                ? `<div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0 font-bold text-xs">Me</div>`
                : `<div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center shrink-0 select-none">
                      <svg viewBox="0 0 100 100" class="w-6 h-6 select-none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M 25 50 A 25 25 0 0 1 75 50" fill="none" stroke="#2563eb" stroke-width="5" stroke-linecap="round"/>
                          <line x1="50" y1="23" x2="50" y2="13" stroke="#2563eb" stroke-width="3.5" stroke-linecap="round"/>
                          <circle cx="50" cy="11" r="3.5" fill="#38bdf8"/>
                          <path d="M 44 7 A 6 6 0 0 1 56 7" fill="none" stroke="#38bdf8" stroke-width="1.5" stroke-linecap="round" opacity="0.8"/>
                          <rect x="25" y="30" width="50" height="46" rx="12" fill="#1e293b" stroke="#0f172a" stroke-width="1.5"/>
                          <rect x="30" y="35" width="40" height="36" rx="8" fill="#f0f9ff"/>
                          <rect x="32" y="37" width="36" height="32" rx="6" fill="none" stroke="#38bdf8" stroke-width="2"/>
                          <path d="M 39 48 Q 43 44 47 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                          <path d="M 53 48 Q 57 44 61 48" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                          <path d="M 43 57 Q 50 64 57 57 Z" fill="#ef4444"/>
                          <path d="M 43 57 Q 50 64 57 57" fill="none" stroke="#1e293b" stroke-width="2.5" stroke-linecap="round"/>
                          <path d="M 46 57.5 Q 50 59.5 54 57.5" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round"/>
                          <rect x="18" y="44" width="7" height="18" rx="3.5" fill="#1d4ed8"/>
                          <rect x="75" y="44" width="7" height="18" rx="3.5" fill="#1d4ed8"/>
                          <rect x="20" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
                          <rect x="75" y="48" width="3" height="10" rx="1.5" fill="#38bdf8"/>
                      </svg>
                   </div>`;

            const parsedContent = parseMarkdown(content);
            
            const messageBubble = `
                <div class="flex items-start gap-2.5 ${isUser ? 'flex-row-reverse text-right ml-auto' : ''} max-w-[85%] animate-fade-in-up">
                    ${avatarHtml}
                    <div class="p-3 rounded-2xl border text-sm shadow-sm leading-relaxed ${
                        isUser 
                        ? 'bg-blue-600 text-white border-blue-500 rounded-tr-none text-left' 
                        : 'bg-white text-gray-700 border-gray-100 rounded-tl-none text-left'
                    }">
                        ${parsedContent}
                    </div>
                </div>
            `;
            
            $messages.append(messageBubble);
            scrollToBottom();
        }

        // Send chat message function
        function sendMessage(messageText) {
            if (!messageText.trim()) return;

            // Display user message bubble
            appendMessage('user', messageText);

            // Clear input box
            $input.val('');

            // Hide suggestion chips after interaction to keep clean space
            $suggestions.fadeOut(300);

            // Show typing indicator
            $typing.removeClass('hidden');
            scrollToBottom();

            // Perform API request
            $.ajax({
                url: '{{ route("patient.ai-chat") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    message: messageText,
                    history: chatHistory
                },
                success: function (response) {
                    $typing.addClass('hidden');
                    
                    if (response.reply) {
                        // Append Assistant bubble response
                        appendMessage('assistant', response.reply);

                        // Push into session history list to retain context in further exchanges
                        chatHistory.push({ role: 'user', content: messageText });
                        chatHistory.push({ role: 'assistant', content: response.reply });
                        
                        // Limit stored local memory to latest 10 messages to keep request payload compact
                        if (chatHistory.length > 20) {
                            chatHistory.splice(0, 2);
                        }
                    } else {
                        appendMessage('assistant', 'Sorry, I encountered an issue processing your request.');
                    }
                },
                error: function (xhr) {
                    $typing.addClass('hidden');
                    console.error(xhr);
                    
                    let errMessage = 'An unexpected error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.reply) {
                        errMessage = xhr.responseJSON.reply;
                    }
                    appendMessage('assistant', errMessage);
                }
            });
        }

        // Form Submit listener
        $form.on('submit', function (e) {
            e.preventDefault();
            const val = $input.val().trim();
            if (val) {
                sendMessage(val);
            }
        });

        // Suggestion Chip clicks
        $('.ai-suggestion-chip').on('click', function () {
            const query = $(this).text().trim();
            sendMessage(query);
        });
    });
</script>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.25s ease-out forwards;
    }
</style>
