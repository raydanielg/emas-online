<x-guest-layout>
    <div class="min-h-screen relative overflow-hidden bg-gray-900">
        <div id="authBg" class="absolute inset-0 auth-bg"></div>
        <div class="absolute inset-0" style="background: rgba(0,0,0,0.55);"></div>

        <div class="relative min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl">
                    <div class="text-center">
                        <div class="inline-flex items-center justify-center p-3 bg-teal-800 rounded-xl shadow-lg mb-4">
                            <span class="text-white font-bold text-3xl tracking-tighter">
                                <span class="text-yellow-500">e</span>MaS
                            </span>
                        </div>
                        <h2 class="text-3xl font-extrabold text-gray-900">Reset Password</h2>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
                        </p>
                    </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="rounded-md shadow-sm">
                    <div>
                        <x-input-label for="email" :value="__('Email Address')" class="!text-slate-900 font-bold mb-1" />
                        <x-text-input id="email" class="auth-input appearance-none rounded-lg relative block w-full px-3 py-3 border placeholder-slate-400 text-slate-900 font-medium focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 focus:z-10 sm:text-sm" type="email" name="email" :value="old('email')" required autofocus placeholder="school@example.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-primary-button class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-teal-600 hover:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out shadow-md">
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('login') }}" class="text-sm font-bold text-teal-600 hover:text-teal-800 transition duration-150">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Login
                    </a>
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
                if (!bg) return;

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
            })();
        </script>
    </div>
</x-guest-layout>
