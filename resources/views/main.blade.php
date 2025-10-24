<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="@yield('description', 'Default Description')">
  <link rel="icon" href="{{ asset('images/logo_hogwarts.png') }}" type="image/png">
  <title>@yield('title', 'Default Title')</title>

  <!-- CSS -->
  <link href="{{ asset('css/output.css') }}" rel="stylesheet">
  <link href="https://cdn.datatables.net/2.2.1/css/dataTables.tailwindcss.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="{{ asset('css/sscp.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- JS libs -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.tailwindcss.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <!-- Preline pakai CDN, jangan /node_modules -->
  <script src="https://cdn.jsdelivr.net/npm/preline/dist/preline.min.js"></script>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * { font-family: 'Poppins', sans-serif; }
    body { background-color: #f9fbfc; }
    .dt-buttons { margin-bottom: 1rem; }
    .filter-btns button { margin-right: .5rem; }
    table tbody tr:nth-child(odd) td { background-color: #fff; }
    table tbody tr:nth-child(even) td { background-color: rgb(233,226,226); }
  </style>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="mx-auto">

    @yield('content')
    <!-- ✉️ Modal Surat ZONK -->
  <div id="zonkModal" class="fixed inset-0 z-50 hidden bg-black/80 backdrop-blur-sm flex items-center justify-center p-4 transition">
      <div class="relative bg-gradient-to-b from-[#2b0000] to-[#4a0505] rounded-2xl shadow-2xl max-w-md w-full text-red-100 border border-red-800/40 overflow-hidden">
          <div class="relative p-6 text-center">
              <img src="{{ asset('images/logo_hogwarts.png') }}" alt="Zonk Letter"
                  class="h-20 mx-auto mb-4 animate-bounce-slow drop-shadow-md">
              <h2 class="text-3xl font-extrabold mb-2 tracking-wide text-red-400">ZONK!</h2>
              <p class="text-base text-red-200 italic mb-4">Ups... Sepertinya salah Klik itu salah.</p>
              <p class="text-sm mb-5 text-red-300/90">
                  Surat ini hanyalah jebakan 🤪🤪<br>
                  Coba lagi — 🤪🤪🤪
              </p>
              <button id="closeZonk"
                  class="px-5 py-2.5 rounded-lg bg-red-600 text-[#1b0000] font-semibold hover:bg-red-500 active:scale-[.98] transition">
                  Tutup Surat Zonk
              </button>
          </div>
      </div>
  </div>

  </div>

<script>
     document.addEventListener('DOMContentLoaded', () => {
        const openZonk = document.getElementById('openZonk');
        const zonkModal = document.getElementById('zonkModal');
        const closeZonk = document.getElementById('closeZonk');

        // Jika elemen ada di halaman ini, baru aktifkan fungsinya
        if (openZonk && zonkModal) {
            openZonk.addEventListener('click', (e) => {
                e.preventDefault();
                zonkModal.classList.remove('hidden');
                zonkModal.classList.add('animate-fadein');
            });
        }

        if (closeZonk && zonkModal) {
            closeZonk.addEventListener('click', () => {
                zonkModal.classList.add('hidden');
            });
        }

        // Tambahkan animasi global hanya sekali
        if (!document.getElementById('zonk-style')) {
          const style = document.createElement('style');
          style.id = 'zonk-style';
          style.innerHTML = `
            @keyframes fadein {
                from { opacity: 0; transform: scale(0.95); }
                to { opacity: 1; transform: scale(1); }
            }
            .animate-fadein {
                animation: fadein 0.4s ease-out;
            }
            @keyframes bounce-slow {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
            .animate-bounce-slow {
                animation: bounce-slow 2s infinite;
            }
          `;
          document.head.appendChild(style);
        }
      });
</script>

  <script>
    function confirmDelete(formId) {
      const form = document.getElementById(formId);
      if (!form) return console.error("Form not found:", formId);
      Swal.fire({
        title: "Apakah Anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal"
      }).then((r) => r.isConfirmed && form.submit());
    }
  </script>
</body>
</html>
