<section>
    <header>
        <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form id="profile-form" method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-neutral-800 dark:text-neutral-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-neutral-600 dark:text-neutral-400 hover:text-neutral-900 dark:hover:text-neutral-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 dark:focus:ring-offset-neutral-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>

            <p
                id="save-message"
                class="text-sm text-green-600 dark:text-green-400"
                style="display: none; transition: opacity 0.3s ease;"
            >{{ __('Saved.') }}</p>
        </div>
    </form>

    <script>
        document.getElementById('profile-form').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const saveMessage = document.getElementById('save-message');
            const submitButton = form.querySelector('button[type="submit"]');
            const originalButtonText = submitButton.textContent;
            
            // Deshabilitar el botón mientras se procesa
            submitButton.disabled = true;
            submitButton.textContent = 'Guardando...';
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                // Si no es JSON, puede ser un redirect, recargar la página
                throw new Error('Response not ok');
            })
            .then(data => {
                if (data.success || data.message) {
                    // Obtener el nuevo nombre del formulario
                    const newName = document.getElementById('name').value;
                    
                    // Actualizar el nombre en el sidebar del admin
                    const sidebarNameElements = document.querySelectorAll('[data-sidebar-name]');
                    sidebarNameElements.forEach(el => {
                        if (el) el.textContent = newName;
                    });
                    
                    // Actualizar el nombre en el dropdown de navegación
                    const navNameElements = document.querySelectorAll('[data-nav-name]');
                    navNameElements.forEach(el => {
                        if (el) el.textContent = newName;
                    });
                    
                    // Actualizar la inicial en el avatar del sidebar
                    const sidebarInitial = document.querySelector('[data-sidebar-initial]');
                    if (sidebarInitial && newName.length > 0) {
                        sidebarInitial.textContent = newName.charAt(0).toUpperCase();
                    }
                    
                    // Mostrar mensaje de éxito
                    saveMessage.style.display = 'block';
                    saveMessage.style.opacity = '1';
                    
                    setTimeout(() => {
                        saveMessage.style.opacity = '0';
                        setTimeout(() => {
                            saveMessage.style.display = 'none';
                        }, 300);
                    }, 2000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Si hay error, recargar la página para mostrar los errores
                form.submit();
            })
            .finally(() => {
                // Restaurar el botón
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            });
        });
    </script>
</section>
