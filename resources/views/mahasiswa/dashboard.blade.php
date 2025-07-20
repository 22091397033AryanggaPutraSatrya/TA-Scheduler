<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - Bimbingan Akademik</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#07689F',
                        'secondary': '#A2D5F2',
                        'accent': '#FF7E67',
                        'background': '#FAFAFA',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background">

    <div id="mahasiswa-dashboard">
        <header class="bg-white shadow-md p-4">
            <h1 class="text-2xl font-bold text-primary text-center">Dashboard Mahasiswa</h1>
        </header>

        <div class="flex flex-col md:flex-row min-h-screen">
            <!-- Sidebar Mahasiswa -->
            <aside class="w-full md:w-64 bg-primary text-white p-6 flex flex-col">
                <div>
                    <!-- User Profile (Data Dinamis dari Database) -->
                    <div class="text-center">
                        {{-- Mengambil 2 huruf pertama dari nama untuk inisial foto profil --}}
                        @php
                            $initials = strtoupper(substr($mahasiswa->name, 0, 2));
                        @endphp
                        <img src="https://placehold.co/100x100/A2D5F2/07689F?text={{ $initials }}" alt="Foto Profil" class="rounded-full w-24 h-24 mx-auto mb-4 border-4 border-secondary">
                        
                        {{-- Menampilkan nama lengkap user dari database --}}
                        <h2 class="text-xl font-bold">{{ $mahasiswa->name }}</h2>
                        <p class="text-sm text-secondary">Mahasiswa</p>
                    </div>

                    <!-- Navigation -->
                    <nav class="space-y-2 mt-8">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-white/20">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('mahasiswa.booking.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            <span>Jadwal Dosen</span>
                        </a>
                        <a href="{{ route('mahasiswa.draft.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                            <span>Kirim Draft</span>
                        </a>
                    </nav>
                </div>

                <!-- Tombol Logout di bagian bawah sidebar -->
                <div class="mt-auto">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-accent transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Mahasiswa -->
            <main class="flex-1 p-6 md:p-8 bg-background">
                {{-- Mengambil nama depan user untuk sapaan --}}
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang, {{ explode(' ', $mahasiswa->name)[0] }}!</h1>

                <!-- Status Cards (Data ini juga akan dinamis) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
                        <div class="bg-secondary p-3 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-9.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-9.998 12.078 12.078 0 01.665-6.479L12 14z" /></svg></div>
                        <div>
                            <p class="text-sm text-gray-500">Status Tugas Akhir</p>
                            {{-- Contoh data dinamis dari relasi --}}
                            <p class="text-lg font-bold text-primary">{{ $mahasiswa->tugasAkhir->status ?? 'Belum Ada' }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
                        <div class="bg-secondary p-3 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg></div>
                        <div>
                            <p class="text-sm text-gray-500">Dosen Pembimbing</p>
                             {{-- Contoh data dinamis dari relasi --}}
                            <p class="text-lg font-bold text-primary">{{ $mahasiswa->tugasAkhir->dosen->name ?? 'Belum Ada' }}</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
                        <div class="bg-secondary p-3 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg></div>
                        <div>
                            <p class="text-sm text-gray-500">Bimbingan Berikutnya</p>
                            <p class="text-lg font-bold text-primary">Selasa, 22 Juli 2025</p>
                        </div>
                    </div>
                </div>

                <!-- Komponen lainnya akan ditambahkan di sini -->
                <div class="text-center text-gray-500">
                    <p>Konten utama dashboard akan ditampilkan di sini.</p>
                </div>

            </main>
        </div>
    </div>

</body>
</html>