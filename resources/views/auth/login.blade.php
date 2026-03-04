<x-guest-layout>
    <div class="min-h-screen relative overflow-hidden bg-gray-900">
        <div id="authBg" class="absolute inset-0 auth-bg"></div>
        <div class="absolute inset-0" style="background: rgba(0,0,0,0.55);"></div>

        <div class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8 bg-white rounded-2xl shadow-2xl p-10">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center p-3 bg-teal-800 rounded-xl shadow-lg mb-4">
                            <span class="text-white font-bold text-3xl tracking-tighter">
                                <span class="text-yellow-500">e</span>MaS
                            </span>
                        </div>
                        <h2 class="text-3xl font-extrabold text-gray-900">Welcome Back</h2>
                        <p class="mt-2 text-sm text-gray-600">Please sign in to your account</p>
                    </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form id="loginForm" class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="!text-slate-900 font-bold mb-1" />
                        <x-text-input id="email" class="auth-input appearance-none rounded-lg relative block w-full px-3 py-3 border placeholder-slate-400 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 focus:z-10 sm:text-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="juma@gmail.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <x-input-label for="password" :value="__('Password')" class="!text-slate-900 font-bold" />
                            @if (Route::has('password.request'))
                                <a class="text-xs text-teal-600 hover:text-teal-800 font-bold" href="{{ route('password.request') }}">
                                    {{ __('Forgot password?') }}
                                </a>
                            @endif
                        </div>
                        <x-text-input id="password" class="auth-input appearance-none rounded-lg relative block w-full px-3 py-3 border placeholder-slate-400 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 focus:z-10 sm:text-sm"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-teal-600 focus:ring-teal-500 border-gray-300 rounded transition duration-150 ease-in-out">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        {{ __('Keep me logged in') }}
                    </label>
                </div>

                <div>
                    <x-primary-button id="loginSubmit" class="group relative w-full flex justify-center items-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-teal-600 hover:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out shadow-md">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-lock text-teal-500 group-hover:text-teal-400 transition ease-in-out duration-150"></i>
                        </span>
                        <span id="loginBtnText">{{ __('Sign In') }}</span>
                        <span id="loginSpinner" class="hidden ml-2">
                            <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                            </svg>
                        </span>
                    </x-primary-button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-bold text-teal-600 hover:text-teal-800 transition duration-150">
                            Register School
                        </a>
                    </p>
                </div>
                    </form>
                </div>
        </div>

        <style>
            .auth-input {
                background-color: #f8fafc;
                border-color: #cbd5e1;
                color: #0f172a;
            }
            .auth-input::placeholder {
                color: #94a3b8;
                opacity: 1;
            }
            input.auth-input:-webkit-autofill,
            input.auth-input:-webkit-autofill:hover,
            input.auth-input:-webkit-autofill:focus {
                -webkit-text-fill-color: #0f172a;
                transition: background-color 9999s ease-out 0s;
                box-shadow: 0 0 0px 1000px #f8fafc inset;
            }
            .auth-bg {
                background-size: cover;
                background-position: center;
                filter: blur(5px);
                transform: scale(1.08);
            }
        </style>

        <script>
            (function () {
                var bg = document.getElementById('authBg');
                if (bg) {
                    var images = [
                        "{{ asset('PXL_20250502_075432413.RAW-01.COVER.jpg') }}",
                        "{{ asset('PXL_20250502_075446082.RAW-01.COVER.jpg') }}"
                    ];
                    var now = new Date();
                    var start = new Date(now.getFullYear(), 0, 0);
                    var diff = now - start;
                    var oneDay = 1000 * 60 * 60 * 24;
                    var dayOfYear = Math.floor(diff / oneDay);
                    var index = dayOfYear % images.length;
                    bg.style.backgroundImage = "url('" + images[index] + "')";
                }

                var form = document.getElementById('loginForm');
                var btn = document.getElementById('loginSubmit');
                var text = document.getElementById('loginBtnText');
                var spinner = document.getElementById('loginSpinner');
                if (!form || !btn || !text || !spinner) return;

                form.addEventListener('submit', function () {
                    btn.setAttribute('disabled', 'disabled');
                    btn.classList.add('opacity-80', 'cursor-not-allowed');
                    spinner.classList.remove('hidden');
                    text.textContent = 'Signing in...';
                });
            })();
        </script>
    </div>
</x-guest-layout>
