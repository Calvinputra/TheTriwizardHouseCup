@extends('main')

@section('title', 'Home | Hogwarts Triwizard Portal')
@section('description', 'Beranda peserta dengan tiket bergaya Harry Potter, video reveal House, dan tombol gabung
    WhatsApp Group per House.')

@section('content')
    @php
        $user = auth()->user();
        $rawHouse = optional($user)->house;
        $houseName = $rawHouse && trim($rawHouse) !== '' ? $rawHouse : 'Hogwarts';

        $logoKey = strtolower($houseName);

        $houseLogoMap = [
            'gryffindor' => 'images/logo_gryffindor.png',
            'slytherin' => 'images/logo_slytherin.png',
            'ravenclaw' => 'images/logo_ravenclaw.png',
            'hufflepuff' => 'images/logo_hufflepuff.png',
            'hogwarts' => 'images/logo_hogwarts.png',
        ];

        $houseData = [
            'gryffindor' => [
                'title' => 'Gryffindor',
                'desc' =>
                    'Rumah para pemberani, ksatria, dan berjiwa kepemimpinan. Mereka menjunjung tinggi keberanian, tekad, dan kebajikan.',
                'leader' => 'Kepala House: Prof. Rdsvki',
                'wa' => 'https://chat.whatsapp.com/I14RUYsWkjqJPona0MXojn',
            ],
            'slytherin' => [
                'title' => 'Slytherin',
                'desc' =>
                    'Ambisi, kecerdikan, dan tekad kuat. Para murid Slytherin dikenal licin namun cerdas mencapai tujuan.',
                'leader' => 'Kepala House: Prof. Stranger',
                'wa' => 'https://chat.whatsapp.com/CjdgUonXye20wwCR8uhx7O',
            ],
            'ravenclaw' => [
                'title' => 'Ravenclaw',
                'desc' =>
                    'Kecerdasan, kreativitas, dan rasa ingin tahu. Mereka mencintai ilmu pengetahuan dan kebijaksanaan.',
                'leader' => 'Kepala House: Prof. Baymare',
                'wa' => 'https://chat.whatsapp.com/F7afZs0i1PF0w10xTzhsYF',
            ],
            'hufflepuff' => [
                'title' => 'Hufflepuff',
                'desc' =>
                    'Kerja keras, kesetiaan, dan kejujuran. Para Hufflepuff dikenal rendah hati dan dapat diandalkan.',
                'leader' => 'Kepala House: Prof. Pinsky',
                'wa' => 'https://chat.whatsapp.com/EEzOLolqdXj950QhzlOoaq',
            ],
        ];

        $houseLogoPath = $houseLogoMap[$logoKey] ?? 'images/logo_hogwarts.png';
        $houseLogoUrl = asset($houseLogoPath);

        $realHouses = ['gryffindor', 'slytherin', 'ravenclaw', 'hufflepuff'];
        $hasRealHouse = in_array($logoKey, $realHouses, true);

        $revealInput = $hasRealHouse ? $houseData[$logoKey]['video'] ?? null : null;

        $fileMap = [
            'gryffindor' => 'Hogwrats_Video.mp4',
            'slytherin' => 'Hogwrats_Video.mp4',
            'ravenclaw' => 'Hogwrats_Video.mp4',
            'hufflepuff' => 'Hogwrats_Video.mp4',
        ];

        $localFile = $fileMap[$logoKey] ?? 'Hogwrats_Video.mp4';

        $isYoutube = is_string($revealInput) && preg_match('~(youtu\.be|youtube\.com)~i', $revealInput);
        $candidate = $isYoutube
            ? $localFile
            : (pathinfo((string) $revealInput, PATHINFO_EXTENSION) === 'mp4'
                ? $revealInput
                : $localFile);

        $localPath = public_path('videos/' . $candidate);
        $revealVideo = file_exists($localPath) ? asset('videos/' . $candidate) : null;

        $waHouse = $hasRealHouse ? $houseData[$logoKey]['wa'] ?? '' : '';
        $waGeneral = $waLink ?? '';

        $now = \Carbon\Carbon::now('Asia/Jakarta');
        $announceDate = $now->day <= 20 ? $now->copy()->day(20) : $now->copy()->addMonthNoOverflow()->day(20);
        $announceFmt = $announceDate->translatedFormat('l, d F Y');
    @endphp

    <div class="min-h-screen bg-[#0b0a12] text-[#F1EDE6] relative overflow-hidden">
        <div aria-hidden="true" class="pointer-events-none absolute inset-0">
            <div
                class="absolute -top-24 left-1/2 -translate-x-1/2 h-[90vh] w-[120vw] bg-[radial-gradient(ellipse_at_center,rgba(255,215,128,0.10),rgba(14,12,24,0)_60%)]">
            </div>
            <div class="absolute -bottom-20 -left-12 h-56 w-56 rounded-full blur-3xl opacity-20 bg-amber-700/40"></div>
            <div class="absolute -top-16 -right-12 h-56 w-56 rounded-full blur-3xl opacity-20 bg-indigo-700/40"></div>
        </div>

        <main class="relative z-10">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

                <div class="mb-6 flex justify-end">
                    @if ($user->role == 'Teacher')
                        <a href="{{ route('database') }}"
                            class="me-3 inline-flex items-center gap-2 rounded-lg border border-white/15 bg-white/5 px-3 py-2 text-sm text-amber-100 hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                                <path
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            (Teacher) Database
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-2 rounded-lg border border-white/15 bg-white/5 px-3 py-2 text-sm text-amber-100 hover:bg-white/10">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
                                <path
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            Keluar
                        </button>
                    </form>
                </div>

                <div class="mb-6 sm:mb-8">
                    <p class="text-xs uppercase tracking-[0.25em] text-amber-300/70">Hogwarts School</p>
                    <h1 class="text-2xl sm:text-3xl font-bold">Selamat datang,
                        {{ auth()->user()->nickname ?? (auth()->user()->name ?? 'Peserta') }}!</h1>
                    <p class="text-amber-100/70 text-sm mt-1">Ini adalah tiket partisipasimu di <span
                            class="font-semibold">Triwizard House Cup</span>.</p>
                </div>

                <section x-data="{
                    waGeneral: '{{ $waGeneral }}',
                    waHouse: '{{ $waHouse }}',
                    copying: false,
                    revealed: {{ $hasRealHouse ? (empty($revealVideo) ? 'true' : 'false') : 'true' }},
                    showHouseDetail: false
                }" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                    @if ($hasRealHouse && !empty($revealVideo))
                        <div class="lg:col-span-2 rounded-2xl border border-amber-400/30 bg-[#0f0c19]/80 p-4">
                            <h3 class="font-semibold mb-2">House Reveal</h3>
                            <div
                                class="relative w-full max-w-[420px] mx-auto border border-white/10 bg-black rounded-xl overflow-hidden">
                                <div class="relative w-full" style="padding-top:177.78%;">
                                    <div class="absolute inset-0">
                                        <video id="houseVideo" class="w-full h-full object-cover" controls autoplay loop
                                            playsinline preload="metadata" src="{{ $revealVideo }}">
                                        </video>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 flex flex-wrap gap-2 justify-center">
                                <button @click="revealed = true; showHouseDetail = true"
                                    class="inline-flex items-center gap-2 rounded-lg border border-emerald-400/30 bg-emerald-50/5 px-3 py-2 text-emerald-100 hover:bg-emerald-400/10">
                                    Lihat House-ku
                                </button>
                            </div>
                        </div>
                    @endif

                    @if ($hasRealHouse)
                        @php
                            $houseTitle = $houseData[$logoKey]['title'] ?? ucfirst($logoKey);
                            $houseDesc = $houseData[$logoKey]['desc'] ?? '';
                            $houseLead = $houseData[$logoKey]['leader'] ?? '';
                        @endphp
                        <div x-show="showHouseDetail" x-transition
                            class="lg:col-span-2 rounded-2xl border border-emerald-400/30 bg-white/5 p-5">
                            <div class="flex items-start gap-4">
                                <img src="{{ $houseLogoUrl }}" alt="{{ $houseTitle }}" class="h-14 w-14 object-contain">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold">{{ $houseTitle }}</h3>
                                    @if ($houseLead)
                                        <p class="text-sm text-amber-200/80 mt-0.5">{{ $houseLead }}</p>
                                    @endif
                                    @if ($houseDesc)
                                        <p class="text-sm text-amber-100/80 mt-2 leading-relaxed">{{ $houseDesc }}</p>
                                    @endif
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <button type="button"
                                            @click="const link = waHouse || waGeneral; if(!link){alert('Link WhatsApp House belum disetel. Hubungi panitia.');} else {window.open(link,'_blank','noopener');}"
                                            class="inline-flex items-center gap-2 rounded-lg border border-emerald-400/30 bg-emerald-50/5 px-3 py-2 text-emerald-100 hover:bg-emerald-400/10">
                                            Gabung WhatsApp House {{ $houseTitle }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div x-show="revealed" x-transition
                        class="relative lg:col-span-2 rounded-2xl border border-amber-400/30 bg-[#0f0c19]/80 shadow-2xl overflow-hidden">
                          <div class="flex flex-col items-end z-20 px-5 pt-4 text-right">
                            <div
                                class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-[#111018]/70 backdrop-blur px-3 py-2 shadow-lg">
                                <img src="{{ $houseLogoUrl }}" alt="House" class="h-5 w-5 md:h-6 md:w-6 object-contain">
                                <span class="text-[10px] md:text-xs uppercase tracking-wider text-amber-200/80">House</span>
                                <span class="text-sm md:text-base font-semibold">{{ $houseName }}</span>
                                @if (!$rawHouse || trim($rawHouse) === '' || !$hasRealHouse)
                                    <span
                                        class="ml-1 inline-flex items-center rounded-md border border-white/15 bg-white/5 px-2 py-0.5 text-[10px] md:text-xs">Soon</span>
                                @endif
                            </div>
                            @if (!$rawHouse || trim($rawHouse) === '' || !$hasRealHouse)
                                <p class="text-amber-100/70 text-sm mt-1">Pengumuman House akan di umumkan pada<span
                                  class="font-semibold"> 20 Oktober 2025</span>.
                                </p>
                            @endif
                            @if ($hasRealHouse)
                                <div class="mt-1 text-[10px] md:text-xs text-amber-100/70 md:text-right"></div>
                            @endif
                        </div>

                        <div class="flex flex-col md:flex-row">
                            <div class="flex-1 p-5 sm:p-7">
                                <div class="flex items-center gap-3 mb-4">
                                    <img src="{{ asset('images/logo_hogwarts.png') }}" alt="Hogwarts"
                                        class="h-10 w-10 object-contain">
                                    <div>
                                        <p class="text-[11px] uppercase tracking-widest text-amber-300/80">Admit One</p>
                                        <h2 class="text-lg sm:text-xl font-bold leading-tight">Triwizard House Cup — Entry
                                            Ticket</h2>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Nama</p>
                                        <p class="text-base break-words font-semibold">{{ auth()->user()->name ?? '-' }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Nickname</p>
                                        <p class="text-base break-words font-semibold">
                                            {{ auth()->user()->nickname ?? '-' }}</p>
                                    </div>
                                    <div class="">
                                        <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Email</p>
                                        <p class="text-base break-words">{{ auth()->user()->email ?? '-' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Umur</p>
                                        <p class="text-base break-words">{{ auth()->user()->age ?? '-' }}</p>
                                    </div>
                                </div>

                                <div class="mt-5 grid grid-cols-1 sm:grid-cols-3 gap-4">
                                    <div>
                                        <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Tanggal</p>
                                        <p class="text-sm">Minggu, 26 Oktober • 12.00 WIB</p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Ticket No.</p>
                                        <p class="text-sm font-mono">
                                            HOG-{{ str_pad(auth()->id() ?? 0, 5, '0', STR_PAD_LEFT) }}</p>
                                    </div>
                                    <div>
                                        <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Status</p>
                                        <p class="text-sm font-semibold text-emerald-300">Valid</p>
                                    </div>
                                </div>

                                <div class="mt-6 flex flex-col sm:flex-row gap-3">
                                    <button type="button"
                                        @click="const link = waHouse || waGeneral; if(!link){alert('Link WhatsApp belum disetel. Hubungi panitia.');} else {window.open(link,'_blank','noopener');}"
                                        class="w-full sm:w-auto text-center inline-flex items-center justify-center gap-2 rounded-lg border border-emerald-400/30 bg-emerald-50/5 px-4 py-2 text-emerald-100 hover:bg-emerald-400/10">
                                        Gabung WhatsApp Group
                                    </button>

                                    @if ($hasRealHouse)
                                        <button type="button"
                                            @click="showHouseDetail = true; window.scrollTo({ top: 0, behavior: 'smooth' })"
                                            class="w-full sm:w-auto text-center inline-flex items-center justify-center gap-2 rounded-lg border border-white/15 bg-white/5 px-4 py-2 text-amber-100 hover:bg-white/10">
                                            Detail House
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <div
                                class="relative hidden md:block w-px bg-gradient-to-b from-transparent via-white/20 to-transparent my-6 mr-24 md:mr-24 lg:mr-24">
                            </div>
                            <div class="absolute right-24 top-1/2 -translate-y-1/2 hidden md:block">
                                <div class="h-8 w-8 rounded-full border border-white/20 bg-[#0b0a12]"></div>
                            </div>
                        </div>
                    </div>

                    <aside class="rounded-2xl border border-white/10 bg-white/5 p-4 h-max lg:sticky lg:top-6">
                        <h3 class="font-semibold mb-2">Info Acara</h3>
                        <ul class="text-sm space-y-1 text-amber-100/80">
                            <li><span class="text-amber-300">Hadiah:</span> Piala Triwizard</li>
                            <li><span class="text-amber-300">Waktu:</span> Minggu, 26 Oktober • 12.00 WIB</li>
                            <li><span class="text-amber-300">Lokasi:</span> Taman Kota Penjaringan</li>
                        </ul>
                        <div class="mt-4 text-xs text-amber-100/60">
                            Pastikan kamu bergabung ke grup WhatsApp untuk info teknis & koordinasi.
                        </div>
                    </aside>

                </section>

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
        </main>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const vid = document.getElementById('houseVideo');
            if (vid) {
                vid.muted = false;
                vid.volume = 1.0;
                const playPromise = vid.play();
                if (playPromise !== undefined) {
                    playPromise.catch(() => {});
                }
            }
        });
    </script>
@endsection
