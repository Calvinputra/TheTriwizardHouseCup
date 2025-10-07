@extends('main')

@section('title', 'Database | Hogwarts Triwizard Portal')
@section('description', 'Halaman untuk guru mengatur House setiap peserta.')

@section('content')
@php
  $user = auth()->user();
  $houses = ['Gryffindor', 'Slytherin', 'Ravenclaw', 'Hufflepuff', 'Hogwarts'];
@endphp

<div class="min-h-screen bg-[#0b0a12] text-[#F1EDE6] relative overflow-hidden">
  {{-- Background efek cahaya --}}
  <div aria-hidden="true" class="pointer-events-none absolute inset-0">
    <div class="absolute -top-24 left-1/2 -translate-x-1/2 h-[90vh] w-[120vw] 
      bg-[radial-gradient(ellipse_at_center,rgba(255,215,128,0.10),rgba(14,12,24,0)_60%)]"></div>
    <div class="absolute -bottom-20 -left-12 h-56 w-56 rounded-full blur-3xl opacity-20 bg-amber-700/40"></div>
    <div class="absolute -top-16 -right-12 h-56 w-56 rounded-full blur-3xl opacity-20 bg-indigo-700/40"></div>
  </div>

  <main class="relative z-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 sm:py-12">

      {{-- Header --}}
      <div class="mb-6 flex justify-between items-center">
        <div>
          <p class="text-xs uppercase tracking-[0.25em] text-amber-300/70">Hogwarts School</p>
          <h1 class="text-2xl sm:text-3xl font-bold text-amber-100">Database Peserta</h1>
          <p class="text-amber-100/70 text-sm mt-1">Kelola House untuk setiap peserta dan lihat statistiknya di bawah.</p>
        </div>
        <a href="{{ route('home') }}" 
           class="inline-flex items-center gap-2 rounded-lg border border-white/15 bg-white/5 px-3 py-2 
           text-sm text-amber-100 hover:bg-white/10">
          ← Kembali ke Beranda
        </a>
      </div>

      {{-- Tabel Peserta --}}
      <div class="overflow-x-auto rounded-xl border border-amber-400/10 bg-[#1a1625]/90 shadow-lg">
        <table class="min-w-full text-sm text-left text-amber-100">
          <thead class="bg-[#14111c] text-xs uppercase text-amber-300 border-b border-amber-400/20">
            <tr>
              <th class="px-4 py-3 font-semibold tracking-wider">#</th>
              <th class="px-4 py-3 font-semibold tracking-wider">Nama</th>
              <th class="px-4 py-3 font-semibold tracking-wider">Email</th>
              <th class="px-4 py-3 font-semibold tracking-wider">Nickname</th>
              <th class="px-4 py-3 font-semibold tracking-wider">Umur</th>
              <th class="px-4 py-3 font-semibold tracking-wider">House</th>
              <th class="px-4 py-3 text-center font-semibold tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $i => $u)
              <tr class="border-t border-amber-400/10 hover:bg-[#201b2e]/80 transition-colors">
                <td class="px-4 py-3 text-amber-200/80">{{ $i + 1 }}</td>
                <td class="px-4 py-3 font-semibold text-amber-100">{{ $u->name }}</td>
                <td class="px-4 py-3 text-amber-100/80">{{ $u->email }}</td>
                <td class="px-4 py-3 text-amber-100/80">{{ $u->nickname ?? '-' }}</td>
                <td class="px-4 py-3 text-amber-100/80">{{ $u->age ?? '-' }}</td>
                <td class="px-4 py-3">
                  <form method="POST" action="{{ route('update.house', $u->id) }}" class="flex items-center gap-2">
                    @csrf
                    @method('PUT')
                    <select name="house" 
                            class="bg-[#1b1827] border border-amber-400/20 rounded-md px-2 py-1 text-sm 
                                   focus:border-amber-400 focus:ring-amber-400/30 text-amber-100">
                      @foreach($houses as $h)
                        <option value="{{ $h }}" {{ strtolower($u->house) == strtolower($h) ? 'selected' : '' }}>
                          {{ $h }}
                        </option>
                      @endforeach
                    </select>
                    <button type="submit"
                      class="inline-flex items-center rounded-md border border-amber-400/30 bg-amber-400/10 px-2 py-1 
                             text-xs hover:bg-amber-400/20 hover:text-amber-100 transition">
                      Simpan
                    </button>
                  </form>
                </td>
                <td class="px-4 py-3 text-center">
                  <form method="POST" action="{{ route('delete.user', $u->id) }}">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus user ini?')" 
                            class="text-red-400 hover:text-red-300">
                      Hapus
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      {{-- Rekap per House --}}
      @php
        $housesData = [
          'Gryffindor' => ['color' => '#a83232'],
          'Slytherin'  => ['color' => '#1c5e3c'],
          'Ravenclaw'  => ['color' => '#203c7a'],
          'Hufflepuff' => ['color' => '#9f7a1f'],
        ];
      @endphp

      <div class="mt-10 space-y-8">
        @foreach($housesData as $house => $data)
          @php
            $members = $users->where('house', $house);
          @endphp

          <div class="bg-[#14111c] border border-amber-400/20 rounded-xl p-5">
            <div class="flex justify-between items-center mb-3">
              <h2 class="text-xl font-bold" style="color: {{ $data['color'] }}">{{ $house }}</h2>
              <span class="text-sm text-amber-200/80">{{ $members->count() }} Peserta</span>
            </div>
            @if($members->count() > 0)
              <ul class="list-disc pl-5 space-y-1 text-amber-100/80">
                @foreach($members as $m)
                  <li>{{ $m->name }} <span class="text-amber-200/60 text-xs">({{ $m->email }})</span></li>
                @endforeach
              </ul>
            @else
              <p class="text-amber-200/50 italic">Belum ada peserta di House ini.</p>
            @endif
          </div>
        @endforeach
      </div>

    </div>
  </main>
</div>
@endsection
