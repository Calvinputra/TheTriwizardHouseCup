@extends('main')

@section('title', 'Welcome to Hogwarts | Triwizard House Cup')
@section('description', 'Halaman sambutan bertema Harry Potter dengan opsi daftar Triwizard House Cup atau login – kini lebih interaktif dengan efek magic di hover/click dan ramah mobile.')

@section('content')
<div x-data="wizardUI()" x-init="init()" @mousemove.window="onMove($event)" class="min-h-screen bg-[#0b0a12] text-[#F1EDE6] relative overflow-hidden">
  <!-- ===== Global Effects & Styles ===== -->
  <style>
    /* Spotlight mengikuti kursor */
    .spotlight{
      background: radial-gradient(300px 300px at var(--mx,50%) var(--my,20%), rgba(251,191,36,0.10), rgba(0,0,0,0));
      pointer-events:none;
    }
    /* Shine/gleam efek tombol */
    .btn-shine{
      position: relative; overflow: hidden; isolation:isolate;
    }
    .btn-shine::after{
      content:""; position:absolute; inset:-200% -30%; transform: rotate(25deg);
      background: linear-gradient(90deg, transparent 0 30%, rgba(255,255,255,.45) 48%, transparent 60% 100%);
      animation: shine 5s linear infinite;
    }
    @keyframes shine{ to{ transform: translateX(120%) rotate(25deg);} }

    /* Partikel bintang lembut */
    @keyframes floaty { 0%{ transform:translateY(0)} 50%{ transform:translateY(-8px)} 100%{ transform:translateY(0)} }
    .star{ position:absolute; width:2px; height:2px; background:#fff; border-radius:999px; opacity:.6; animation: floaty 6s ease-in-out infinite; }

    /* Card tilt halus (fallback bila JS mati) */
    .tilt:hover{ transform: translateY(-2px); }

    /* Pop forward saat diklik */
    .pop{ transform: translateZ(0) scale(1.02); box-shadow:0 20px 60px rgba(255,200,100,.08), 0 0 0 1px rgba(255,255,255,.06) inset; }

    /* Prefer reduce motion */
    @media (prefers-reduced-motion: reduce){
      .btn-shine::after{ animation: none; }
      .star{ animation: none; }
    }
  </style>

  <!-- Cursor spotlight & subtle grid of stars -->
  <div aria-hidden="true" class="spotlight absolute inset-0 z-0"></div>
  <template x-for="s in stars" :key="s.id">
    <span class="star" :style="`left:${s.x}%; top:${s.y}%; animation-delay:${s.d}s;`"></span>
  </template>

  <!-- Background decorations -->
  <div aria-hidden="true" class="pointer-events-none absolute inset-0">
    <div class="absolute -top-1/2 left-1/2 -translate-x-1/2 h-[120vh] w-[120vw] bg-[radial-gradient(ellipse_at_center,rgba(255,215,128,0.12),rgba(14,12,24,0)_60%)]"></div>
    <div class="absolute -bottom-16 -left-16 h-72 w-72 rounded-full blur-3xl opacity-30 bg-amber-700/40"></div>
    <div class="absolute -top-16 -right-16 h-72 w-72 rounded-full blur-3xl opacity-30 bg-indigo-700/40"></div>
    <div class="absolute inset-0 [background-image:radial-gradient(1px_1px_at_20px_30px,rgba(255,255,255,0.35),transparent),radial-gradient(1px_1px_at_120px_130px,rgba(255,255,255,0.27),transparent),radial-gradient(1px_1px_at_220px_80px,rgba(255,255,255,0.27),transparent),radial-gradient(2px_2px_at_60%_40%,rgba(255,255,255,0.22),transparent)]"></div>
  </div>

  <!-- Mobile subtle top fade -->
  <div class="absolute inset-x-0 top-0 h-2 bg-gradient-to-b from-black/10 to-transparent sm:hidden"></div>

  <header class="relative z-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4 sm:py-6 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <img src="{{ asset('images/logo_hogwarts.png') }}" alt="Hogwarts" class="h-10 w-10 object-contain drop-shadow"/>
        <div>
          <p class="text-xs uppercase tracking-widest text-amber-300/80">Hogwarts School</p>
          <h1 class="text-xl font-semibold tracking-wide">The Triwizard House Cup</h1>
        </div>
      </div>
      <div class="hidden sm:flex items-center gap-3">
        <a href="{{ route('login') }}" class="btn-shine inline-flex items-center gap-2 rounded-lg border border-amber-400/30 bg-amber-50/5 px-4 py-2 text-amber-200 hover:bg-amber-400/10 transition active:scale-[.98]">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9A2.25 2.25 0 002.25 5.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/></svg>
          Login
        </a>
      </div>
    </div>
  </header>

  <main class="relative z-10">
    <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-12 sm:pb-16 pt-6 lg:pt-10">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
        <!-- Left: Hero / CTA -->
        <div class="flex flex-col justify-center">
          <div class="inline-flex items-center gap-2 rounded-full border border-amber-400/30 bg-amber-50/5 px-3 py-1 text-[11px] uppercase tracking-widest text-amber-200 mb-4 w-fit">
            <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
            Welcome, Aogers & Coach Pin
          </div>
          <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight">
            Selamat datang di <span class="text-amber-300">Hogwarts</span> —
            buktikan kemampuanmu di <span class="text-indigo-300">Triwizard House Cup</span>
          </h2>
          <p class="mt-3 sm:mt-4 text-amber-100/80 leading-relaxed text-[15px] sm:text-base">
            Daftarkan dirimu untuk bertanding mewakili Housemu yaitu <em>Gryffindor</em>, <em>Slytherin</em>, <em>Ravenclaw</em>, atau <em>Hufflepuff</em>.
            <br>Satu halaman ini menyediakan pilihan untuk <span class="font-semibold">Daftar</span> atau langsung <span class="font-semibold">Login</span> jika kamu sudah memiliki akun.
          </p>

          <div class="mt-5 sm:mt-6 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            <button
              @click="toggleForm(); pulseMagic($event)"
              class="btn-shine inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-amber-500 px-5 py-3 font-semibold text-[#1b1408] hover:bg-amber-400 active:scale-[.99] shadow-[0_4px_24px_rgba(245,158,11,0.25)]">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M11.25 4.5l.338 2.369a2.25 2.25 0 001.943 1.943L15.9 9.15l-2.369.338a2.25 2.25 0 00-1.943 1.943L11.25 13.5l-.338-2.069a2.25 2.25 0 00-1.943-1.943L6.6 9.15l2.369-.338a2.25 2.25 0 001.943-1.943L11.25 4.5z"/></svg>
              Daftarkan Diri
            </button>

            <a href="{{ route('login') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg border border-amber-400/30 bg-amber-50/5 px-5 py-3 text-amber-100/90 hover:bg-amber-400/10 active:scale-[.98]">
              Sudah punya akun? Login
            </a>
          </div>

          <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-xl sm:max-w-none">
            <!-- Hadiah -->
            <div @mouseenter="breathe($event)" @click="pop($event)" class="tilt rounded-xl border border-amber-400/20 bg-white/5 p-4 transition will-change-transform">
              <p class="text-sm text-amber-200">Hadiah</p>
              <p class="text-lg font-semibold">Piala Triwizard</p>
            </div>

            <!-- Tanggal & Jam -->
            <div @mouseenter="breathe($event)" @click="pop($event)" class="tilt rounded-xl border border-indigo-400/20 bg-white/5 p-4 transition will-change-transform">
              <p class="text-sm text-indigo-200">Tanggal & Jam</p>
              <p class="text-lg font-semibold">Minggu, 26 Oktober • 12.30 WIB</p>
            </div>
          </div>

          <div class="mt-8 grid grid-cols-1 gap-4 max-w-xl sm:max-w-none">
            <!-- Lokasi + Google Maps -->
            <div @mouseenter="breathe($event)" @click="pop($event)" class="tilt rounded-xl border border-emerald-400/20 bg-white/5 p-4 transition will-change-transform">
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
                 class="mt-3 inline-flex items-center gap-2 rounded-lg border border-emerald-400/30 bg-emerald-50/5 px-3 py-2 text-emerald-100 hover:bg-emerald-400/10 transition active:scale-[.98]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                  <path d="M12 2C8.686 2 6 4.686 6 8c0 4.637 5.4 11.21 5.63 11.48a.5.5 0 00.74 0C12.6 19.21 18 12.637 18 8c0-3.314-2.686-6-6-6zm0 8.5A2.5 2.5 0 119.5 8 2.5 2.5 0 0112 10.5z"/>
                </svg>
                Buka di Google Maps
              </a>
            </div>
          </div>
        </div>

        <!-- Right: Card + Form (toggle) -->
        <div class="relative mt-8 lg:mt-0">
          <div class="rounded-2xl border border-white/10 bg-white/5 backdrop-blur-xl shadow-2xl max-w-xl mx-auto lg:max-w-none">
            <div class="p-6 sm:p-8">
              <div class="flex items-start justify-between gap-4">
                <div>
                  <h3 class="text-xl font-bold">Form Pendaftaran — Triwizard House Cup</h3>
                  <p class="text-amber-100/70 text-sm">Isi data di bawah ini untuk mewakili rumah pilihanmu.</p>
                </div>
                <button @click="toggleForm()" class="inline-flex items-center gap-2 rounded-lg border border-amber-400/30 bg-amber-50/5 px-3 py-1.5 text-xs hover:bg-amber-400/10">
                  <span x-text="showForm ? 'Sembunyikan' : 'Tampilkan'"></span>
                </button>
              </div>

              <form x-show="showForm" x-cloak method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                @csrf
                <!-- Nama -->
                <div class="sm:col-span-2">
                  <label for="wizard-name" class="block text-sm mb-1">Nama Lengkap</label>
                  <input id="wizard-name" name="name" type="text" required placeholder="Harry James Potter"
                         class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20"/>
                  @error('name')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
                </div>

                <!-- Email -->
                <div>
                  <label for="wizard-email" class="block text-sm mb-1">Email</label>
                  <input id="wizard-email" name="email" type="email" required placeholder="harry@hogwarts.edu"
                         class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20"/>
                  @error('email')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
                </div>

                <!-- Umur -->
                <div>
                  <label for="wizard-age" class="block text-sm mb-1">Umur</label>
                  <input id="wizard-age" name="age" type="number" min="11" max="25" required placeholder="17"
                         class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20"/>
                  @error('age')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
                </div>

                <!-- House -->
                <div>
                  <label for="wizard-house" class="block text-sm mb-1">Pilih House</label>
                  <select id="wizard-house" name="house" required class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20">
                    <option value="" class="text-slate-700">— Pilih —</option>
                    <option value="Gryffindor">Gryffindor</option>
                    <option value="Slytherin">Slytherin</option>
                    <option value="Ravenclaw">Ravenclaw</option>
                    <option value="Hufflepuff">Hufflepuff</option>
                  </select>
                  @error('house')<p class="mt-1 text-xs text-rose-400">{{ $message }}</p>@enderror
                </div>

                <!-- Tongkat Sihir -->
                <div>
                  <label for="wand-core" class="block text-sm mb-1">Inti Tongkat</label>
                  <select id="wand-core" name="wand_core" class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20">
                    <option value="Phoenix Feather">Phoenix Feather</option>
                    <option value="Dragon Heartstring">Dragon Heartstring</option>
                    <option value="Unicorn Hair">Unicorn Hair</option>
                  </select>
                </div>

                <!-- Skill -->
                <div class="sm:col-span-2">
                  <label class="block text-sm mb-2">Keahlian Utama</label>
                  <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 sm:gap-3">
                    @foreach($skills as $s)
                      <label class="inline-flex items-center gap-2 rounded-lg border border-white/10 bg-white/5 px-3 py-2 cursor-pointer hover:bg-white/10 transition">
                        <input type="checkbox" name="skills[]" value="{{ $s }}" class="h-4 w-4 rounded border-white/20 bg-[#0e0c17] text-amber-500 focus:ring-amber-400">
                        <span class="text-sm">{{ $s }}</span>
                      </label>
                    @endforeach
                  </div>
                </div>

                <!-- Motivasi -->
                <div class="sm:col-span-2">
                  <label for="motivation" class="block text-sm mb-1">Motivasi</label>
                  <textarea id="motivation" name="motivation" rows="3" placeholder="Ceritakan kenapa kamu pantas mewakili rumahmu..." class="w-full rounded-lg bg-[#0e0c17]/60 border border-white/10 text-amber-50 placeholder:text-amber-200/40 px-3 py-2.5 focus:border-amber-400 focus:ring-amber-400/20"></textarea>
                </div>

                <!-- Foto -->
                <div class="sm:col-span-2">
                  <label for="photo" class="block text-sm mb-1">Foto (opsional)</label>
                  <input id="photo" name="photo" type="file" accept="image/*" class="block w-full text-sm file:mr-3 file:rounded-md file:border-0 file:bg-amber-500 file:px-3 file:py-2 file:text-[#1b1408] hover:file:bg-amber-400 cursor-pointer"/>
                </div>

                <!-- Persetujuan -->
                <div class="sm:col-span-2 flex items-start gap-3">
                  <input id="consent" name="consent" type="checkbox" required class="mt-1 h-4 w-4 rounded border-white/20 bg-[#0e0c17] text-amber-500 focus:ring-amber-400">
                  <label for="consent" class="text-sm">Saya menyetujui aturan Hogwarts dan siap bertanding secara sportif.</label>
                </div>

                <!-- Actions -->
                <div class="sm:col-span-2 mt-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                  <button type="submit" @click.prevent="submitWithMagic($event)" class="btn-shine inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg bg-amber-500 px-5 py-3 font-semibold text-[#1b1408] hover:bg-amber-400 active:scale-[.99]">
                    <span x-show="!submitting">Kirim Pendaftaran</span>
                    <span x-show="submitting" class="inline-flex items-center gap-2"><svg class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="9" stroke="currentColor" stroke-opacity=".2" stroke-width="3"/><path d="M21 12a9 9 0 0 0-9-9" stroke="currentColor" stroke-width="3"/></svg> Mengirim...</span>
                  </button>
                  <a href="{{ route('login') }}" class="inline-flex w-full sm:w-auto justify-center items-center gap-2 rounded-lg border border-amber-400/30 bg-amber-50/5 px-5 py-3 text-amber-100/90 hover:bg-amber-400/10 active:scale-[.98]">
                    Login saja
                  </a>
                </div>
              </form>

              <div x-show="!showForm" x-cloak class="mt-6 rounded-xl border border-white/10 bg-white/5 p-4 text-sm text-amber-100/80">
                Klik <span class="font-semibold text-amber-200">“Daftarkan Diri”</span> untuk menampilkan formulir. Jika sudah punya akun, langsung <a href="{{ route('login') }}" class="underline decoration-amber-400/60 hover:text-amber-200">login</a>.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Houses Banner -->
    <section class="pb-12 sm:pb-16">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4">
          @foreach($houses as $h)
            @php
              $key  = \Illuminate\Support\Str::slug($h['name']); // gryffindor, dsb
              $path = "images/logo_{$key}.png";
              $logo = file_exists(public_path($path)) ? asset($path) : asset('images/logo_hogwarts.png');
            @endphp

            <!-- House Card Interaktif: tilt + glow + tap-pop -->
            <div x-data="tiltCard()" @mousemove="onMouseMove($event)" @mouseenter="onEnter" @mouseleave="onLeave" @click="onClick"
                 class="relative rounded-xl border border-white/10 bg-gradient-to-br {{ $h['bg'] }} to-transparent p-4 ring-1 {{ $h['ring'] }} flex items-start gap-3 transition will-change-transform select-none">
              <div class="pointer-events-none absolute inset-0 rounded-xl opacity-0" :class="{'opacity-100': hover}" :style="`background: radial-gradient(300px 200px at ${mx}% ${my}%, rgba(251,191,36,.18), transparent 60%);`"></div>
              <img src="{{ $logo }}" alt="Logo {{ $h['name'] }}" class="h-10 w-10 shrink-0 object-contain rounded-md bg-white/10 ring-1 ring-white/10" loading="lazy">
              <div class="relative z-[1]">
                <p class="text-[11px] uppercase tracking-wider opacity-80">House</p>
                <p class="text-lg font-bold leading-tight">{{ $h['name'] }}</p>
                <p class="text-xs opacity-80 mt-1">{{ $h['desc'] }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  </main>

  <footer class="relative z-10 border-t border-white/10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-amber-100/70">
      <p>© {{ date('Y') }} Hogwarts — Triwizard House Cup</p>
      <p class="flex items-center gap-2">Made with <span class="text-amber-300">✦</span> Coach Pin</p>
    </div>
  </footer>
</div>

<!-- ===== Alpine JS Helpers (gunakan Alpine v3+) ===== -->
<script>
  function wizardUI(){
    return {
      showForm: false,
      submitting: false,
      stars: [],
      init(){
        // generate bintang ringan di latar
        const n = 35; // ringan agar ramah mobile
        for(let i=0;i<n;i++){
          this.stars.push({ id:i, x: Math.random()*100, y: Math.random()*100, d: (Math.random()*6).toFixed(2) })
        }
      },
      onMove(e){
        const root = document.documentElement;
        root.style.setProperty('--mx', (e.clientX/window.innerWidth*100)+'%');
        root.style.setProperty('--my', (e.clientY/window.innerHeight*100)+'%');
      },
      toggleForm(){
        this.showForm = !this.showForm;
        if(this.showForm){
          requestAnimationFrame(()=> document.getElementById('wizard-name')?.focus());
        }
      },
      pulseMagic(evt){
        // ripple lembut dari titik klik
        const btn = evt.currentTarget;
        const ripple = document.createElement('span');
        const rect = btn.getBoundingClientRect();
        const x = evt.clientX - rect.left; const y = evt.clientY - rect.top;
        Object.assign(ripple.style,{
          position:'absolute', left:(x-10)+'px', top:(y-10)+'px', width:'20px', height:'20px', borderRadius:'999px',
          background:'rgba(255,255,255,.45)', filter:'blur(2px)', transform:'scale(0)', opacity:'0.9', pointerEvents:'none', transition:'transform .6s ease, opacity .8s ease'
        });
        btn.appendChild(ripple);
        requestAnimationFrame(()=>{ ripple.style.transform='scale(8)'; ripple.style.opacity='0';});
        setTimeout(()=> ripple.remove(), 800);
      },
      submitWithMagic(evt){
        this.submitting = true;
        // demo: submit form asli setelah sedikit delay agar terlihat efek
        setTimeout(()=>{ evt.target.closest('form').submit(); }, 350);
      }
    }
  }

  function tiltCard(){
    return {
      hover:false, mx:50, my:50, popState:false,
      onEnter(){ this.hover=true; },
      onLeave(e){ this.hover=false; this.mx=50; this.my=50; this.setTilt(e.currentTarget, 0, 0); e.currentTarget.classList.remove('pop'); },
      onMouseMove(e){
        const el = e.currentTarget; const r = el.getBoundingClientRect();
        const px = (e.clientX - r.left)/r.width; const py = (e.clientY - r.top)/r.height;
        this.mx = Math.round(px*100); this.my = Math.round(py*100);
        const rotX = (py - .5) * -6; const rotY = (px - .5) * 6;
        this.setTilt(el, rotX, rotY);
      },
      onClick(e){
        const el = e.currentTarget; el.classList.add('pop');
        // kecilkan setelah 600ms agar terasa "maju sebentar"
        setTimeout(()=> el.classList.remove('pop'), 600);
      },
      setTilt(el, x, y){
        el.style.transform = `perspective(800px) rotateX(${x}deg) rotateY(${y}deg)`;
      }
    }
  }
</script>
@endsection