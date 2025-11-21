<x-user-layout>
    <div class="max-w-6xl mx-auto p-6 md:p-8 lg:p-12">
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-neutral-900 dark:text-neutral-100 mb-4">
                Agendar Cita
            </h1>
            <p class="text-lg text-neutral-600 dark:text-neutral-400">
                Reserva tu cita con nuestros barberos profesionales
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Appointment Form -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-semibold text-neutral-900 dark:text-neutral-100 mb-6">
                    Nueva Cita
                </h2>
                <form id="citaForm" class="space-y-4">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Pon tu Nombre y Apellido
                        </label>
                        <input type="text" id="nombre" name="nombre" placeholder="Ej: Esteban Priego" class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label for="barbero" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Seleccionar Barbero
                        </label>
                        <select id="barbero" name="barbero" class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            <option value="">Selecciona un barbero</option>
                            <option value="1">Barbero 1</option>
                            <option value="2">Barbero 2</option>
                            <option value="3">Barbero 3</option>
                        </select>
                    </div>

                    <div>
                        <label for="fecha" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Fecha
                        </label>
                        <input type="date" id="fecha" name="fecha" class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label for="hora" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Hora
                        </label>
                        <input type="time" id="hora" name="hora" class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>

                    <div>
                        <label for="servicio" class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-2">
                            Servicio
                        </label>
                        <select id="servicio" name="servicio" class="w-full px-4 py-2 border border-neutral-300 dark:border-neutral-600 rounded-lg bg-white dark:bg-neutral-700 text-neutral-900 dark:text-neutral-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                            <option value="">Selecciona un servicio</option>
                            <option value="corte">Corte de Cabello</option>
                            <option value="barba">Arreglo de Barba</option>
                            <option value="combo">Corte + Barba</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                        Agendar Cita
                    </button>
                </form>
            </div>

            <!-- My Appointments -->
            <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-semibold text-neutral-900 dark:text-neutral-100 mb-6">
                    Mis Citas
                </h2>
                <div class="space-y-4">
                    <div class="border border-neutral-200 dark:border-neutral-700 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-semibold text-neutral-900 dark:text-neutral-100">Corte de Cabello</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">Barbero 1</p>
                            </div>
                            <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-200 rounded-full text-xs">Confirmada</span>
                        </div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                            <span class="font-medium">Fecha:</span> 15 de Enero, 2024
                        </p>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                            <span class="font-medium">Hora:</span> 10:00 AM
                        </p>
                    </div>

                    <div class="border border-neutral-200 dark:border-neutral-700 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-semibold text-neutral-900 dark:text-neutral-100">Corte + Barba</h3>
                                <p class="text-sm text-neutral-600 dark:text-neutral-400">Barbero 2</p>
                            </div>
                            <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-200 rounded-full text-xs">Pendiente</span>
                        </div>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                            <span class="font-medium">Fecha:</span> 20 de Enero, 2024
                        </p>
                        <p class="text-sm text-neutral-600 dark:text-neutral-400">
                            <span class="font-medium">Hora:</span> 2:00 PM
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        document.getElementById('citaForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            
            Swal.fire({
                title: "¡Cita Agendada!",
                text: "Tu cita ha sido agendada exitosamente",
                icon: "success",
                draggable: true,
                confirmButtonColor: '#f59e0b',
                confirmButtonText: 'Aceptar',
                buttonsStyling: true,
                customClass: {
                    confirmButton: 'swal2-confirm-amber'
                }
            }).then(() => {
                form.reset();
            });
        });
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

