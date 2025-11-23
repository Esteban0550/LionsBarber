<x-user-layout>
    <div class="max-w-7xl mx-auto p-6 md:p-8 lg:p-12">
        <!-- Hero Section -->
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
                    setInterval(() => {
                        this.cursorVisible = !this.cursorVisible;
                    }, 500);
                },
                startTyping() {
                    const type = () => {
                        const currentText = this.texts[this.currentTextIndex];
                        if (!this.isDeleting) {
                            if (this.currentCharIndex < currentText.length) {
                                this.displayedText = currentText.substring(0, this.currentCharIndex + 1);
                                this.currentCharIndex++;
                                setTimeout(type, this.typingSpeed);
                            } else {
                                setTimeout(() => {
                                    this.isDeleting = true;
                                    type();
                                }, this.pauseDuration);
                            }
                        } else {
                            if (this.displayedText.length > 0) {
                                this.displayedText = this.displayedText.substring(0, this.displayedText.length - 1);
                                setTimeout(type, this.deletingSpeed);
                            } else {
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
            class="text-center py-8 md:py-12 lg:py-16"
        >
            <h1 class="text-5xl md:text-6xl lg:text-7xl xl:text-8xl font-bold text-neutral-900 dark:text-neutral-100 mb-6">
                <span class="inline-block">
                    <span x-text="displayedText"></span>
                    <span 
                        x-show="showCursor"
                        :class="cursorVisible ? 'opacity-100' : 'opacity-0'"
                        class="inline-block ml-1 transition-opacity"
                    >
                        <span x-text="cursorCharacter"></span>
                    </span>
                </span>
            </h1>
            <div class="flex justify-center mt-6 md:mt-8">
                <img src="{{ asset('images/pngggggggg12345 (1).png') }}" alt="LionsBarber Logo" class="max-w-xs md:max-w-sm lg:max-w-md w-auto h-auto object-contain">
            </div>
        </div>

        <!-- Quick Actions Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">
            <!-- Agendar Cita Card -->
            <a href="{{ route('citas') }}" class="group bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 border border-neutral-200 dark:border-neutral-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2">
                        <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Agendar Cita</h3>
                </div>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Reserva tu cita con nuestros barberos profesionales</p>
            </a>

            <!-- Ver Barberos Card -->
            <a href="{{ route('barberos') }}" class="group bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 border border-neutral-200 dark:border-neutral-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2">
                        <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Nuestros Barberos</h3>
                </div>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Conoce a nuestro equipo de expertos</p>
            </a>

            <!-- Ver Servicios Card -->
            <a href="{{ route('cortes-cabello') }}" class="group bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 border border-neutral-200 dark:border-neutral-700 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2">
                        <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Nuestros Servicios</h3>
                </div>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Descubre todos nuestros cortes y estilos</p>
            </a>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 border border-neutral-200 dark:border-neutral-700">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2">
                        <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Horarios</h3>
                </div>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Lun - Sáb: 9:00 AM - 8:00 PM</p>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Domingo: 10:00 AM - 6:00 PM</p>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 border border-neutral-200 dark:border-neutral-700">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2">
                        <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Contacto</h3>
                </div>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Tel: (123) 456-7890</p>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Email: info@lionsbarber.com</p>
            </div>

            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 border border-neutral-200 dark:border-neutral-700">
                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-amber-100 dark:bg-amber-900/30 rounded-lg p-2">
                        <svg class="h-6 w-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Ubicación</h3>
                </div>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Calle Principal 123</p>
                <p class="text-sm text-neutral-600 dark:text-neutral-400">Ciudad, País</p>
            </div>
        </div>
    </div>
</x-user-layout>
