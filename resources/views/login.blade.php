@extends('main')

@section('title', 'Login | Hogwarts Triwizard Portal')
@section('description', 'Halaman login bertema Harry Potter, sederhana dan mobile-friendly.')

@section('content')
<div class="min-h-screen bg-[#0b0a12] text-[#F1EDE6] flex items-center justify-center px-4 py-10 relative overflow-hidden">
  <!-- Background dekorasi ringan (tanpa efek menyilaukan) -->
  <div aria-hidden="true" class="pointer-events-none absolute inset-0">
    <div class="absolute -top-32 left-1/2 -translate-x-1/2 h-[80vh] w-[110vw] bg-[radial-gradient(ellipse_at_center,rgba(255,215,128,0.12),rgba(14,12,24,0)_60%)]"></div>
    <div class="absolute -bottom-24 -left-12 h-56 w-56 rounded-full blur-3xl opacity-25 bg-amber-700/40"></div>
    <div class="absolute -top-24 -right-12 h-56 w-56 rounded-full blur-3xl opacity-25 bg-indigo-700/40"></div>
  </div>

  <main class="relative z-10 w-full max-w-md" x-data="{ showPass:false, email:'{{ old('email') }}', emailTouched:false, isEmailValid(){ return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email) } }">
    <!-- Header / brand -->
    <div class="flex flex-col items-center mb-6">
      <img src="{{ asset('images/logo_hogwarts.png') }}" alt="Hogwarts" class="h-14 w-14 object-contain mb-3"/>
      <div class="text-center">
        <p class="text-xs uppercase tracking-[0.25em] text-amber-300/80">Hogwarts School</p>
        <h1 class="text-2xl font-bold mt-1">Portal Triwizard</h1>
      </div>
    </div>

    <!-- Card -->
    <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm shadow-2xl">
      <div class="p-6 sm:p-7">
        <h2 class="text-lg font-semibold">Masuk ke Akunmu</h2>
        <p class="text-sm text-amber-100/70 mt-1">Gunakan email yang terdaftar di Hogwarts.</p>

        <form method="POST" action="{{ route('signin') }}" class="mt-5 space-y-4" @submit="if(!isEmailValid()){ emailTouched = true; $event.preventDefault(); }">
          @csrf

          <!-- Email -->
          <div>
            <label for="email" class="block text-sm mb-1">Email</label>
            <input id="email" name="email" type="email" required placeholder="harry@hogwarts.edu"
                   x-model="email" @blur="emailTouched=true"
                   class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20"/>
            @error('email')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
            <p x-show="emailTouched && !isEmailValid()" class="mt-1 text-xs text-rose-400">Format email tidak valid.</p>
          </div>

          <!-- Password -->
          <div x-data="{ shake:false }" :class="shake ? 'animate-[wiggle_150ms_ease-in-out_0s_2]' : ''" @invalid.passive="shake=true; setTimeout(()=>shake=false, 400)">
            <label for="password" class="block text-sm mb-1">Password</label>
            <div class="relative">
              <input id="password" name="password" :type="showPass ? 'text' : 'password'" required placeholder="••••••••"
                     class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 pr-10 focus:border-amber-400 focus:ring-amber-400/20"/>
              <button type="button" @click="showPass=!showPass" class="absolute inset-y-0 right-2 inline-flex items-center px-2 text-amber-200/80 hover:text-amber-100" aria-label="Toggle password">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5" x-show="!showPass"><path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 11a4 4 0 110-8 4 4 0 010 8z"/></svg>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5" x-show="showPass"><path d="M3.53 2.47a.75.75 0 011.06 0l16.94 16.94a.75.75 0 11-1.06 1.06l-2.08-2.08A12.55 12.55 0 0112 19C5 19 2 12 2 12a20.2 20.2 0 015.74-6.53L3.53 3.53zM12 7a5 5 0 00-4.64 3.14l1.32 1.32A3.5 3.5 0 0112 8.5c.44 0 .86.08 1.25.23L12 7z"/></svg>
              </button>
            </div>
            @error('password')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
          </div>
          <!-- Submit -->
          <button type="submit" class="w-full inline-flex justify-center items-center gap-2 rounded-lg bg-amber-500 px-5 py-2.5 font-semibold text-[#1b1408] hover:bg-amber-400 active:scale-[.99]">
            Masuk
          </button>
        </form>

        <!-- Divider kecil -->
        <div class="flex items-center gap-3 my-5">
          <div class="h-px flex-1 bg-white/10"></div>
          <span class="text-[11px] uppercase tracking-wider text-amber-100/60">atau</span>
          <div class="h-px flex-1 bg-white/10"></div>
        </div>

        <p class="text-sm text-amber-100/80">Belum punya akun?
          <a href="{{ route('welcome') }}" class="text-amber-200 hover:text-amber-100 underline underline-offset-2">Daftar di sini</a>
        </p>
      </div>
    </div>
    
    <!-- ✉️ Icon Surat -->
       <div class="">
          <button id="openZonk" 
              class="b text-[#1b1408] w-12 h-12 rounded-full flex items-center justify-center shadow-lg active:scale-95 transition-all duration-300">
              <p class="text-white">✦</p>
          </button>
        </div>

    <!-- Catatan footer kecil -->
    <p class="mt-6 text-center text-xs text-amber-100/60">© {{ date('Y') }} Hogwarts — Triwizard House Cup</p>
  </main>
</div>
@endsection

@push('styles')
<!-- Animasi halus untuk wiggle saat invalid password (tanpa framework ekstra) -->
<style>
@keyframes wiggle { 0%,100%{transform:translateX(0)} 25%{transform:translateX(-2px)} 75%{transform:translateX(2px)} }
</style>
@endpush