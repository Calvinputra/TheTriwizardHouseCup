@extends('main')

@section('title', 'Welcome to Hogwarts | Triwizard House Cup')
@section('description', 'Halaman sambutan bertema Harry Potter dengan opsi daftar Triwizard House Cup atau login. Versi
    sederhana tanpa efek bersinar, dengan pertanyaan kepribadian 1–5 yang dapat diklik.')

@section('content')
    <div class="min-h-screen bg-[#0b0a12] text-[#F1EDE6] relative overflow-hidden">
        <div class="absolute inset-x-0 top-0 h-2 bg-gradient-to-b from-black/10 to-transparent sm:hidden"></div>
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div
                class="absolute -top-1/2 left-1/2 -translate-x-1/2 h-[120vh] w-[120vw] bg-[radial-gradient(ellipse_at_center,rgba(255,215,128,0.12),rgba(14,12,24,0)_60%)]">
            </div>
            <div class="absolute -bottom-16 -left-16 h-72 w-72 rounded-full blur-3xl opacity-30 bg-amber-700/40"></div>
            <div class="absolute -top-16 -right-16 h-72 w-72 rounded-full blur-3xl opacity-30 bg-indigo-700/40"></div>
            <div
                class="absolute inset-0 [background-image:radial-gradient(1px_1px_at_20px_30px,rgba(255,255,255,0.35),transparent),radial-gradient(1px_1px_at_120px_130px,rgba(255,255,255,0.27),transparent),radial-gradient(1px_1px_at_220px_80px,rgba(255,255,255,0.27),transparent),radial-gradient(2px_2px_at_60%_40%,rgba(255,255,255,0.22),transparent)]">
            </div>
        </div>

        <header class="relative z-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4 sm:py-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo_hogwarts.png') }}" alt="Hogwarts"
                        class="h-10 w-10 object-contain drop-shadow" />
                    <div>
                        <p class="text-xs uppercase tracking-widest text-amber-300/80">Hogwarts School</p>
                        <h1 class="text-xl font-semibold tracking-wide">The Triwizard House Cup</h1>
                    </div>
                </div>
                <div class="hidden sm:flex items-center gap-3">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center gap-2 rounded-lg border border-amber-400/30 bg-amber-50/5 px-4 py-2 text-amber-200 hover:bg-amber-400/10 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                            <path
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        Login
                    </a>
                </div>
            </div>
        </header>

        <main x-data="{
            showForm: false,
            openFormAndScroll() {
                this.showForm = true;
                const target = document.getElementById('formSection');
                if (!target) return;
                const smooth = () => target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                try { smooth(); } catch (e) {
                    const rect = target.getBoundingClientRect();
                    const offset = window.pageYOffset + rect.top - 24;
                    window.scrollTo({ top: offset, left: 0, behavior: 'smooth' });
                }
                setTimeout(() => { document.getElementById('wizard-name')?.focus(); }, 600);
            }
        }" class="relative z-10">

            <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-12 sm:pb-16 pt-6 lg:pt-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                    <div class="flex flex-col justify-center">
                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-amber-400/30 bg-amber-50/5 px-3 py-1 text-[11px] uppercase tracking-widest text-amber-200 mb-4 w-fit">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                            Welcome, Aogers & Coach Pin
                        </div>
                        <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight">
                            Selamat datang di <span class="text-amber-300">Hogwarts</span> —
                            buktikan kemampuanmu di <span class="text-indigo-300">Triwizard House Cup</span>
                        </h2>
                        <div class="">
                            <button id="openZonk" 
                                class="b text-[#1b1408] w-12 h-12 rounded-full flex items-center justify-center shadow-lg active:scale-95 transition-all duration-300">
                                <p class="text-white">✦</p>
                            </button>
                        </div>
                        <p class="mt-3 sm:mt-4 text-amber-100/80 leading-relaxed text-[15px] sm:text-base">
                            Daftarkan dirimu untuk bertanding mewakili Housemu yaitu <em>Gryffindor</em>,
                            <em>Slytherin</em>, <em>Ravenclaw</em>, atau <em>Hufflepuff</em>.
                            <br>Satu halaman ini menyediakan pilihan untuk <span class="font-semibold">Daftar</span> atau
                            langsung <span class="font-semibold">Login</span> jika kamu sudah memiliki akun.
                        </p>

                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl sm:max-w-none">
                            <div class="rounded-xl border border-amber-400/20 bg-white/5 p-4">
                                <p class="text-sm text-amber-200">Hadiah</p>
                                <p class="text-lg font-semibold">Piala Triwizard</p>
                            </div>
                            <div class="rounded-xl border border-indigo-400/20 bg-white/5 p-4">
                                <p class="text-sm text-indigo-200">Tanggal dan Jam</p>
                                <p class="text-lg font-semibold">Minggu, 26 Oktober • 12.00 WIB</p>
                            </div>
                        </div>

                        <div class="mt-8 grid grid-cols-1 gap-4 max-w-xl sm:max-w-none">
                            <div class="rounded-xl border border-emerald-400/20 bg-white/5 p-4">
                                <p class="text-sm text-emerald-200">Lokasi</p>
                                <p class="text-lg font-semibold">Taman Kota Penjaringan</p>
                                <p class="mt-1 text-xs text-emerald-100/80 leading-relaxed">
                                    Jl. Kepanduan II, RT.7/RW.16, Pejagalan, Kec. Penjaringan, Jakarta Utara 14450
                                </p>
                                @php
                                    $gmapsQuery = urlencode(
                                        'Jl. Kepanduan II, RT.7/RW.16, Pejagalan, Kecamatan Penjaringan, Jkt Utara, Daerah Khusus Ibukota Jakarta 14450',
                                    );
                                    $gmapsUrl = 'https://maps.app.goo.gl/GnxUxdEm1KvvE7z27';
                                @endphp
                                <a href="{{ $gmapsUrl }}" target="_blank" rel="noopener"
                                    class="mt-3 inline-flex items-center gap-2 rounded-lg border border-emerald-400/30 bg-emerald-50/5 px-3 py-2 text-emerald-100 hover:bg-emerald-400/10 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M12 2C8.686 2 6 4.686 6 8c0 4.637 5.4 11.21 5.63 11.48a.5.5 0 00.74 0C12.6 19.21 18 12.637 18 8c0-3.314-2.686-6-6-6zm0 8.5A2.5 2.5 0 119.5 8 2.5 2.5 0 0112 10.5z" />
                                    </svg>
                                    Buka di Google Maps
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="relative mt-8 lg:mt-0">
                        <div
                            class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl shadow-2xl max-w-xl mx-auto lg:max-w-none">
                            <div class="p-6 sm:p-8">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="text-xl font-bold">House of Hogwarts</h3>
                                        <p class="text-amber-100/70 text-sm">Tonton video pengantar sebelum mendaftar.</p>
                                    </div>
                                    {{-- <a href="#formSection" @click.prevent="openFormAndScroll()" class="inline-flex items-center gap-2 rounded-lg border border-amber-400/30 bg-amber-50/5 px-3 py-1.5 text-xs hover:bg-amber-400/10">
                  Daftarkan Diri
                </a> --}}
                                </div>
                                @php
                                    $localFile = 'Hogwrats_Video.mp4';
                                    $localPath = public_path('videos/' . $localFile);
                                    $revealVideo = file_exists($localPath) ? asset('videos/' . $localFile) : null;
                                @endphp
                                <div class="mt-4">
                                    <div
                                        class="relative w-full max-w-[520px] mx-auto border border-white/10 bg-black rounded-xl overflow-hidden">
                                        <div class="relative w-full" style="padding-top:177.78%;">
                                            <div class="absolute inset-0">
                                                <video id="hogwartsVideo" class="w-full h-full object-cover" controls
                                                    autoplay loop playsinline preload="metadata" src="{{ $revealVideo }}">
                                                </video>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-4 text-amber-100/90 text-sm italic">
                                        “Welcome to Hogwarts School of Witchcraft and Wizardry — where bravery, wisdom,
                                        loyalty, and ambition unite in the greatest magical competition of all time.”
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

            <section class="pb-12 sm:pb-16">
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <h2 class="text-2xl sm:text-3xl font-bold text-center mb-8 text-amber-200">House of Hogwarts</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div
                            class="rounded-xl border border-red-400/30 bg-gradient-to-br from-red-900/40 to-transparent p-5">
                            <img src="{{ asset('images/logo_gryffindor.png') }}" alt="Gryffindor" class="h-12 w-12 mb-3">
                            <h3 class="text-xl font-bold text-red-300">Gryffindor</h3>
                            <p class="text-sm mt-2 text-amber-100/80 leading-relaxed">Tempat bagi mereka yang memiliki
                                keberanian, tekad, dan hati yang besar. Gryffindor melambangkan keberanian dan kehormatan
                                sejati. “Their daring, nerve, and chivalry set Gryffindors apart.”</p>
                        </div>
                        <div
                            class="rounded-xl border border-green-400/30 bg-gradient-to-br from-green-900/40 to-transparent p-5">
                            <img src="{{ asset('images/logo_slytherin.png') }}" alt="Slytherin" class="h-12 w-12 mb-3">
                            <h3 class="text-xl font-bold text-green-300">Slytherin</h3>
                            <p class="text-sm mt-2 text-amber-100/80 leading-relaxed">Dikenal karena kecerdikan, ambisi, dan
                                tekad untuk mencapai tujuan apa pun. “Those cunning folks use any means to achieve their
                                ends.”</p>
                        </div>
                        <div
                            class="rounded-xl border border-blue-400/30 bg-gradient-to-br from-blue-900/40 to-transparent p-5">
                            <img src="{{ asset('images/logo_ravenclaw.png') }}" alt="Ravenclaw" class="h-12 w-12 mb-3">
                            <h3 class="text-xl font-bold text-blue-300">Ravenclaw</h3>
                            <p class="text-sm mt-2 text-amber-100/80 leading-relaxed">Ravenclaw adalah rumah bagi para
                                pemikir dan penemu. Mereka menghargai kebijaksanaan, kecerdasan, dan imajinasi. “Wit beyond
                                measure is man’s greatest treasure.”</p>
                        </div>
                        <div
                            class="rounded-xl border border-yellow-400/30 bg-gradient-to-br from-yellow-800/40 to-transparent p-5">
                            <img src="{{ asset('images/logo_hufflepuff.png') }}" alt="Hufflepuff" class="h-12 w-12 mb-3">
                            <h3 class="text-xl font-bold text-yellow-300">Hufflepuff</h3>
                            <p class="text-sm mt-2 text-amber-100/80 leading-relaxed">Rumah bagi mereka yang setia, sabar,
                                dan pekerja keras. “Those patient Hufflepuffs are true and unafraid of toil.”</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="my-5 mx-4 sm:mt-6 flex flex-col sm:flex-row items-center justify-center gap-3">
                <button @click="openFormAndScroll()"
                    class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-amber-500 px-5 py-3 font-semibold text-[#1b1408] hover:bg-amber-400 active:scale-[.99] shadow-[0_4px_24px_rgba(245,158,11,0.25)]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                        <path
                            d="M11.25 4.5l.338 2.369a2.25 2.25 0 001.943 1.943L15.9 9.15l-2.369.338a2.25 2.25 0 00-1.943 1.943L11.25 13.5l-.338-2.069a2.25 2.25 0 00-1.943-1.943L6.6 9.15l2.369-.338a2.25 2.25 0 001.943-1.943L11.25 4.5z" />
                    </svg>
                    Daftarkan Diri
                </button>

                <a href="{{ route('login') }}"
                    class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg border border-amber-400/30 bg-amber-50/5 px-5 py-3 text-amber-100/90 hover:bg-amber-400/10">
                    Sudah punya akun? Login
                </a>
            </div>

            <section id="formSection" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-12 sm:pb-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                    <div
                        class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl shadow-2xl max-w-xl mx-auto lg:max-w-none lg:col-span-2">
                        <div class="p-6 sm:p-8">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h3 class="text-xl font-bold">Form Pendaftaran — Triwizard House Cup</h3>
                                    <p class="text-amber-100/70 text-sm">Isi data di bawah ini untuk mewakili rumah
                                        pilihanmu.</p>
                                </div>
                                <button @click="showForm = !showForm"
                                    class="inline-flex items-center gap-2 rounded-lg border border-amber-400/30 bg-amber-50/5 px-3 py-1.5 text-xs hover:bg-amber-400/10">
                                    <span x-text="showForm ? 'Sembunyikan' : 'Tampilkan'"></span>
                                </button>
                            </div>

                            <form x-show="showForm" x-cloak method="POST" action="{{ route('register') }}"
                                enctype="multipart/form-data" class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5"
                                x-data="{
                                    name: '',
                                    nickname: '',
                                    email: '',
                                    phone: '',
                                    age: '',
                                    desired_house: '',
                                    motivation: '',
                                    emailTouched: false,
                                    phoneTouched: false,
                                    isEmailValid() { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email); },
                                    isPhoneValid() { return /^08\d{6,}$/.test(this.phone); }
                                }"
                                @submit.prevent="
                      if(!isEmailValid()){ emailTouched = true }
                      if(!isPhoneValid()){ phoneTouched = true }
                      if(isEmailValid() && isPhoneValid()) $el.submit();
                  ">
                                @csrf

                                <div class="sm:col-span-2">
                                    <label for="wizard-name" class="block text-sm mb-1">Nama Lengkap</label>
                                    <input id="wizard-name" name="name" type="text" required
                                        placeholder="Harry James Potter" x-model="name"
                                        class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20" />
                                    @error('name')
                                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="wizard-nickname" class="block text-sm mb-1">Nickname</label>
                                    <input id="wizard-nickname" name="nickname" type="text" required
                                        placeholder="Mis. Momo, Stranger" x-model="nickname"
                                        class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20" />
                                    @error('nickname')
                                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="wizard-email" class="block text-sm mb-1">Email</label>
                                    <input id="wizard-email" name="email" type="email" required
                                        placeholder="harry@gmail.com" x-model="email" @blur="emailTouched = true"
                                        class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20" />
                                    @error('email')
                                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                    @enderror
                                    <p x-show="emailTouched && !isEmailValid()" class="mt-1 text-xs text-rose-400">
                                        Email harus format valid, mengandung @ dan domain seperti nama@domain.com.
                                    </p>
                                </div>

                                <div>
                                    <label for="wizard-phone" class="block text-sm mb-1">Nomor Telepon WhatsApp</label>
                                    <input id="wizard-phone" name="phone" type="tel" inputmode="numeric" required
                                        placeholder="08xxxxxxxxxx" x-model="phone" pattern="^08\d{6,}$"
                                        @input="phone = phone.replace(/[^0-9]/g,'')" @blur="phoneTouched = true"
                                        class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20" />
                                    @error('phone')
                                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                    @enderror
                                    <p x-show="phoneTouched && !isPhoneValid()" class="mt-1 text-xs text-rose-400">
                                        Nomor harus angka, diawali 08, dan minimal delapan digit.
                                    </p>
                                </div>

                                <div>
                                    <label for="wizard-age" class="block text-sm mb-1">Umur</label>
                                    <input id="wizard-age" name="age" type="number" min="11" max="30"
                                        required placeholder="21" x-model="age"
                                        class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20" />
                                    @error('age')
                                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="desired_house" class="block text-sm mb-1">Rumah Asrama yang Kamu
                                        Inginkan</label>
                                    <select id="desired_house" name="desired_house" required
                                        class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20">
                                        <option value="" disabled selected>Pilih Asrama</option>
                                        <option value="Gryffindor">Gryffindor</option>
                                        <option value="Hufflepuff">Hufflepuff</option>
                                        <option value="Ravenclaw">Ravenclaw</option>
                                        <option value="Slytherin">Slytherin</option>
                                    </select>
                                    @error('desired_house')
                                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="motivation" class="block text-sm mb-1">Motivasi</label>
                                    <textarea id="motivation" name="motivation" rows="3" x-model="motivation"
                                        placeholder="Ceritakan kenapa kamu pantas mewakili rumahmu..."
                                        class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20"></textarea>
                                    @error('motivation')
                                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-sm mb-2">Pertanyaan Kepribadian (1 sangat tidak setuju, 5
                                        sangat setuju)</label>
                                    @php
                                        $questions = [
                                            'q1' => 'Saya senang bekerja sama dalam tim untuk meraih tujuan bersama.',
                                            'q2' => 'Saya tetap tenang dan fokus saat menghadapi tekanan.',
                                            'q3' => 'Saya mudah beradaptasi dengan aturan dan situasi baru.',
                                            'q4' => 'Saya berani mengambil inisiatif ketika melihat peluang.',
                                            'q5' => 'Saya disiplin dalam mempersiapkan diri sebelum bertanding.',
                                        ];
                                    @endphp
                                    <div class="space-y-4">
                                        @foreach ($questions as $key => $text)
                                            <div>
                                                <p class="text-sm mb-2">{{ $loop->iteration }}. {{ $text }}</p>
                                                <div class="grid grid-cols-5 gap-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <div>
                                                            <input class="peer hidden" type="radio"
                                                                id="{{ $key }}-{{ $i }}"
                                                                name="{{ $key }}" value="{{ $i }}"
                                                                @if ($i === 1) required @endif>
                                                            <label for="{{ $key }}-{{ $i }}"
                                                                class="flex items-center justify-center rounded-md border border-white/15 bg-[#0e0c17]/60 px-0 py-2 text-sm text-amber-100 hover:bg-white/10 peer-checked:bg-amber-500 peer-checked:text-[#1b1408] peer-checked:border-amber-400 select-none">{{ $i }}</label>
                                                        </div>
                                                    @endfor
                                                </div>
                                                @error($key)
                                                    <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="sm:col-span-2 flex items-start gap-3">
                                    <input id="consent" name="consent" type="checkbox" required
                                        class="mt-1 h-4 w-4 rounded border-white/20 bg-[#0e0c17] text-amber-500 focus:ring-amber-400">
                                    <label for="consent" class="text-sm">Saya menyetujui aturan Hogwarts dan siap
                                        bertanding secara sportif.</label>
                                </div>

                                <div
                                    class="sm:col-span-2 mt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                                    <button type="submit"
                                        class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-amber-500 px-5 py-3 font-semibold text-[#1b1408] hover:bg-amber-400 active:scale-[.99]">
                                        Kirim Pendaftaran
                                    </button>
                                </div>
                            </form>

                            <div x-show="!showForm" x-cloak
                                class="mt-6 rounded-xl border border-white/10 bg-white/5 p-4 text-sm text-amber-100/80">
                                Klik <span class="font-semibold text-amber-200">Daftarkan Diri</span> di atas untuk
                                menampilkan formulir. Jika sudah punya akun, langsung <a href="{{ route('login') }}"
                                    class="underline decoration-amber-400/60 hover:text-amber-200">login</a>.
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </main>

        <footer class="relative z-10 border-t border-white/10">
            <div
                class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-amber-100/70">
                <p>© {{ date('Y') }} Hogwarts — Triwizard House Cup</p>
                <p class="flex items-center gap-2">
                    Made with <span class="text-amber-300">
                        <a href="#" id="openPuzzle">✦</a>
                    </span> Coach Pin
                </p>
            </div>
        </footer>
    </div>

    <button id="musicToggle"
        class="fixed bottom-6 right-6 z-50 rounded-full bg-amber-500/80 hover:bg-amber-400 text-[#1b1408] shadow-lg w-12 h-12 flex items-center justify-center transition"
        title="Putar / Matikan Musik">
        <svg id="iconPlay" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
            <path d="M8 5v14l11-7z" />
        </svg>
        <svg id="iconPause" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="currentColor"
            viewBox="0 0 24 24">
            <path d="M6 5h4v14H6zM14 5h4v14h-4z" />
        </svg>
    </button>

    <audio id="bgm" preload="auto" loop playsinline>
        <source src="{{ asset('audio/hogwarts_theme.mp3') }}" type="audio/mpeg">
        <source src="{{ asset('audio/hogwarts_theme.m4a') }}" type="audio/mp4">
        <source src="{{ asset('audio/hogwarts_theme.ogg') }}" type="audio/ogg">
    </audio>

    <div id="puzzleModal"
        class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition">
        <div
            class="relative bg-gradient-to-b from-[#1a140d] to-[#2a2117] rounded-2xl shadow-2xl max-w-md w-full text-amber-100 border border-amber-800/30 overflow-hidden">
            
            <div class="relative p-6 text-center">
                <img src="{{ asset('images/logo_hogwarts.png') }}" alt="Hogwarts Logo"
                    class="h-14 mx-auto mb-4 opacity-90 drop-shadow-md">
                <h2 class="text-xl font-bold mb-2 tracking-wide text-amber-300">Charm of Numbers</h2>
                <p class="text-sm italic mb-4 text-amber-200/90">Masukkan 6 angka rahasia untuk membuka surat Hogwarts</p>

                <input id="magicCode" maxlength="6" placeholder="______" 
                    class="w-40 mx-auto text-center text-2xl font-bold tracking-[0.4em] bg-transparent border-b-2 border-amber-400 focus:outline-none caret-amber-400 text-amber-100 placeholder:text-amber-600" 
                    type="text">

                <div class="mt-6 flex justify-center gap-3">
                    <button id="checkCode"
                        class="px-5 py-2.5 rounded-lg bg-amber-600 text-[#1b1408] font-semibold hover:bg-amber-500 active:scale-[.98] transition">
                        Buka Surat
                    </button>
                    <button id="cancelPuzzle"
                        class="px-5 py-2.5 rounded-lg bg-gray-500 text-white font-semibold hover:bg-gray-400 transition">
                        Batal
                    </button>
                </div>
                <p id="errorMsg" class="text-red-400 mt-3 hidden text-sm italic">Angka yang kamu masukan Salah!</p>
            </div>
        </div>
    </div>

    <!-- ✦ Modal Surat Harry Potter -->
    <div id="letterModal"
        class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition">
        <div
            class="relative bg-gradient-to-b from-[#1a140d] to-[#2a2117] rounded-2xl shadow-2xl max-w-lg w-full text-amber-100 border border-amber-800/30 overflow-hidden">
            
            <div class="relative p-6 sm:p-8 text-center">
                <!-- Logo Hogwarts -->
                <img src="{{ asset('images/logo_hogwarts.png') }}" alt="Hogwarts Logo"
                    class="h-16 mx-auto mb-3 opacity-90 drop-shadow-md">

                <h2 class="text-2xl font-bold mb-2 tracking-wide text-amber-300">
                    Surat dari Hogwarts
                </h2>
                <p class="text-sm italic mb-5 text-amber-200/90">
                    Untuk Para Peserta Turnamen Triwizard
                </p>

                <!-- Isi Pesan -->
                <div class="text-[15px] leading-relaxed text-amber-100">
                    <p class="mb-3">
                        <strong>Selamat, Peserta Turnamen!</strong> ⚡<br>
                        Kalian telah membuka surat istimewa yang dikirim dari ruang kepala sekolah Hogwarts.
                    </p>

                    <p class="mb-4">
                        <strong>Tugas kalian selanjutnya:</strong><br>
                        Temukan Lokasi Dibawah ini,  
                        lalu berfoto bersama tim kalian di tempat itu. ( Foto Sampai Kelihatan Tulisan )
                    </p>

                    <p class="mb-3">
                        Unggah foto tersebut ke grup House dengan pose yang menunjukkan  
                        <span class="text-amber-400 font-semibold">House Kalian</span>.
                    </p>
                </div>

                <!-- Gambar Rune Petir (visual clue) -->
                <div class="relative mt-6 mb-4 flex justify-center">
                    <img src="{{ asset('images/photo_rune_petir.png') }}" 
                        alt="Rune Petir" 
                        class="w-24 opacity-90 drop-shadow-lg">
                </div>

                <!-- Tombol Tutup -->
                <div class="mt-6">
                    <button id="closeLetter"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-amber-600 text-[#1b1408] font-semibold hover:bg-amber-500 active:scale-[.98] transition">
                        Tutup Surat
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- ✦ Script -->
    <script>
        const openPuzzle = document.getElementById('openPuzzle');
        const puzzleModal = document.getElementById('puzzleModal');
        const letterModal = document.getElementById('letterModal');
        const checkCode = document.getElementById('checkCode');
        const cancelPuzzle = document.getElementById('cancelPuzzle');
        const closeLetter = document.getElementById('closeLetter');
        const magicCode = document.getElementById('magicCode');
        const errorMsg = document.getElementById('errorMsg');

        const correctCode = "261025"; 

        // buka modal angka
        openPuzzle.addEventListener('click', (e) => {
            e.preventDefault();
            puzzleModal.classList.remove('hidden');
        });

        // tombol batal
        cancelPuzzle.addEventListener('click', () => {
            puzzleModal.classList.add('hidden');
            errorMsg.classList.add('hidden');
            magicCode.value = '';
        });

        // cek kode
        checkCode.addEventListener('click', () => {
            if (magicCode.value === correctCode) {
                puzzleModal.classList.add('hidden');
                letterModal.classList.remove('hidden');
                errorMsg.classList.add('hidden');
                magicCode.value = '';
            } else {
                errorMsg.classList.remove('hidden');
                puzzleModal.classList.add('animate-shake');
                setTimeout(() => puzzleModal.classList.remove('animate-shake'), 500);
            }
        });

        // tutup surat
        closeLetter.addEventListener('click', () => {
            letterModal.classList.add('hidden');
        });

        // animasi getar kecil
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                20%, 60% { transform: translateX(-6px); }
                40%, 80% { transform: translateX(6px); }
            }
            .animate-shake { animation: shake 0.4s; }
        `;
        document.head.appendChild(style);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const starLink = document.getElementById('openLetter');
            const modal = document.getElementById('letterModal');
            const closeBtn = document.getElementById('closeLetter');

            if (starLink && modal && closeBtn) {
                starLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });

                closeBtn.addEventListener('click', function() {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });

                // Tutup modal dengan klik di luar surat
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.classList.add('hidden');
                        modal.classList.remove('flex');
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var audio = document.getElementById('bgm');
            var btn = document.getElementById('musicToggle');
            var iconPlay = document.getElementById('iconPlay');
            var iconPause = document.getElementById('iconPause');
            var isPlaying = false;

            // Efek fade halus untuk transisi volume
            function fadeTo(target, ms) {
                var steps = 20;
                var stepTime = Math.max(10, Math.floor(ms / steps));
                var start = isNaN(audio.volume) ? 0 : audio.volume;
                var delta = (target - start) / steps;
                var i = 0;
                var t = setInterval(function() {
                    i++;
                    var v = start + delta * i;
                    audio.volume = Math.max(0, Math.min(1, v));
                    if (i >= steps) clearInterval(t);
                }, stepTime);
            }

            // Fungsi untuk memutar musik
            function playMusic() {
                audio.muted = false;
                audio.load();
                audio.volume = 0;
                var p = audio.play();
                if (p && typeof p.then === 'function') {
                    p.then(function() {
                        fadeTo(0.6, 600);
                        iconPlay.classList.add('hidden');
                        iconPause.classList.remove('hidden');
                        isPlaying = true;
                    }).catch(function(err) {
                        console.warn('Autoplay diblokir oleh browser:', err);
                    });
                }
            }

            // Fungsi untuk menghentikan musik
            function pauseMusic() {
                fadeTo(0.0, 400);
                setTimeout(function() {
                    audio.pause();
                    iconPause.classList.add('hidden');
                    iconPlay.classList.remove('hidden');
                    isPlaying = false;
                }, 420);
            }

            // Saat tombol diklik
            btn.addEventListener('click', function() {
                if (isPlaying) pauseMusic();
                else playMusic();
            });

            // Otomatis berhenti kalau tab ditinggalkan
            document.addEventListener('visibilitychange', function() {
                if (document.hidden && isPlaying) {
                    pauseMusic();
                }
            });
        });
    </script>

@endsection
