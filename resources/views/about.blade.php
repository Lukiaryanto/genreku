<x-layout>
    <section class="max-w-6xl mx-auto px-6 py-12">
        <div class="grid md:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-block mb-3 px-3 py-1 rounded-full bg-indigo-100 text-xs font-semibold text-indigo-700 uppercase tracking-widest">
                    Tentang Kami
                </span>
                <h1 class="text-3xl md:text-4xl font-extrabold mb-5 text-gray-900 leading-tight">Mengenal Forum Generasi Berencana (GenRe)</h1>
                <p class="text-gray-600 mb-6 leading-relaxed">
                    Forum Generasi Berencana (GenRe) Kabupaten Kuningan adalah wadah kreativitas dan edukasi bagi remaja. Kami hadir untuk merespon permasalahan remaja saat ini dengan memberikan edukasi seputar pendewasaan usia perkawinan, kesehatan reproduksi, dan persiapan kehidupan berkeluarga.
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    <div class="bg-white shadow-sm rounded-xl p-5 border border-gray-100 hover:border-indigo-200 transition">
                        <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-1">Kesehatan Reproduksi</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Edukasi pentingnya menjaga kesehatan reproduksi sejak dini bagi remaja.</p>
                    </div>
                    <div class="bg-white shadow-sm rounded-xl p-5 border border-gray-100 hover:border-indigo-200 transition">
                        <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-1">Life Skills</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Pengembangan karakter dan keterampilan hidup agar remaja menjadi lebih tangguh.</p>
                    </div>
                    <div class="bg-white shadow-sm rounded-xl p-5 border border-gray-100 hover:border-indigo-200 transition">
                        <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-1">Perencanaan Keluarga</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Edukasi Pendewasaan Usia Perkawinan (PUP) untuk masa depan yang lebih baik.</p>
                    </div>
                    <div class="bg-white shadow-sm rounded-xl p-5 border border-gray-100 hover:border-indigo-200 transition">
                        <div class="w-10 h-10 rounded-lg bg-indigo-50 flex items-center justify-center mb-3">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                        </div>
                        <h3 class="font-bold text-gray-800 mb-1">Jejaring Remaja</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">Membangun komunitas remaja yang positif dan suportif di Kabupaten Kuningan.</p>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="{{ url('/') }}"
                        class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-lg shadow-sm font-semibold hover:bg-indigo-700 transition">
                        Kembali ke Beranda
                    </a>
                    <a href="https://www.instagram.com/genre.ku?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                        class="inline-flex items-center gap-2 border border-gray-200 px-5 py-2.5 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition">
                        Hubungi Kami
                    </a>
                </div>
            </div>

            <div class="flex justify-center relative">
                <div class="absolute inset-0 bg-indigo-100 rounded-full blur-3xl opacity-50"></div>
                <div class="w-full max-w-lg relative z-10">
                    <img src="{{ asset('images/logo-genre.png') }}" alt="Logo GenRe Kabupaten Kuningan" class="w-full h-auto drop-shadow-2xl">
                </div>
            </div>
        </div>

        <hr class="my-16 border-gray-100" />

        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-block mb-3 px-3 py-1 rounded-full bg-blue-100 text-xs font-semibold text-blue-700 uppercase tracking-widest">
                Tujuan Kami
            </span>
            <h2 class="text-3xl font-extrabold mb-4 text-gray-900">Mencetak Remaja Tangguh & Berencana</h2>
            <p class="text-gray-600 leading-relaxed text-lg">
                Melalui Pemilihan Duta Generasi Berencana, kami mencari role model dari kalangan remaja yang dapat menjadi figur inspiratif, motivator, dan pendidik sebaya (peer educator) yang baik bagi teman sebayanya maupun masyarakat luas.
            </p>
        </div>
    </section>

</x-layout>
