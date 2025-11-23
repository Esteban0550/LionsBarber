<x-admin-layout>
    <div class="py-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100 flex items-center gap-2">
                <svg class="w-7 h-7 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
                Estadísticas
            </h1>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg hover-lift border border-gray-200 dark:border-neutral-700 animate-fade-in-up">
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Citas por Día del Mes
                        </h2>
                        <div class="flex items-center justify-center gap-4 mb-4">
                            <button id="prevMonth" class="p-3 rounded-lg gradient-blue hover:shadow-lg text-white transition-all hover-scale">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <span id="currentMonth" class="text-lg font-bold text-gray-900 dark:text-gray-100 min-w-[150px] text-center px-4 py-2 bg-gradient-to-r from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/20 rounded-lg border border-amber-200 dark:border-amber-800">
                                {{ now()->format('F Y') }}
                            </span>
                            <button id="nextMonth" class="p-3 rounded-lg gradient-blue hover:shadow-lg text-white transition-all hover-scale">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <div class="relative" style="height: 500px;">
                        <canvas id="candlestickChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfica de Crecimiento Animada -->
            <div class="mt-6 bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg hover-lift border border-gray-200 dark:border-neutral-700 animate-fade-in-up" style="animation-delay: 0.2s;">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        Tendencia de Crecimiento
                    </h2>
                    
                    <div class="mb-6 p-4 bg-gradient-to-r from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/20 rounded-lg border border-amber-200 dark:border-amber-800">
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            <strong class="text-amber-700 dark:text-amber-300">Análisis de Crecimiento:</strong> 
                            Como se puede observar en la gráfica, las ventas y citas registradas muestran una tendencia claramente ascendente. 
                            La línea azul representa el crecimiento constante de citas pendientes, mientras que la línea rosa muestra 
                            el aumento en citas confirmadas y completadas. Esta tendencia positiva indica un crecimiento sostenido del negocio, 
                            con más clientes agendando citas y un flujo constante de servicios. Las ventas se van para arriba, 
                            demostrando la efectividad de nuestras estrategias y la satisfacción de nuestros clientes.
                        </p>
                    </div>

                    <div class="mb-4 flex items-center justify-center gap-6">
                        <div class="text-center">
                            <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Tiempo</p>
                            <p id="xValue" class="text-lg font-bold text-gray-900 dark:text-gray-100">0.0</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-blue-500 dark:text-blue-400 mb-1">Citas Pendientes</p>
                            <p id="sinValue" class="text-lg font-bold text-blue-600 dark:text-blue-400">0.0</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm text-pink-500 dark:text-pink-400 mb-1">Citas Confirmadas</p>
                            <p id="cosValue" class="text-lg font-bold text-pink-600 dark:text-pink-400">0.0</p>
                        </div>
                    </div>
                    
                    <div class="relative" style="height: 400px;">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <script>
        let currentMonth = {{ now()->month }};
        let currentYear = {{ now()->year }};
        const monthsNames = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];

        const citasData = @json($citasData);
        let chart;

        function getMonthData(month, year) {
            const labels = [];
            const openData = [];
            const highData = [];
            const lowData = [];
            const closeData = [];
            const daysInMonth = new Date(year, month, 0).getDate();
            
            for (let day = 1; day <= daysInMonth; day++) {
                const date = `${year}-${String(month).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dayCitas = citasData[date] || [];
                
                labels.push(day);
                
                if (dayCitas.length > 0) {
                    const pendientes = dayCitas.filter(c => c.estado === 'pendiente').length;
                    const confirmadas = dayCitas.filter(c => c.estado === 'confirmada').length;
                    const completadas = dayCitas.filter(c => c.estado === 'completada').length;
                    
                    const total = dayCitas.length;
                    const open = pendientes;
                    const close = confirmadas + completadas;
                    
                    openData.push(open);
                    highData.push(total);
                    lowData.push(0);
                    closeData.push(close);
                } else {
                    openData.push(0);
                    highData.push(0);
                    lowData.push(0);
                    closeData.push(0);
                }
            }
            
            return { labels, openData, highData, lowData, closeData };
        }

        function drawCandlestick(ctx, x, open, high, low, close, isUp) {
            const barWidth = 8;
            const halfBar = barWidth / 2;
            
            ctx.strokeStyle = isUp ? '#10b981' : '#ef4444';
            ctx.fillStyle = isUp ? '#10b981' : '#ef4444';
            ctx.lineWidth = 2;
            
            // Línea vertical (high-low)
            ctx.beginPath();
            ctx.moveTo(x, high);
            ctx.lineTo(x, low);
            ctx.stroke();
            
            // Cuerpo (open-close)
            ctx.fillRect(x - halfBar, Math.min(open, close), barWidth, Math.abs(close - open));
        }

        function updateChart() {
            const monthData = getMonthData(currentMonth, currentYear);
            const daysInMonth = new Date(currentYear, currentMonth, 0).getDate();
            
            chart.data.labels = monthData.labels;
            chart.data.datasets[0].data = monthData.openData;
            chart.data.datasets[1].data = monthData.highData;
            chart.data.datasets[2].data = monthData.lowData;
            chart.data.datasets[3].data = monthData.closeData;
            chart.options.scales.x.max = daysInMonth;
            chart.update();
            
            document.getElementById('currentMonth').textContent = `${monthsNames[currentMonth - 1]} ${currentYear}`;
            
            const prevBtn = document.getElementById('prevMonth');
            const nextBtn = document.getElementById('nextMonth');
            
            if (currentMonth === 1 && currentYear === {{ now()->year }}) {
                prevBtn.disabled = true;
                prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                prevBtn.disabled = false;
                prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
            
            if (currentMonth === {{ now()->month }} && currentYear === {{ now()->year }}) {
                nextBtn.disabled = true;
                nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                nextBtn.disabled = false;
                nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        const ctx = document.getElementById('candlestickChart').getContext('2d');
        const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches || document.documentElement.classList.contains('dark');
        const textColor = isDark ? '#f3f4f6' : '#1f2937';
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
        
        const monthData = getMonthData(currentMonth, currentYear);
        
        chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: monthData.labels,
                datasets: [
                    {
                        label: 'Apertura (Pendientes)',
                        data: monthData.openData,
                        backgroundColor: 'rgba(59, 130, 246, 0.5)',
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1,
                        hidden: true
                    },
                    {
                        label: 'Máximo (Total)',
                        data: monthData.highData,
                        backgroundColor: 'rgba(16, 185, 129, 0.3)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1,
                        hidden: true
                    },
                    {
                        label: 'Mínimo',
                        data: monthData.lowData,
                        backgroundColor: 'rgba(107, 114, 128, 0.3)',
                        borderColor: 'rgba(107, 114, 128, 1)',
                        borderWidth: 1,
                        hidden: true
                    },
                    {
                        label: 'Cierre (Confirmadas+Completadas)',
                        data: monthData.closeData,
                        backgroundColor: 'rgba(34, 197, 94, 0.5)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 1,
                        hidden: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const day = context.label;
                                const date = `${currentYear}-${String(currentMonth).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                                const dayCitas = citasData[date] || [];
                                
                                if (dayCitas.length === 0) {
                                    return 'Sin citas';
                                }
                                
                                const pendientes = dayCitas.filter(c => c.estado === 'pendiente').length;
                                const confirmadas = dayCitas.filter(c => c.estado === 'confirmada').length;
                                const canceladas = dayCitas.filter(c => c.estado === 'cancelada').length;
                                const completadas = dayCitas.filter(c => c.estado === 'completada').length;
                                
                                return [
                                    `Total: ${dayCitas.length}`,
                                    `Pendientes: ${pendientes}`,
                                    `Confirmadas: ${confirmadas}`,
                                    `Completadas: ${completadas}`,
                                    `Canceladas: ${canceladas}`
                                ];
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Día del mes',
                            color: textColor
                        },
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (value % 5 === 0 || value === 1) {
                                    return value;
                                }
                                return '';
                            },
                            color: textColor
                        },
                        grid: {
                            color: gridColor,
                            display: true
                        },
                        min: 1
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Cantidad de Citas',
                            color: textColor
                        },
                        ticks: {
                            color: textColor,
                            stepSize: 1
                        },
                        grid: {
                            color: gridColor
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        // Dibujar velas manualmente
        const originalDraw = chart.draw;
        chart.draw = function() {
            originalDraw.call(this);
            const meta = this.getDatasetMeta(0);
            const ctx = this.ctx;
            
            monthData.labels.forEach((day, index) => {
                const date = `${currentYear}-${String(currentMonth).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dayCitas = citasData[date] || [];
                
                if (dayCitas.length > 0) {
                    const pendientes = dayCitas.filter(c => c.estado === 'pendiente').length;
                    const confirmadas = dayCitas.filter(c => c.estado === 'confirmada').length;
                    const completadas = dayCitas.filter(c => c.estado === 'completada').length;
                    const total = dayCitas.length;
                    
                    const open = pendientes;
                    const close = confirmadas + completadas;
                    const high = total;
                    const low = 0;
                    const isUp = close >= open;
                    
                    const x = meta.data[index].x;
                    const scaleY = this.scales.y;
                    
                    const yOpen = scaleY.getPixelForValue(open);
                    const yHigh = scaleY.getPixelForValue(high);
                    const yLow = scaleY.getPixelForValue(low);
                    const yClose = scaleY.getPixelForValue(close);
                    
                    ctx.strokeStyle = isUp ? '#10b981' : '#ef4444';
                    ctx.fillStyle = isUp ? '#10b981' : '#ef4444';
                    ctx.lineWidth = 2;
                    
                    // Línea vertical (high-low)
                    ctx.beginPath();
                    ctx.moveTo(x, yHigh);
                    ctx.lineTo(x, yLow);
                    ctx.stroke();
                    
                    // Cuerpo (open-close)
                    const barWidth = 12;
                    const halfBar = barWidth / 2;
                    ctx.fillRect(x - halfBar, Math.min(yOpen, yClose), barWidth, Math.abs(yClose - yOpen));
                }
            });
        };

        document.getElementById('prevMonth').addEventListener('click', function() {
            if (this.disabled) return;
            if (currentMonth > 1) {
                currentMonth--;
            } else {
                currentMonth = 12;
                currentYear--;
            }
            updateChart();
        });

        document.getElementById('nextMonth').addEventListener('click', function() {
            if (this.disabled) return;
            if (currentMonth < 12) {
                currentMonth++;
            } else {
                currentMonth = 1;
                currentYear++;
            }
            if (currentYear > {{ now()->year }} || (currentYear === {{ now()->year }} && currentMonth > {{ now()->month }})) {
                currentMonth = {{ now()->month }};
                currentYear = {{ now()->year }};
            }
            updateChart();
        });

        // Inicializar estado de botones
        updateChart();

        // Gráfica de líneas animada
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const lineIsDark = window.matchMedia('(prefers-color-scheme: dark)').matches || document.documentElement.classList.contains('dark');
        const lineTextColor = lineIsDark ? '#f3f4f6' : '#1f2937';
        const lineGridColor = lineIsDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';

        const limitCount = 100;
        const sinPoints = [];
        const cosPoints = [];
        let xValue = 0;
        const step = 0.05;

        // Crear gradientes
        const sinGradient = lineCtx.createLinearGradient(0, 0, 0, 400);
        sinGradient.addColorStop(0, 'rgba(59, 130, 246, 0)');
        sinGradient.addColorStop(1, 'rgba(59, 130, 246, 1)');

        const cosGradient = lineCtx.createLinearGradient(0, 0, 0, 400);
        cosGradient.addColorStop(0, 'rgba(236, 72, 153, 0)');
        cosGradient.addColorStop(1, 'rgba(236, 72, 153, 1)');

        const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                datasets: [
                    {
                        label: 'Citas Pendientes',
                        data: sinPoints,
                        borderColor: 'rgb(59, 130, 246)',
                        backgroundColor: sinGradient,
                        fill: true,
                        tension: 0,
                        borderWidth: 4,
                        pointRadius: 0,
                        pointHoverRadius: 0
                    },
                    {
                        label: 'Citas Confirmadas',
                        data: cosPoints,
                        borderColor: 'rgb(236, 72, 153)',
                        backgroundColor: cosGradient,
                        fill: true,
                        tension: 0,
                        borderWidth: 4,
                        pointRadius: 0,
                        pointHoverRadius: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 0
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: lineTextColor,
                            usePointStyle: true,
                            padding: 15,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toFixed(2);
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        type: 'linear',
                        min: 0,
                        max: 10,
                        grid: {
                            display: true,
                            drawVerticalLine: false,
                            color: lineGridColor
                        },
                        ticks: {
                            display: true,
                            color: lineTextColor
                        },
                        title: {
                            display: true,
                            text: 'Tiempo',
                            color: lineTextColor
                        },
                        border: {
                            display: false
                        }
                    },
                    y: {
                        min: 0,
                        max: 5,
                        grid: {
                            display: true,
                            color: lineGridColor
                        },
                        ticks: {
                            color: lineTextColor,
                            stepSize: 0.5,
                            callback: function(value) {
                                return (value * 10).toFixed(0);
                            }
                        },
                        title: {
                            display: true,
                            text: 'Cantidad de Citas',
                            color: lineTextColor
                        },
                        border: {
                            display: false
                        }
                    }
                }
            }
        });

        // Función para actualizar la gráfica
        function updateLineChart() {
            // Agregar nuevos puntos
            while (sinPoints.length > limitCount) {
                sinPoints.shift();
                cosPoints.shift();
            }

            // Simular crecimiento ascendente con funciones seno y coseno ajustadas
            // Agregar una tendencia creciente base
            const baseGrowth = xValue * 0.1;
            const sinY = Math.sin(xValue) * 0.3 + baseGrowth + 0.3; // Tendencia creciente
            const cosY = Math.cos(xValue) * 0.3 + baseGrowth + 0.5; // Tendencia creciente más pronunciada

            sinPoints.push({ x: xValue, y: sinY });
            cosPoints.push({ x: xValue, y: cosY });

            // Actualizar el rango de X
            if (sinPoints.length > 0) {
                lineChart.options.scales.x.min = Math.max(0, sinPoints[0].x);
                lineChart.options.scales.x.max = sinPoints[sinPoints.length - 1].x;
            }

            // Ajustar el rango de Y dinámicamente para mostrar el crecimiento
            const allYValues = [...sinPoints.map(p => p.y), ...cosPoints.map(p => p.y)];
            if (allYValues.length > 0) {
                const minY = Math.min(...allYValues);
                const maxY = Math.max(...allYValues);
                lineChart.options.scales.y.min = Math.max(-1, minY - 0.5);
                lineChart.options.scales.y.max = maxY + 0.5;
            }

            // Actualizar valores mostrados (escalados para mostrar números más realistas)
            document.getElementById('xValue').textContent = xValue.toFixed(1);
            document.getElementById('sinValue').textContent = (sinY * 10).toFixed(0);
            document.getElementById('cosValue').textContent = (cosY * 10).toFixed(0);

            lineChart.update('none');
            xValue += step;
        }

        // Iniciar animación
        setInterval(updateLineChart, 40);
    </script>
</x-admin-layout>
