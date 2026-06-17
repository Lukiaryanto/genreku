<x-peserta-layout active="soal">
    <x-slot name="header">{{ $title ?? 'Ujian' }}</x-slot>

    <div class="py-10 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row gap-6 lg:gap-10">
            
            {{-- Main Content: Questions --}}
            <div class="flex-1">
                <form id="exam-form" action="{{ route('peserta.soal.submit') }}" method="POST">
                    @csrf

                    @foreach ($questions as $index => $q)
                        <div class="question-step hidden space-y-6" data-index="{{ $index }}">
                            
                            {{-- Header Question --}}
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-1 rounded-full bg-indigo-500"></div>
                                    <h2 class="text-xl font-bold text-gray-800 tracking-tight">Soal Nomor {{ $index + 1 }}</h2>
                                </div>
                                <div class="px-4 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-[10px] font-black text-indigo-400 uppercase tracking-widest">
                                    {{ str_replace('_', ' ', $q->kategori) }}
                                </div>
                            </div>

                            {{-- Question Card --}}
                            <div class="bg-white border border-gray-200 rounded-2xl lg:rounded-3xl p-5 sm:p-8 lg:p-10 shadow-xl relative overflow-hidden group">
                                <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-600/10 rounded-full blur-3xl group-hover:bg-indigo-600/20 transition-all duration-700"></div>
                                
                                <p class="text-lg md:text-xl text-gray-800 leading-relaxed font-medium mb-10 relative z-10">
                                    {{ $q->pertanyaan }}
                                </p>

                                {{-- Options Area --}}
                                <div class="grid grid-cols-1 gap-4 relative z-10">
                                    @php $options = ['a' => $q->opsi_a, 'b' => $q->opsi_b, 'c' => $q->opsi_c, 'd' => $q->opsi_d]; @endphp
                                    @foreach ($options as $key => $opt)
                                        @if ($opt !== null && $opt !== '')
                                            <label class="relative flex items-center p-3.5 sm:p-5 rounded-xl sm:rounded-2xl border-2 border-gray-200 bg-white hover:bg-gray-50 hover:border-indigo-400 cursor-pointer transition-all duration-300 group/opt">
                                                <input type="radio" name="answers[{{ $q->id }}]" value="{{ $key }}" 
                                                    class="peer hidden" onchange="markAnswered({{ $index }})">
                                                
                                                {{-- Option Letter Indicator --}}
                                                <div class="w-10 h-10 rounded-xl bg-gray-100 border border-gray-300 flex items-center justify-center text-sm font-bold text-gray-600 group-hover/opt:text-indigo-600 group-hover/opt:border-indigo-400 peer-checked:bg-indigo-600 peer-checked:border-indigo-600 peer-checked:text-white transition-all shadow-inner uppercase mr-5">
                                                    {{ $key }}
                                                </div>

                                                <span class="text-base text-gray-600 group-hover/opt:text-gray-900 peer-checked:text-gray-900 transition-colors leading-snug">
                                                    {{ $opt }}
                                                </span>

                                                {{-- Checked Indicator --}}
                                                <div class="ml-auto opacity-0 peer-checked:opacity-100 transition-opacity">
                                                    <div class="w-6 h-6 rounded-full bg-indigo-500 flex items-center justify-center shadow-lg shadow-indigo-900/40">
                                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                                    </div>
                                                </div>

                                                <div class="absolute inset-0 rounded-2xl border-2 border-indigo-500 scale-95 opacity-0 peer-checked:opacity-100 peer-checked:scale-100 transition-all duration-300 pointer-events-none"></div>
                                            </label>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            {{-- Navigation Buttons --}}
                            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
                                <button type="button" onclick="prevQuestion()" id="btn-prev"
                                    class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-2xl border border-gray-300 text-sm font-bold text-gray-600 hover:bg-gray-100 hover:text-gray-900 disabled:opacity-20 disabled:cursor-not-allowed transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                    Sebelumnya
                                </button>

                                <div class="flex w-full sm:w-auto gap-4">
                                    <button type="button" onclick="nextQuestion()" id="btn-next"
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-10 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-bold rounded-2xl shadow-xl shadow-indigo-900/30 transition-all hover:-translate-y-0.5 active:translate-y-0">
                                        Selanjutnya
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                    </button>

                                    <button type="submit" id="btn-submit" onclick="return confirm('Sudah yakin dengan semua jawaban Anda?')"
                                        class="hidden flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-10 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white text-sm font-bold rounded-2xl shadow-xl shadow-emerald-900/30 transition-all hover:-translate-y-0.5 active:translate-y-0">
                                        Kirim Ujian
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>

            {{-- Sidebar Info (Right) --}}
            <div class="w-full lg:w-80 space-y-4 lg:space-y-8 order-first lg:order-last">
                
                {{-- Timer Card --}}
                {{-- Timer Card: compact on mobile, full on desktop --}}
                <div class="bg-white border border-gray-200 rounded-2xl lg:rounded-3xl p-4 sm:p-8 shadow-xl relative overflow-hidden">
                    <div class="absolute -bottom-10 -left-10 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl"></div>

                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-3 lg:mb-6">Sisa Waktu Ujian</h4>

                    <div class="flex items-center gap-4 mb-3 lg:mb-6">
                        <div class="w-10 h-10 lg:w-14 lg:h-14 rounded-xl lg:rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 lg:w-8 lg:h-8 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="flex-1">
                            <div class="text-3xl lg:text-4xl font-mono font-black text-gray-800 leading-none tracking-tight" id="timer">
                                45:00
                            </div>
                            <p class="text-[10px] text-gray-500 mt-1 uppercase font-bold tracking-widest">Menit : Detik</p>
                        </div>
                    </div>

                    <div class="w-full bg-gray-200 rounded-full h-2 shadow-inner overflow-hidden">
                        <div id="timer-progress" class="bg-gradient-to-r from-indigo-600 to-indigo-400 h-full transition-all duration-1000 shadow-[0_0_15px_rgba(79,70,229,0.5)]" style="width: 100%"></div>
                    </div>
                </div>

                {{-- Navigation Grid --}}
                <div class="bg-white border border-gray-200 rounded-2xl lg:rounded-3xl p-4 sm:p-8 shadow-xl">
                    <h4 class="text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-6">Navigasi Soal</h4>
                    <div class="grid grid-cols-4 gap-3">
                        @foreach ($questions as $index => $q)
                            <button type="button" onclick="jumpToQuestion({{ $index }})" 
                                id="nav-item-{{ $index }}"
                                class="nav-item aspect-square rounded-xl border border-gray-200 text-sm font-bold flex items-center justify-center transition-all duration-300
                                       bg-white text-gray-600 hover:border-indigo-400 hover:bg-indigo-50 hover:text-indigo-600">
                                {{ $index + 1 }}
                            </button>
                        @endforeach
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-200 space-y-3">
                        <div class="flex items-center justify-between text-[10px] font-bold uppercase tracking-wider">
                            <span class="text-gray-500">Terjawab</span>
                            <span class="text-emerald-500" id="answered-count">0 / {{ $questions->count() }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-1.5 overflow-hidden">
                            <div id="answered-progress" class="bg-emerald-500 h-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                    </div>
                </div>

                <div class="p-5 rounded-2xl bg-amber-50 border border-amber-200 border-dashed">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-[11px] text-amber-800 leading-relaxed font-medium">
                            Pastikan Anda menjawab semua soal dengan teliti sebelum waktu berakhir. Jawaban yang belum terisi akan dianggap salah.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        let currentIdx = 0;
        const totalQuestions = {{ $questions->count() }};
        const steps = document.querySelectorAll('.question-step');
        const navItems = document.querySelectorAll('.nav-item');
        const btnPrev = document.getElementById('btn-prev');
        const btnNext = document.getElementById('btn-next');
        const btnSubmit = document.getElementById('btn-submit');
        const timerEl = document.getElementById('timer');
        const timerProgress = document.getElementById('timer-progress');
        const answeredList = new Set();

        function showQuestion(idx) {
            steps.forEach(s => s.classList.add('hidden'));
            steps[idx].classList.remove('hidden');
            
            navItems.forEach((item, i) => {
                item.classList.remove('ring-2', 'ring-indigo-500', 'border-indigo-500', 'text-white', 'bg-indigo-600/30', 'scale-110', 'shadow-lg');
                if(i === idx) {
                    item.classList.add('ring-2', 'ring-indigo-500', 'border-indigo-500', 'text-white', 'bg-indigo-600/30', 'scale-110', 'shadow-lg');
                }
            });

            btnPrev.disabled = (idx === 0);
            if (idx === totalQuestions - 1) {
                btnNext.classList.add('hidden');
                btnSubmit.classList.remove('hidden');
            } else {
                btnNext.classList.remove('hidden');
                btnSubmit.classList.add('hidden');
            }
            currentIdx = idx;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function nextQuestion() { if (currentIdx < totalQuestions - 1) showQuestion(currentIdx + 1); }
        function prevQuestion() { if (currentIdx > 0) showQuestion(currentIdx - 1); }
        function jumpToQuestion(idx) { showQuestion(idx); }

        function markAnswered(idx) {
            const navItem = document.getElementById('nav-item-' + idx);
            navItem.classList.add('bg-emerald-500', 'border-emerald-500', 'text-white');
            
            answeredList.add(idx);
            const count = answeredList.size;
            document.getElementById('answered-count').textContent = `${count} / ${totalQuestions}`;
            document.getElementById('answered-progress').style.width = `${(count/totalQuestions)*100}%`;
        }

        // Timer Logic
        let timeLeft = {{ $timeLeft }};
        const totalTime = 45 * 60;

        const timerInterval = setInterval(() => {
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                timerEl.textContent = "00:00";
                document.getElementById('exam-form').submit();
                return;
            }

            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerEl.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            
            const progress = (timeLeft / totalTime) * 100;
            timerProgress.style.width = `${progress}%`;
            
            if (timeLeft <= 300) {
                timerEl.classList.add('text-red-500', 'animate-pulse');
                timerProgress.classList.replace('from-indigo-600', 'from-red-600');
            }
            timeLeft--;
        }, 1000);

        showQuestion(0);
    </script>
</x-peserta-layout>