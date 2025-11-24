<x-user-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 md:p-8 lg:p-12">
        <div class="mb-6 sm:mb-8">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-neutral-900 dark:text-neutral-100 mb-3 sm:mb-4">
                Nuestros Barberos
            </h1>
            <p class="text-base sm:text-lg text-neutral-600 dark:text-neutral-400">
                Conoce a nuestro equipo de profesionales expertos en cortes y estilos
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <!-- Barber Card 1 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-4 sm:p-6 hover:shadow-xl transition-shadow">
                <div class="flex flex-col items-center text-center">
                    <div class="w-32 h-32 bg-neutral-200 dark:bg-neutral-700 rounded-full mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-16 h-16 text-neutral-400">
                            <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-neutral-900 dark:text-neutral-100 mb-2">Barbero 1</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-4">Especialista en cortes clásicos y modernos</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-200 rounded-full text-sm">Experto</span>
                    </div>
                </div>
            </div>

            <!-- Barber Card 2 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex flex-col items-center text-center">
                    <div class="w-32 h-32 bg-neutral-200 dark:bg-neutral-700 rounded-full mb-4 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/barber1.jpg') }}" alt="Barbero 2" class="w-full h-full object-cover rounded-full">
                    </div>
                    <h3 class="text-xl font-semibold text-neutral-900 dark:text-neutral-100 mb-2">Barbero 2</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-4">Especialista en estilos urbanos y tendencias</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-200 rounded-full text-sm">Experto</span>
                    </div>
                </div>
            </div>

            <!-- Barber Card 3 -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex flex-col items-center text-center">
                    <div class="w-32 h-32 bg-neutral-200 dark:bg-neutral-700 rounded-full mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-16 h-16 text-neutral-400">
                            <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-neutral-900 dark:text-neutral-100 mb-2">Barbero 3</h3>
                    <p class="text-neutral-600 dark:text-neutral-400 mb-4">Especialista en barbas y arreglo facial</p>
                    <div class="flex gap-2">
                        <span class="px-3 py-1 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-200 rounded-full text-sm">Experto</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>

