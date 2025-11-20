<x-admin-layout>
    <div class="py-6">
        <div class="mb-6">
            <a href="{{ route('admin.users') }}" class="text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100 mb-2 inline-block">
                ← Volver a Usuarios
            </a>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Editar Usuario</h1>
        </div>
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-neutral-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <x-input-label for="role_id" :value="__('Rol')" />
                            <select id="role_id" name="role_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Seleccione un rol</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                        </div>

                        <!-- User Info -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm text-gray-600">
                                <strong>Registrado:</strong> {{ $user->created_at->format('d/m/Y H:i') }}
                            </p>
                            @if($user->updated_at != $user->created_at)
                                <p class="text-sm text-gray-600 mt-1">
                                    <strong>Última actualización:</strong> {{ $user->updated_at->format('d/m/Y H:i') }}
                                </p>
                            @endif
                            <p class="text-sm text-gray-600 mt-1">
                                <strong>Estado:</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->trashed() ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $user->trashed() ? 'Desactivado' : 'Activo' }}
                                </span>
                            </p>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('admin.users') }}" class="text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Guardar Cambios') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>

