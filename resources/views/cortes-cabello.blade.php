<x-user-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 md:p-8 lg:p-12">
        <!-- Header Section -->
        <div class="mb-8 sm:mb-12 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-3 sm:mb-4">
                Cortes de Cabello
            </h1>
            <p class="text-base sm:text-lg text-gray-300 dark:text-gray-400 max-w-2xl mx-auto px-4">
                Descubre nuestra colección de cortes de cabello profesionales. Cada estilo está diseñado para realzar tu personalidad y mantenerte a la vanguardia de las tendencias.
            </p>
        </div>

        <div id="magic-bento-container" style="max-width: 100%; width: 100%;">
            <!-- Haircut Style 1 -->
            <div class="magic-bento-card group" style="background-image: url('{{ asset('images/clasico.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="magic-bento-card__overlay"></div>
                <div class="magic-bento-card__header">
                    <div class="magic-bento-card__label">Clásico</div>
                </div>
                <div class="magic-bento-card__content">
                    <h2 class="magic-bento-card__title">Corte Clásico</h2>
                    <p class="magic-bento-card__description">Estilo tradicional y elegante, perfecto para cualquier ocasión</p>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="px-3 py-1 bg-amber-500/90 text-white text-sm font-semibold rounded-full">Popular</span>
                        <span class="text-white/90 text-sm">⭐ 4.8</span>
                    </div>
                </div>
            </div>

            <!-- Haircut Style 2 -->
            <div class="magic-bento-card group" style="background-image: url('{{ asset('images/cortemoderno.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="magic-bento-card__overlay"></div>
                <div class="magic-bento-card__header">
                    <div class="magic-bento-card__label">Moderno</div>
                </div>
                <div class="magic-bento-card__content">
                    <h2 class="magic-bento-card__title">Corte Moderno</h2>
                    <p class="magic-bento-card__description">Estilo contemporáneo con las últimas tendencias</p>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="px-3 py-1 bg-blue-500/90 text-white text-sm font-semibold rounded-full">Tendencia</span>
                        <span class="text-white/90 text-sm">⭐ 4.9</span>
                    </div>
                </div>
            </div>

            <!-- Haircut Style 3 -->
            <div class="magic-bento-card group" style="background-image: url('{{ asset('images/lowtaper.jpeg') }}'); background-size: cover; background-position: center top; background-repeat: no-repeat;">
                <div class="magic-bento-card__overlay"></div>
                <div class="magic-bento-card__header">
                    <div class="magic-bento-card__label">Low Taper</div>
                </div>
                <div class="magic-bento-card__content">
                    <h2 class="magic-bento-card__title">Low Taper</h2>
                    <p class="magic-bento-card__description">Degradado perfecto desde corto hasta largo</p>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="px-3 py-1 bg-purple-500/90 text-white text-sm font-semibold rounded-full">Premium</span>
                        <span class="text-white/90 text-sm">⭐ 5.0</span>
                    </div>
                </div>
            </div>

            <!-- Haircut Style 4 -->
            <div class="magic-bento-card group" style="background-image: url('{{ asset('images/corte1.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="magic-bento-card__overlay"></div>
                <div class="magic-bento-card__header">
                    <div class="magic-bento-card__label">Pompadour</div>
                </div>
                <div class="magic-bento-card__content">
                    <h2 class="magic-bento-card__title">Corte Pompadour</h2>
                    <p class="magic-bento-card__description">Estilo retro con volumen y elegancia</p>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="px-3 py-1 bg-amber-500/90 text-white text-sm font-semibold rounded-full">Clásico</span>
                        <span class="text-white/90 text-sm">⭐ 4.7</span>
                    </div>
                </div>
            </div>

            <!-- Haircut Style 5 -->
            <div class="magic-bento-card group" style="background-image: url('{{ asset('images/haircut.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="magic-bento-card__overlay"></div>
                <div class="magic-bento-card__header">
                    <div class="magic-bento-card__label">Undercut</div>
                </div>
                <div class="magic-bento-card__content">
                    <h2 class="magic-bento-card__title">Corte Undercut</h2>
                    <p class="magic-bento-card__description">Lados cortos con parte superior larga y texturizada</p>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="px-3 py-1 bg-green-500/90 text-white text-sm font-semibold rounded-full">Moderno</span>
                        <span class="text-white/90 text-sm">⭐ 4.6</span>
                    </div>
                </div>
            </div>

            <!-- Haircut Style 6 -->
            <div class="magic-bento-card group" style="background-image: url('{{ asset('images/texturizado.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
                <div class="magic-bento-card__overlay"></div>
                <div class="magic-bento-card__header">
                    <div class="magic-bento-card__label">Texturizado</div>
                </div>
                <div class="magic-bento-card__content">
                    <h2 class="magic-bento-card__title">Corte Texturizado</h2>
                    <p class="magic-bento-card__description">Corte con textura y movimiento natural</p>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="px-3 py-1 bg-indigo-500/90 text-white text-sm font-semibold rounded-full">Versátil</span>
                        <span class="text-white/90 text-sm">⭐ 4.8</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.initMagicBento) {
                    window.initMagicBento('#magic-bento-container', {
                        textAutoHide: true,
                        enableStars: false,
                        enableSpotlight: false,
                        enableBorderGlow: false,
                        enableTilt: false,
                        enableMagnetism: false,
                        clickEffect: false,
                        spotlightRadius: 300,
                        particleCount: 12,
                        glowColor: '132, 0, 255'
                    });
                }
            });
        </script>
    </div>
</x-user-layout>

