<x-admin-layout>
    <div class="py-6">
        <div class="mb-6">
            <a href="{{ route('admin.citas') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 mb-2 inline-block">
                ← Volver a Citas
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Editar Cita</h1>
        </div>
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.citas.update', $cita) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nombre del Cliente <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $cita->nombre) }}" required
                                class="block mt-1 w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                            @error('nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Usuario (opcional) -->
                        <div class="mb-4">
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Usuario (Opcional)
                            </label>
                            <select id="user_id" name="user_id"
                                class="block mt-1 w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                                <option value="">Seleccione un usuario</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $cita->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Barbero -->
                        <div class="mb-4">
                            <label for="barbero_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Barbero
                            </label>
                            <select id="barbero_id" name="barbero_id"
                                class="block mt-1 w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                                <option value="">Seleccione un barbero</option>
                                @foreach($barberos as $barbero)
                                    <option value="{{ $barbero->id }}" {{ old('barbero_id', $cita->barbero_id) == $barbero->id ? 'selected' : '' }}>
                                        {{ $barbero->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('barbero_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fecha y Hora -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Fecha <span class="text-red-500">*</span>
                                </label>
                                <input type="date" id="fecha" name="fecha" value="{{ old('fecha', $cita->fecha->format('Y-m-d')) }}" required
                                    class="block mt-1 w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                                @error('fecha')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="hora" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Hora <span class="text-red-500">*</span>
                                </label>
                                <input type="time" id="hora" name="hora" value="{{ old('hora', $cita->hora) }}" required
                                    class="block mt-1 w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                                @error('hora')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Servicio -->
                        <div class="mb-4">
                            <label for="servicio" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Servicio <span class="text-red-500">*</span>
                            </label>
                            <select id="servicio" name="servicio" required
                                class="block mt-1 w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                                <option value="">Seleccione un servicio</option>
                                <option value="corte" {{ old('servicio', $cita->servicio) == 'corte' ? 'selected' : '' }}>Corte de Cabello</option>
                                <option value="barba" {{ old('servicio', $cita->servicio) == 'barba' ? 'selected' : '' }}>Arreglo de Barba</option>
                                <option value="combo" {{ old('servicio', $cita->servicio) == 'combo' ? 'selected' : '' }}>Corte + Barba</option>
                            </select>
                            @error('servicio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Estado <span class="text-red-500">*</span>
                            </label>
                            <select id="estado" name="estado" required
                                class="block mt-1 w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                                <option value="pendiente" {{ old('estado', $cita->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="confirmada" {{ old('estado', $cita->estado) == 'confirmada' ? 'selected' : '' }}>Confirmada</option>
                                <option value="cancelada" {{ old('estado', $cita->estado) == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                <option value="completada" {{ old('estado', $cita->estado) == 'completada' ? 'selected' : '' }}>Completada</option>
                            </select>
                            @error('estado')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Notas -->
                        <div class="mb-6">
                            <label for="notas" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Notas
                            </label>
                            <textarea id="notas" name="notas" rows="3"
                                class="block mt-1 w-full border-gray-300 dark:border-neutral-600 dark:bg-neutral-700 dark:text-white focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">{{ old('notas', $cita->notas) }}</textarea>
                            @error('notas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cita Info -->
                        <div class="mb-6 p-4 bg-gray-50 dark:bg-neutral-700 rounded-lg">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                <strong>Creada:</strong> {{ $cita->created_at->format('d/m/Y H:i') }}
                            </p>
                            @if($cita->updated_at != $cita->created_at)
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                    <strong>Última actualización:</strong> {{ $cita->updated_at->format('d/m/Y H:i') }}
                                </p>
                            @endif
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.citas') }}" class="inline-flex items-center px-4 py-2 bg-neutral-200 dark:bg-neutral-700 border border-transparent rounded-lg font-semibold text-sm text-neutral-700 dark:text-neutral-300 tracking-wide hover:bg-neutral-300 dark:hover:bg-neutral-600 focus:bg-neutral-300 dark:focus:bg-neutral-600 active:bg-neutral-400 dark:active:bg-neutral-500 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <x-primary-button>
                                Guardar Cambios
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

