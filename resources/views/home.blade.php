<x-layout>

    {{-- Hero --}}
    <section class="relative bg-white overflow-hidden">

        {{-- Dekorasi lingkaran latar --}}
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[700px] h-[700px] rounded-full bg-blue-50 opacity-60 -translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 rounded-full bg-indigo-50 opacity-40 translate-x-1/2 translate-y-1/2 pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full bg-blue-50 opacity-40 -translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

        <div class="relative z-10 mx-auto max-w-3xl px-6 py-24 text-center flex flex-col items-center">

            {{-- Logo --}}
            <div class="mb-8 relative">
                <div class="absolute inset-0 rounded-full bg-blue-100 blur-2xl opacity-50 scale-110"></div>
                <img src="{{ asset('images/logo-genre.png') }}" alt="Logo Genre" class="relative w-28 md:w-36 h-auto drop-shadow-xl">
            </div>

            {{-- Badge --}}
            <span class="inline-flex items-center gap-2 mb-6 px-4 py-1.5 rounded-full bg-blue-50 border border-blue-200 text-xs font-bold text-blue-600 uppercase tracking-[0.12em]">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 inline-block"></span>
                Program Resmi
            </span>

            {{-- Heading --}}
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-[1.15] mb-6 tracking-tight">
                Forum <span class="text-blue-600">Generasi Berencana</span><br>
                <span class="text-gray-700">Kabupaten Kuningan</span>
            </h1>

            {{-- Garis dekoratif --}}
            <div class="flex items-center gap-3 mb-6">
                <div class="h-px w-12 bg-blue-200"></div>
                <div class="w-2 h-2 rounded-full bg-blue-400"></div>
                <div class="h-px w-12 bg-blue-200"></div>
            </div>

            {{-- Subtext --}}
            <p class="text-gray-500 max-w-2xl mx-auto mb-10 text-base sm:text-lg leading-relaxed">
                Forum Generasi Berencana Kabupaten Kuningan mengajak generasi muda untuk menjadi teladan dalam perencanaan
                kehidupan reproduksi, kesehatan, dan peran sosial. Bergabunglah untuk belajar, berbagi, dan menjadi
                agen perubahan di komunitas Anda.
            </p>

            {{-- CTA Button --}}
            <a href="/register"
                class="inline-flex items-center gap-2 rounded-xl bg-blue-600 hover:bg-blue-500 px-8 py-3.5 text-base font-bold text-white transition-all shadow-lg shadow-blue-200 hover:shadow-blue-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Daftar Sekarang
            </a>

        </div>
    </section>

    {{-- Divider --}}
    <div class="border-t border-gray-200"></div>

    {{-- Cards --}}
    <section class="bg-gray-50 text-gray-800">
        <div class="mx-auto max-w-6xl px-6 py-14">

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                {{-- Visi --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Visi</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Membentuk generasi yang cerdas, sehat, dan
                        bertanggung jawab melalui edukasi dan teladan.</p>
                </div>

                {{-- Misi --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Misi</h3>
                    <ul class="text-gray-600 text-sm leading-relaxed space-y-1.5">
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 w-1 h-1 rounded-full bg-blue-400 flex-shrink-0"></span>
                            Meningkatkan pengetahuan reproduksi dan kesehatan remaja.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 w-1 h-1 rounded-full bg-blue-400 flex-shrink-0"></span>
                            Mendorong partisipasi aktif di masyarakat.
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-1.5 w-1 h-1 rounded-full bg-blue-400 flex-shrink-0"></span>
                            Menjalin jejaring antar generasi muda.
                        </li>
                    </ul>
                </div>

                {{-- Program --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm hover:shadow-md transition">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Program</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Pelatihan, kampanye kesehatan, pendampingan
                        sebaya, dan lomba ide kreatif untuk solusi masalah remaja.</p>
                </div>

                {{-- Kenapa Bergabung --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 sm:col-span-2 lg:col-span-1 shadow-sm hover:shadow-md transition">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">Kenapa Bergabung?</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Menjadi duta membuka kesempatan pengembangan
                        diri, relasi, dan kontribusi nyata untuk komunitas. Materi praktis dan pengalaman lapangan
                        menunggu Anda.</p>
                </div>

                {{-- Testimoni --}}
                <div class="bg-white border border-gray-200 rounded-xl p-6 sm:col-span-1 lg:col-span-2 shadow-sm hover:shadow-md transition">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center mb-4">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-3">Testimoni</h3>
                    <blockquote class="relative pl-4 border-l-2 border-blue-400">
                        <p class="text-gray-600 text-sm leading-relaxed italic">
                            "Setelah ikut Duta Generasi Berencana, saya lebih percaya diri dan dapat membantu
                            teman-teman mengakses informasi sehat."
                        </p>
                        <footer class="mt-2 text-xs text-gray-500">— Fadli Lawahiz, Duta 2022</footer>
                    </blockquote>
                </div>

            </div>
        </div>
    </section>

    {{-- Divider --}}
    <div class="border-t border-gray-200"></div>

    {{-- CTA --}}
    <section class="bg-gray-50 text-gray-800">
        <div class="mx-auto max-w-4xl px-6 py-14 text-center">
            <h2 class="text-xl font-bold text-gray-900 mb-3">Ingin tahu lebih lanjut?</h2>
            <p class="text-gray-600 text-sm mb-8 max-w-xl mx-auto leading-relaxed">
                Hubungi panitia atau ikuti media sosial kami untuk informasi kegiatan dan pendaftaran.
            </p>
            <div class="flex items-center justify-center gap-3">
                <a href="https://www.instagram.com/genre.ku?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                    class="inline-flex items-center gap-2 rounded-lg border border-gray-300 hover:bg-gray-100 px-5 py-2.5 text-sm text-gray-600 hover:text-gray-900 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Kontak
                </a>
                <a href="/register"
                    class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 hover:bg-indigo-500 px-5 py-2.5 text-sm font-semibold text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>

</x-layout>
```