<x-user-layout>
    <div class="scroll-stack-scroller" id="scroll-stack-container" style="height: calc(100vh - 140px); margin: 0; padding: 0;">
        <div class="scroll-stack-inner">
            <div class="scroll-stack-card">
                <h2 class="text-4xl font-bold mb-4 text-amber-500">Misión</h2>
                <p class="text-lg leading-relaxed">
                    En LionsBarber, nuestra misión es proporcionar servicios de barbería de la más alta calidad, 
                    combinando técnicas tradicionales con estilos modernos. Nos comprometemos a crear una experiencia 
                    única para cada cliente, donde la atención personalizada, la excelencia en el servicio y la pasión 
                    por nuestro oficio se reflejen en cada corte. Buscamos no solo transformar el estilo de nuestros 
                    clientes, sino también fortalecer su confianza y autoestima, convirtiendo cada visita en un momento 
                    especial de cuidado personal.
                </p>
            </div>

            <div class="scroll-stack-card">
                <h2 class="text-4xl font-bold mb-4 text-amber-500">Visión</h2>
                <p class="text-lg leading-relaxed">
                    Ser reconocidos como la barbería líder en la región, destacándonos por nuestra innovación constante, 
                    nuestro compromiso con la excelencia y nuestra capacidad para adaptarnos a las tendencias más actuales 
                    del mundo de la barbería. Aspiramos a crear un espacio donde la tradición y la modernidad se encuentren, 
                    donde cada cliente se sienta parte de nuestra familia y donde la calidad del servicio supere siempre 
                    las expectativas. Visualizamos un futuro donde LionsBarber sea sinónimo de estilo, calidad y confianza 
                    en el cuidado masculino.
                </p>
            </div>

            <div class="scroll-stack-card">
                <h2 class="text-4xl font-bold mb-4 text-amber-500">Objetivo</h2>
                <p class="text-lg leading-relaxed">
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

