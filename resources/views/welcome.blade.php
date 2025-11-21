<x-user-layout>
    <div class="max-w-6xl mx-auto p-6 md:p-8 lg:p-12">
        <!-- Text Typing Effect -->
        <div 
            x-data="{
                texts: ['Bienvenido a LionsBarber', 'Tu barbershop favorita', 'Nosotros el corte!', 'Tu el estilo!'],
                currentTextIndex: 0,
                displayedText: '',
                currentCharIndex: 0,
                isDeleting: false,
                typingSpeed: 75,
                pauseDuration: 1500,
                deletingSpeed: 30,
                showCursor: true,
                cursorCharacter: '|',
                cursorVisible: true,
                init() {
                    this.startTyping();
                    // Cursor blink animation
                    setInterval(() => {
                        this.cursorVisible = !this.cursorVisible;
                    }, 500);
                },
                startTyping() {
                    const type = () => {
                        const currentText = this.texts[this.currentTextIndex];
                        
                        if (!this.isDeleting) {
                            // Typing
                            if (this.currentCharIndex < currentText.length) {
                                this.displayedText = currentText.substring(0, this.currentCharIndex + 1);
                                this.currentCharIndex++;
                                setTimeout(type, this.typingSpeed);
                            } else {
                                // Finished typing, wait then start deleting
                                setTimeout(() => {
                                    this.isDeleting = true;
                                    type();
                                }, this.pauseDuration);
                            }
                        } else {
                            // Deleting
                            if (this.displayedText.length > 0) {
                                this.displayedText = this.displayedText.substring(0, this.displayedText.length - 1);
                                setTimeout(type, this.deletingSpeed);
                            } else {
                                // Finished deleting, move to next text
                                this.isDeleting = false;
                                this.currentTextIndex = (this.currentTextIndex + 1) % this.texts.length;
                                this.currentCharIndex = 0;
                                setTimeout(type, 100);
                            }
                        }
                    };
                    type();
                }
            }"
            class="text-center py-12 md:py-16 lg:py-20"
        >
            <h1 class="text-10xl md:text-6xl lg:text-7xl xl:text-8xl font-bold text-neutral-1000 dark:text-neutral-100 mb-4">
                <span class="inline-block">
                    <span x-text="displayedText"></span>
                    <span 
                        x-show="showCursor"
                        x-transition:enter="transition ease-in-out"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in-out"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        :class="cursorVisible ? 'opacity-100' : 'opacity-0'"
                        class="inline-block ml-1"
                    >
                        <span x-text="cursorCharacter"></span>
                                </span>
                            </span>
            </h1>
            <!-- Lion Logo -->
            <div class="flex justify-center mt-8 md:mt-12 lg:mt-16">
                <img src="{{ asset('images/pngggggggg12345 (1).png') }}" alt="LionsBarber Logo" class="max-w-xs md:max-w-sm lg:max-w-md xl:max-w-lg w-auto h-auto object-contain">
                </div>
        </div>
    </div>
</x-user-layout>
