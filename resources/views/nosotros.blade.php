<x-user-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 md:p-8 lg:p-12">
        <div class="mb-6 sm:mb-8">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-neutral-900 dark:text-neutral-100 mb-3 sm:mb-4">
                Sobre Nosotros
            </h1>
            <p class="text-base sm:text-lg text-neutral-600 dark:text-neutral-400">
                Conoce nuestra misión, visión y objetivos
            </p>
        </div>
    </div>
    
    <div class="scroll-stack-scroller" id="scroll-stack-container" style="height: calc(100vh - 200px); margin: 0; padding: 0;">
        <div class="scroll-stack-inner">
            <div class="scroll-stack-card">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-4 text-amber-500 px-4 sm:px-6">Misión</h2>
                <p class="text-base sm:text-lg leading-relaxed px-4 sm:px-6">
                    En LionsBarber, nuestra misión es proporcionar servicios de barbería de la más alta calidad, 
                    combinando técnicas tradicionales con estilos modernos. Nos comprometemos a crear una experiencia 
                    única para cada cliente, donde la atención personalizada, la excelencia en el servicio y la pasión 
                    por nuestro oficio se reflejen en cada corte. Buscamos no solo transformar el estilo de nuestros 
                    clientes, sino también fortalecer su confianza y autoestima, convirtiendo cada visita en un momento 
                    especial de cuidado personal.
                </p>
            </div>

            <div class="scroll-stack-card">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-4 text-amber-500 px-4 sm:px-6">Visión</h2>
                <p class="text-base sm:text-lg leading-relaxed px-4 sm:px-6">
                    Ser reconocidos como la barbería líder en la región, destacándonos por nuestra innovación constante, 
                    nuestro compromiso con la excelencia y nuestra capacidad para adaptarnos a las tendencias más actuales 
                    del mundo de la barbería. Aspiramos a crear un espacio donde la tradición y la modernidad se encuentren, 
                    donde cada cliente se sienta parte de nuestra familia y donde la calidad del servicio supere siempre 
                    las expectativas. Visualizamos un futuro donde LionsBarber sea sinónimo de estilo, calidad y confianza 
                    en el cuidado masculino.
                </p>
            </div>

            <div class="scroll-stack-card">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-3 sm:mb-4 text-amber-500 px-4 sm:px-6">Objetivo</h2>
                <p class="text-base sm:text-lg leading-relaxed px-4 sm:px-6">
                    Nuestro objetivo principal es ofrecer servicios de barbería excepcionales que satisfagan y superen 
                    las expectativas de nuestros clientes. Nos enfocamos en mantener los más altos estándares de calidad 
                    en cada servicio, desde cortes clásicos hasta los estilos más vanguardistas. Buscamos construir 
                    relaciones duraderas con nuestros clientes basadas en la confianza, el respeto y la excelencia en el 
                    servicio. Además, nos comprometemos a mantenernos actualizados con las últimas tendencias y técnicas 
                    de barbería, asegurando que cada visita a LionsBarber sea una experiencia memorable y satisfactoria.
                </p>
            </div>

            <div class="scroll-stack-end"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('scroll-stack-container');
            if (container && window.ScrollStack) {
                new window.ScrollStack(container, {
                    useWindowScroll: false,
                    itemDistance: 100,
                    itemScale: 0.03,
                    itemStackDistance: 30,
                    stackPosition: '20%',
                    scaleEndPosition: '10%',
                    baseScale: 0.85,
                    rotationAmount: 0,
                    blurAmount: 0
                });
            }
        });
    </script>
</x-user-layout>

