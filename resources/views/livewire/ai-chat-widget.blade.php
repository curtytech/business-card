<div class="fixed bottom-4 right-4 z-50 flex flex-col items-end">
    <!-- Chat Window -->
    <div
        x-data="{ scrollToEnd() { $refs.chatContainer.scrollTop = $refs.chatContainer.scrollHeight } }"
        x-init="$watch('$wire.messages', () => $nextTick(() => scrollToEnd()))"
        x-show="$wire.isOpen"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="mb-4 w-80 sm:w-96 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col"
        style="height: 500px; max-height: 80vh;"
    >
        <!-- Header -->
        <div class="bg-primary-600 p-4 flex justify-between items-center text-white">
            <h3 class="font-bold flex items-center gap-2">
                <x-filament::icon icon="heroicon-o-chat-bubble-left-right" class="w-5 h-5" />
                Assistente Business Card
            </h3>
            <button wire:click="toggleChat" class="text-white hover:text-gray-200">
                <x-filament::icon icon="heroicon-o-x-mark" class="w-5 h-5" />
            </button>
        </div>

        <!-- Messages Area -->
        <div x-ref="chatContainer" class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 dark:bg-gray-900">
            @foreach($messages as $msg)
                <div class="flex {{ $msg['role'] === 'user' ? 'justify-end' : 'justify-start' }}">
                    <div class="max-w-[85%] rounded-lg p-3 {{ $msg['role'] === 'user' ? 'bg-primary-600 text-white' : 'bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-gray-700 shadow-sm' }}">
                        <p class="text-sm whitespace-pre-wrap">{{ $msg['content'] }}</p>
                    </div>
                </div>
            @endforeach

            @if($isLoading)
                <div class="flex justify-start">
                    <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700 shadow-sm">
                        <div class="flex space-x-2">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce delay-100"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce delay-200"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
            <form wire:submit.prevent="sendMessage" class="flex gap-2">
                <input
                    wire:model="message"
                    type="text"
                    placeholder="Digite sua dúvida..."
                    class="flex-1 rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:border-primary-500 focus:ring-primary-500 text-sm"
                    {{ $isLoading ? 'disabled' : '' }}
                >
                <button
                    type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white p-2 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                    {{ $isLoading ? 'disabled' : '' }}
                >
                    <x-filament::icon icon="heroicon-o-paper-airplane" class="w-5 h-5" />
                </button>
            </form>
        </div>
    </div>

    <!-- Toggle Button -->
    <button
        wire:click="toggleChat"
        class="bg-primary-600 hover:bg-primary-700 text-white p-4 rounded-full shadow-lg transition-transform hover:scale-105 flex items-center justify-center"
    >
        @if($isOpen)
            <x-filament::icon icon="heroicon-o-chevron-down" class="w-6 h-6" />
        @else
            <x-filament::icon icon="heroicon-o-chat-bubble-left-ellipsis" class="w-6 h-6" />
        @endif
    </button>
</div>
