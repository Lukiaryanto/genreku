<x-layout>
    <!-- Full-bleed background menembus container max-w-7xl -->
    <div class="relative w-screen left-1/2 -translate-x-1/2 -mt-6 -mb-6 flex min-h-[calc(100vh-64px)] items-center justify-center bg-cover bg-center bg-no-repeat px-4 py-12" style="background-image: url('{{ asset('images/bg-login.jpg') }}');">
        
        <!-- Overlay gelap agar form tetap terbaca -->
        <div class="absolute inset-0 bg-black/60 z-0"></div>

        <div class="relative z-10 w-full max-w-sm rounded-3xl border border-white/10 bg-white/5 backdrop-blur-2xl p-8 shadow-[0_8px_32px_0_rgba(0,0,0,0.5)] ring-1 ring-white/10">
            
            <!-- Logo FKOM & GenRe -->
            <div class="flex justify-center items-center gap-5 mb-6">
                <img src="{{ asset('images/logo-fkom.png') }}" alt="Logo FKOM" class="h-14 w-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('images/logo-genre.png') }}" alt="Logo GenRe" class="h-14 w-auto object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-300">
            </div>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-extrabold text-white tracking-tight">
                    Buat Akun
                </h2>
                <p class="text-gray-300 text-sm mt-2">Daftarkan diri Anda untuk bergabung</p>
            </div>

            <form action="{{ route('register.attempt') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Name Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1.5">Nama</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama Lengkap"
                            class="block w-full rounded-xl bg-white/5 border border-white/10 pl-10 px-4 py-3 text-white placeholder-gray-400 focus:border-indigo-400 focus:ring focus:ring-indigo-400/20 focus:bg-white/10 transition-all duration-300">
                    </div>
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-300 pl-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1.5">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="admin@example.com"
                            class="block w-full rounded-xl bg-white/5 border border-white/10 pl-10 px-4 py-3 text-white placeholder-gray-400 focus:border-indigo-400 focus:ring focus:ring-indigo-400/20 focus:bg-white/10 transition-all duration-300">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-sm text-red-300 pl-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required placeholder="••••••••"
                            class="block w-full rounded-xl bg-white/5 border border-white/10 pl-10 pr-12 py-3 text-white placeholder-gray-400 focus:border-indigo-400 focus:ring focus:ring-indigo-400/20 focus:bg-white/10 transition-all duration-300">

                        <button type="button" id="togglePassword" aria-label="Tampilkan/ Sembunyikan password"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors duration-200 p-1">
                            <svg id="iconEyeReg" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="iconEyeOffReg" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.965 9.965 0 012.223-3.371M6.1 6.1A9.966 9.966 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.67 5.163M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1.5 text-sm text-red-300 pl-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Confirmation Field -->
                <div>
                    <label class="block text-sm font-medium text-gray-200 mb-1.5">Konfirmasi Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••"
                            class="block w-full rounded-xl bg-white/5 border border-white/10 pl-10 pr-12 py-3 text-white placeholder-gray-400 focus:border-indigo-400 focus:ring focus:ring-indigo-400/20 focus:bg-white/10 transition-all duration-300">

                        <button type="button" id="togglePasswordConfirm" aria-label="Tampilkan/ Sembunyikan konfirmasi password"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white transition-colors duration-200 p-1">
                            <svg id="iconEyeRegConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="iconEyeOffRegConfirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.965 9.965 0 012.223-3.371M6.1 6.1A9.966 9.966 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.67 5.163M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit"
                        class="w-full rounded-xl bg-gradient-to-r from-indigo-500 to-purple-600 py-3.5 font-bold text-white shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:from-indigo-400 hover:to-purple-500 transform hover:-translate-y-0.5 transition-all duration-200">
                        Daftar Sekarang
                    </button>
                </div>

            </form>

            <p class="mt-6 text-center text-sm text-gray-300">
                Sudah punya akun?
                <a href="/login" class="text-white font-bold hover:text-indigo-300 hover:underline transition-all">
                    Masuk di sini
                </a>
            </p>

        </div>

    </div>
</x-layout>

<script>
    (function() {
        // Password field toggle
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        const iconEye = document.getElementById('iconEyeReg');
        const iconEyeOff = document.getElementById('iconEyeOffReg');

        if (toggle && password) {
            toggle.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                if (type === 'text') {
                    iconEye.classList.add('hidden');
                    iconEyeOff.classList.remove('hidden');
                } else {
                    iconEye.classList.remove('hidden');
                    iconEyeOff.classList.add('hidden');
                }
            });
        }

        // Password confirmation toggle
        const toggleConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirm = document.getElementById('password_confirmation');
        const iconEyeC = document.getElementById('iconEyeRegConfirm');
        const iconEyeOffC = document.getElementById('iconEyeOffRegConfirm');

        if (toggleConfirm && passwordConfirm) {
            toggleConfirm.addEventListener('click', function() {
                const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordConfirm.setAttribute('type', type);
                if (type === 'text') {
                    iconEyeC.classList.add('hidden');
                    iconEyeOffC.classList.remove('hidden');
                } else {
                    iconEyeC.classList.remove('hidden');
                    iconEyeOffC.classList.add('hidden');
                }
            });
        }
    })();
</script>
