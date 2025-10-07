@extends('main')

@section('title', 'Home | Hogwarts Triwizard Portal')
@section('description', 'Beranda peserta dengan tiket bergaya Harry Potter dan tombol gabung WhatsApp Group.')

@section('content')
@php
  $user = auth()->user();
  $rawHouse = optional($user)->house;
  $houseName = ($rawHouse && trim($rawHouse) !== '') ? $rawHouse : 'Hogwarts';

  $houseLogoMap = [
    'gryffindor' => 'images/logo_gryffindor.png',
    'slytherin'  => 'images/logo_slytherin.png',
    'ravenclaw'  => 'images/logo_ravenclaw.png',
    'hufflepuff' => 'images/logo_hufflepuff.png',
    'hogwarts'   => 'images/logo_hogwarts.png',
  ];
  $logoKey = strtolower($houseName);
  $houseLogoPath = $houseLogoMap[$logoKey] ?? 'images/logo_hogwarts.png';
  $houseLogoUrl  = asset($houseLogoPath);

  $now = \Carbon\Carbon::now('Asia/Jakarta');
  $announceDate = $now->day <= 20 ? $now->copy()->day(20) : $now->copy()->addMonthNoOverflow()->day(20);
  $announceFmt  = $announceDate->translatedFormat('l, d F Y');
@endphp

<div class="min-h-screen bg-[#0b0a12] text-[#F1EDE6] relative overflow-hidden">
  <div aria-hidden="true" class="pointer-events-none absolute inset-0">
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 h-[90vh] w-[120vw] bg-[radial-gradient(ellipse_at_center,rgba(255,215,128,0.10),rgba(14,12,24,0)_60%)]"></div>
    <div class="absolute -bottom-20 -left-12 h-56 w-56 rounded-full blur-3xl opacity-20 bg-amber-700/40"></div>
    <div class="absolute -top-16 -right-12 h-56 w-56 rounded-full blur-3xl opacity-20 bg-indigo-700/40"></div>
  </div>

  <main class="relative z-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
      <div class="mb-6 flex justify-end">
        @if ($user->role == "Teacher")
          <a href="{{ route('database') }}" class="me-3 inline-flex items-center gap-2 rounded-lg border border-white/15 bg-white/5 px-3 py-2 text-sm text-amber-100 hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
            (Teacher) Database 
          </a>
        @endif
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="inline-flex items-center gap-2 rounded-lg border border-white/15 bg-white/5 px-3 py-2 text-sm text-amber-100 hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
            Keluar
          </button>
        </form>
      </div>

      <div class="mb-6 sm:mb-8">
        <p class="text-xs uppercase tracking-[0.25em] text-amber-300/70">Hogwarts School</p>
        <h1 class="text-2xl sm:text-3xl font-bold">Selamat datang, {{ auth()->user()->nickname ?? auth()->user()->name ?? 'Peserta' }}!</h1>
        <p class="text-amber-100/70 text-sm mt-1">Ini adalah tiket partisipasimu di <span class="font-semibold">Triwizard House Cup</span>.</p>
      </div>

      <section x-data="{ wa: '{{ $waLink ?? '' }}', copying:false }" class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="relative lg:col-span-2 rounded-2xl border border-amber-400/30 bg-[#0f0c19]/80 shadow-2xl overflow-hidden">

          <div class="z-20 px-5 pt-4 md:px-0 md:pt-0 md:absolute md:top-3 md:right-3">
            <div class="inline-flex items-center gap-2 rounded-xl border border-white/10 bg-[#111018]/70 backdrop-blur px-3 py-2 shadow-lg">
              <img src="{{ $houseLogoUrl }}" alt="House" class="h-5 w-5 md:h-6 md:w-6 object-contain">
              <span class="text-[10px] md:text-xs uppercase tracking-wider text-amber-200/80">House</span>
              <span class="text-sm md:text-base font-semibold">{{ $houseName }}</span>
              @if(!$rawHouse || trim($rawHouse) === '')
                <span class="ml-1 inline-flex items-center rounded-md border border-white/15 bg-white/5 px-2 py-0.5 text-[10px] md:text-xs">Soon</span>
              @endif
            </div>
            <div class="mt-1 text-[10px] md:text-xs text-amber-100/70 md:text-right">
              Pengumuman: {{ $announceFmt }}
            </div>
          </div>

          <div class="flex flex-col md:flex-row">
            <div class="flex-1 p-5 sm:p-7">
              <div class="flex items-center gap-3 mb-4">
                <img src="{{ asset('images/logo_hogwarts.png') }}" alt="Hogwarts" class="h-10 w-10 object-contain">
                <div>
                  <p class="text-[11px] uppercase tracking-widest text-amber-300/80">Admit One</p>
                  <h2 class="text-lg sm:text-xl font-bold leading-tight">Triwizard House Cup — Entry Ticket</h2>
                </div>
              </div>

              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Nama</p>
                  <p class="text-base break-words font-semibold">{{ auth()->user()->name ?? '-' }}</p>
                </div>
                <div>
                  <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Nickname</p>
                  <p class="text-base break-words font-semibold">{{ auth()->user()->nickname ?? '-' }}</p>
                </div>
                <div class="sm:col-span-2">
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
                  <p class="text-sm">{{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y • H:i') }} WIB</p>
                </div>
                <div>
                  <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Ticket No.</p>
                  <p class="text-sm font-mono">HOG-{{ str_pad(auth()->id() ?? 0, 5, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                  <p class="text-[11px] uppercase tracking-wider text-amber-200/70">Status</p>
                  <p class="text-sm font-semibold text-emerald-300">Valid</p>
                </div>
              </div>

              <div class="mt-6 flex flex-col sm:flex-row gap-3">
                <button type="button"
                        @click="if(!wa){alert('Link WhatsApp belum disetel. Hubungi panitia.');} else {window.open(wa,'_blank','noopener');}"
                        class="w-full sm:w-auto text-center inline-flex items-center justify-center gap-2 rounded-lg border border-emerald-400/30 bg-emerald-50/5 px-4 py-2 text-emerald-100 hover:bg-emerald-400/10">
                  Gabung WhatsApp Group
                </button>
              </div>
            </div>

            <div class="relative hidden md:block w-px bg-gradient-to-b from-transparent via-white/20 to-transparent my-6 mr-24 md:mr-24 lg:mr-24"></div>
            <div class="absolute right-24 top-1/2 -translate-y-1/2 hidden md:block">
              <div class="h-8 w-8 rounded-full border border-white/20 bg-[#0b0a12]"></div>
            </div>

          </div>
        </div>

        <aside class="rounded-2xl border border-white/10 bg-white/5 p-4 h-max lg:sticky lg:top-6">
          <h3 class="font-semibold mb-2">Info Acara</h3>
          <ul class="text-sm space-y-1 text-amber-100/80">
            <li><span class="text-amber-300">Hadiah:</span> Piala Triwizard</li>
            <li><span class="text-amber-300">Waktu:</span> Minggu, 26 Oktober • 12.30 WIB</li>
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
            $gmapsQuery = urlencode('Jl. Kepanduan II, RT.7/RW.16, Pejagalan, Kecamatan Penjaringan, Jkt Utara, Daerah Khusus Ibukota Jakarta 14450');
            $gmapsUrl = "https://www.google.com/maps?q={$gmapsQuery}";
          @endphp
          <a href="{{ $gmapsUrl }}" target="_blank" rel="noopener"
             class="mt-3 inline-flex items-center gap-2 rounded-lg border border-emerald-400/30 bg-emerald-50/5 px-3 py-2 text-emerald-100 hover:bg-emerald-400/10 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.686 2 6 4.686 6 8c0 4.637 5.4 11.21 5.63 11.48a.5.5 0 00.74 0C12.6 19.21 18 12.637 18 8c0-3.314-2.686-6-6-6zm0 8.5A2.5 2.5 0 119.5 8 2.5 2.5 0 0112 10.5z"/></svg>
            Buka di Google Maps
          </a>
        </div>
      </div>
    </div>
  </main>
</div>
@endsection
