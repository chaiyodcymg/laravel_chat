<x-guest-layout>

</x-guest-layout>

@if (session('status'))
<div class="mb-4 font-medium text-sm text-green-600">
    {{ session('status') }}
</div>
@endif

<div class="min-h-screen flex flex-row sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">

    <div class="w-full sm:max-w-md flex flex-col justify-center items-start logobox">
        <img class="imglogo" src="{{asset('img/tomatoe.png')}}">
        <div class="namelogo">
            <h2> Toma Talk</h2>
        </div>
    </div>

    <div class="d-flex flex-column w-full sm:max-w-md">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="flex items-center justify-center">
                    <b>Login</b>
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>
                <x-jet-validation-errors class="mb-4 mt-2" />
                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <span class="ml-2 text-sm text-sky-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">

                    <button class="ml-4 btn btn-submit">
                        {{ __('Login') }}
                    </button>
                </div>
            </form>
        </div>
        <div class="card goregis mt-2 shadow-md ">
            <div class="card-body text-center">
                Don't have an account?<a href="{{ route('register') }}"> Register</a>
            </div>
        </div>
    </div>

</div>