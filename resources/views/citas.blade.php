<x-user-layout>
    <div class="max-w-6xl mx-auto p-6 md:p-8 lg:p-12">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-neutral-900 dark:text-neutral-100 mb-4 animate-fade-in-up bg-gradient-to-r from-amber-600 to-amber-800 bg-clip-text text-transparent">
                Agendar Cita
            </h1>
            <p class="text-lg text-neutral-600 dark:text-neutral-400 animate-fade-in-up" style="animation-delay: 0.1s;">
                Reserva tu cita con nuestros barberos profesionales
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Formulario de Cita -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 hover-lift animate-fade-in-up border border-neutral-200 dark:border-neutral-700">
                <h2 class="text-2xl font-semibold text-neutral-900 dark:text-neutral-100 mb-6">
                    Nueva Cita
                </h2>
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-4 bg-gradient-to-r from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 border-2 border-red-400 dark:border-red-600 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg relative animate-fade-in-up shadow-lg" role="alert">
                        <div class="flex items-start gap-2">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="font-medium">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('citas.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Pon tu Nombre y Apellido <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', auth()->check() ? auth()->user()->name : '') }}" placeholder="Ej: Esteban Priego" required class="w-full px-4 py-2 border-2 border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 hover:border-amber-400">
                    </div>

                    <div>
                        <label for="barbero" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Seleccionar Barbero
                        </label>
                        <select id="barbero" name="barbero" class="w-full px-4 py-2 border-2 border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 hover:border-amber-400 cursor-pointer">
                            <option value="">Selecciona un barbero</option>
                            <option value="1" {{ old('barbero') == '1' ? 'selected' : '' }}>Barbero 1</option>
                            <option value="2" {{ old('barbero') == '2' ? 'selected' : '' }}>Barbero 2</option>
                            <option value="3" {{ old('barbero') == '3' ? 'selected' : '' }}>Barbero 3</option>
                        </select>
                    </div>

                    <div>
                        <label for="fecha" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Fecha <span class="text-red-500">*</span>
                        </label>
                        <input type="date" id="fecha" name="fecha" value="{{ old('fecha') }}" required class="w-full px-4 py-2 border-2 border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 hover:border-amber-400">
                    </div>

                    <div>
                        <label for="hora" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Hora <span class="text-red-500">*</span>
                        </label>
                        <input type="time" id="hora" name="hora" value="{{ old('hora') }}" required class="w-full px-4 py-2 border-2 border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 hover:border-amber-400">
                    </div>

                    <div>
                        <label for="servicio" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Servicio <span class="text-red-500">*</span>
                        </label>
                        <select id="servicio" name="servicio" required class="w-full px-4 py-2 border-2 border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-all duration-200 hover:border-amber-400 cursor-pointer">
                            <option value="">Selecciona un servicio</option>
                            <option value="corte" {{ old('servicio') == 'corte' ? 'selected' : '' }}>Corte de Cabello</option>
                            <option value="barba" {{ old('servicio') == 'barba' ? 'selected' : '' }}>Arreglo de Barba</option>
                            <option value="combo" {{ old('servicio') == 'combo' ? 'selected' : '' }}>Corte + Barba</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full gradient-amber hover:shadow-lg text-white font-semibold py-3 px-6 rounded-lg transition-all duration-300 hover-scale hover-glow transform glow-button relative overflow-hidden">
                        <span class="flex items-center justify-center gap-2 relative z-10">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Agendar Cita
                        </span>
                    </button>
                </form>
            </div>

            <!-- Mis Citas -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6 hover-lift animate-fade-in-up border border-neutral-200 dark:border-neutral-700" style="animation-delay: 0.2s;">
                <h2 class="text-2xl font-semibold text-neutral-900 dark:text-neutral-100 mb-6">
                    Citas Agendadas
                </h2>
                <div class="space-y-4">
                    @forelse($misCitas as $cita)
                        <div class="border-2 border-neutral-200 dark:border-neutral-700 rounded-lg p-4 hover-lift transition-all duration-300 bg-gradient-to-br from-white via-neutral-50 to-white dark:from-neutral-800 dark:via-neutral-750 dark:to-neutral-800 shadow-md hover:shadow-xl group">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg group-hover:scale-110 transition-transform">
                                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <h3 class="font-bold text-lg text-neutral-900 dark:text-neutral-100">{{ $cita->servicio_nombre }}</h3>
                                    </div>
                                    <div class="space-y-1 ml-12">
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span class="font-medium">Cliente:</span> {{ $cita->nombre }}
                                        </p>
                                        <p class="text-sm text-neutral-600 dark:text-neutral-400 flex items-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <span class="font-medium">Barbero:</span> {{ $cita->barbero ? $cita->barbero->name : 'Sin barbero asignado' }}
                                        </p>
                                    </div>
                                </div>
                                <span class="px-3 py-1.5 rounded-full text-xs font-bold shadow-sm
                                    @if($cita->estado === 'confirmada') bg-gradient-to-r from-green-100 to-green-200 dark:from-green-900/30 dark:to-green-800/30 text-green-800 dark:text-green-200
                                    @elseif($cita->estado === 'pendiente') bg-gradient-to-r from-yellow-100 to-yellow-200 dark:from-yellow-900/30 dark:to-yellow-800/30 text-yellow-800 dark:text-yellow-200
                                    @elseif($cita->estado === 'cancelada') bg-gradient-to-r from-red-100 to-red-200 dark:from-red-900/30 dark:to-red-800/30 text-red-800 dark:text-red-200
                                    @else bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-900/30 dark:to-blue-800/30 text-blue-800 dark:text-blue-200
                                    @endif">
                                    {{ ucfirst($cita->estado) }}
                                </span>
                            </div>
                            <div class="flex items-center gap-4 mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-700">
                                <p class="text-sm text-neutral-600 dark:text-neutral-400 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-medium">{{ $cita->fecha->format('d/m/Y') }}</span>
                                </p>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-medium">{{ date('H:i', strtotime($cita->hora)) }}</span>
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 text-neutral-500 dark:text-neutral-400">
                            <p>No hay citas agendadas.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Mostrar SweetAlert cuando hay un mensaje de éxito
        @if (session('success'))
            Swal.fire({
                title: "¡Cita Agendada!",
                text: "{{ session('success') }}",
                icon: "success",
                draggable: true,
                confirmButtonColor: '#f59e0b',
                confirmButtonText: 'Aceptar',
                buttonsStyling: true,
                customClass: {
                    confirmButton: 'swal2-confirm-amber'
                }
            });
        @endif

        // Interceptar el envío del formulario para validación antes de mostrar el alert
        document.querySelector('form[action="{{ route('citas.store') }}"]').addEventListener('submit', function(e) {
            // El formulario se enviará normalmente, el SweetAlert se mostrará después si hay éxito
            // Si hay errores, se mostrarán en el formulario
        });

        // Obtener horas ocupadas cuando se selecciona una fecha
        const fechaInput = document.getElementById('fecha');
        const horaInput = document.getElementById('hora');
        const barberoSelect = document.getElementById('barbero');
        let horasOcupadas = [];

        function cargarHorasOcupadas() {
            const fecha = fechaInput.value;
            
            if (!fecha) {
                horaInput.disabled = false;
                horaInput.title = '';
                return;
            }

            // Construir la URL (por ahora sin filtrar por barbero específico, 
            // se validará en el backend todas las citas de esa fecha)
            const url = '{{ route("citas.horas-ocupadas") }}?fecha=' + fecha;

            // Mostrar loading
            horaInput.disabled = true;
            horaInput.title = 'Cargando horas disponibles...';

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    horasOcupadas = data.horas_ocupadas || [];
                    actualizarHorasDisponibles();
                })
                .catch(error => {
                    console.error('Error al cargar horas ocupadas:', error);
                    horaInput.disabled = false;
                    horaInput.title = '';
                });
        }

        function actualizarHorasDisponibles() {
            const horaSeleccionada = horaInput.value;
            
            // Habilitar el input
            horaInput.disabled = false;
            horaInput.title = '';

            // Si hay horas ocupadas, validar la hora seleccionada
            if (horasOcupadas.length > 0) {
                if (horaSeleccionada && horasOcupadas.includes(horaSeleccionada)) {
                    horaInput.setCustomValidity('Esta hora ya está ocupada. Por favor, selecciona otra hora.');
                    horaInput.style.borderColor = '#ef4444';
                } else {
                    horaInput.setCustomValidity('');
                    horaInput.style.borderColor = '';
                }

                // Agregar mensaje informativo
                let mensajeDiv = document.getElementById('horas-ocupadas-mensaje');
                if (!mensajeDiv) {
                    mensajeDiv = document.createElement('div');
                    mensajeDiv.id = 'horas-ocupadas-mensaje';
                    mensajeDiv.className = 'mt-2 text-sm text-amber-600 dark:text-amber-400';
                    horaInput.parentElement.appendChild(mensajeDiv);
                }
                
                if (horasOcupadas.length > 0) {
                    mensajeDiv.textContent = `⚠️ ${horasOcupadas.length} hora(s) ocupada(s) en esta fecha: ${horasOcupadas.join(', ')}`;
                    mensajeDiv.style.display = 'block';
                } else {
                    mensajeDiv.style.display = 'none';
                }
            } else {
                horaInput.setCustomValidity('');
                horaInput.style.borderColor = '';
                const mensajeDiv = document.getElementById('horas-ocupadas-mensaje');
                if (mensajeDiv) {
                    mensajeDiv.style.display = 'none';
                }
            }
        }

        // Event listeners
        fechaInput.addEventListener('change', cargarHorasOcupadas);
        barberoSelect.addEventListener('change', function() {
            if (fechaInput.value) {
                cargarHorasOcupadas();
            }
        });
        horaInput.addEventListener('change', actualizarHorasDisponibles);

        // Cargar horas ocupadas si ya hay una fecha seleccionada
        if (fechaInput.value) {
            cargarHorasOcupadas();
        }
    </script>
    
    <style>
        .swal2-confirm-amber {
            background-color: #f59e0b !important;
            border-color: #f59e0b !important;
        }
        .swal2-confirm-amber:hover {
            background-color: #d97706 !important;
            border-color: #d97706 !important;
        }
    </style>
</x-user-layout>

