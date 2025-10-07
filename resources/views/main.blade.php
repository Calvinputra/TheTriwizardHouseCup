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
  </div>

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
