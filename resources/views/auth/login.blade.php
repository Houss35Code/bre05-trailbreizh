<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="auth-status-block" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="auth-form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="auth-form-group">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="auth-form-input"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="auth-form-group">
            <label for="remember_me" class="auth-checkbox-label">
                <input id="remember_me" type="checkbox" class="auth-checkbox" name="remember">
                <span class="auth-checkbox-text">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="auth-form-footer">
            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="auth-submit-btn">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>