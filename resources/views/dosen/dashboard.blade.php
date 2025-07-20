<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen - Bimbingan Akademik</title>
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

    <!-- =================================================================== -->
    <!-- ====================== DASHBOARD DOSEN ============================ -->
    <!-- =================================================================== -->
    <div id="dosen-dashboard">
        <header class="bg-white shadow-md p-4 mb-8">
            <h1 class="text-2xl font-bold text-primary text-center">Dashboard Dosen</h1>
        </header>

        <div class="flex flex-col md:flex-row">
            <!-- Sidebar Dosen -->
            <aside class="w-full md:w-64 bg-primary text-white p-6 space-y-8">
                <!-- User Profile -->
                <div class="text-center">
                    <img src="https://placehold.co/100x100/A2D5F2/07689F?text=BS" alt="Foto Profil" class="rounded-full w-24 h-24 mx-auto mb-4 border-4 border-secondary">
                    <h2 class="text-xl font-bold">Dr. Budi Santoso</h2>
                    <p class="text-sm text-secondary">Dosen</p>
                </div>

                <!-- Navigation -->
                <nav class="space-y-2">
                    <a href="#dosen-dashboard" class="flex items-center space-x-3 px-4 py-3 rounded-lg bg-white/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="#dosen-atur-jadwal" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Atur Jadwal</span>
                    </a>
                    <a href="#dosen-booking" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-white/10 transition">
                       <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                        <span>Konfirmasi Booking</span>
                    </a>
                </nav>
            </aside>

            <!-- Main Content Dosen -->
            <main class="flex-1 p-6 md:p-8 bg-background">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Selamat Datang, Dr. Budi!</h1>

                <!-- Status Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
                        <div class="bg-orange-100 p-3 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg></div>
                        <div>
                            <p class="text-sm text-gray-500">Permintaan Booking</p>
                            <p class="text-2xl font-bold text-accent">3 Baru</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
                        <div class="bg-secondary p-3 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg></div>
                        <div>
                            <p class="text-sm text-gray-500">Mahasiswa Bimbingan</p>
                            <p class="text-2xl font-bold text-primary">8 Aktif</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-md flex items-center space-x-4">
                        <div class="bg-secondary p-3 rounded-full"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg></div>
                        <div>
                            <p class="text-sm text-gray-500">Jadwal Hari Ini</p>
                            <p class="text-2xl font-bold text-primary">4 Sesi</p>
                        </div>
                    </div>
                </div>

                <!-- Konfirmasi Booking -->
                <div id="dosen-booking" class="bg-white p-6 rounded-xl shadow-md mb-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Permintaan Booking Terbaru</h3>
                    <div class="space-y-4">
                        <!-- Booking Item 1 -->
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between p-4 border rounded-lg">
                            <div>
                                <p class="font-bold text-primary">Citra Lestari</p>
                                <p class="text-sm text-gray-600">Jumat, 25 Juli 2025 - 13:00</p>
                                <p class="text-sm text-gray-500 mt-1">Topik: Revisi Bab 2</p>
                            </div>
                            <div class="flex space-x-2 mt-3 md:mt-0">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition text-sm font-semibold">Konfirmasi</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition text-sm font-semibold">Tolak</button>
                            </div>
                        </div>
                        <!-- Booking Item 2 -->
                        <div class="flex flex-col md:flex-row items-start md:items-center justify-between p-4 border rounded-lg">
                            <div>
                                <p class="font-bold text-primary">Eko Wijoyo</p>
                                <p class="text-sm text-gray-600">Jumat, 25 Juli 2025 - 14:00</p>
                                <p class="text-sm text-gray-500 mt-1">Topik: Pengajuan Judul Baru</p>
                            </div>
                             <div class="flex space-x-2 mt-3 md:mt-0">
                                <button class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition text-sm font-semibold">Konfirmasi</button>
                                <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition text-sm font-semibold">Tolak</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Atur Jadwal -->
                <div id="dosen-atur-jadwal" class="bg-white p-6 rounded-xl shadow-md mb-8">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">Atur Jadwal Ketersediaan</h3>
                        <button class="bg-accent text-white font-bold py-2 px-4 rounded-lg hover:bg-orange-600 transition">Tambah Jadwal</button>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <p><span class="font-bold text-primary">Senin:</span> 09:00 - 11:00 (Sesi 30 menit)</p>
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                <button class="text-red-600 hover:text-red-800">Hapus</button>
                            </div>
                        </div>
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <p><span class="font-bold text-primary">Selasa:</span> 10:00 - 12:00 (Sesi 30 menit)</p>
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                <button class="text-red-600 hover:text-red-800">Hapus</button>
                            </div>
                        </div>
                         <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <p><span class="font-bold text-primary">Jumat:</span> 13:00 - 15:00 (Sesi 60 menit)</p>
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                <button class="text-red-600 hover:text-red-800">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Atur Status Tugas Akhir -->
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Manajemen Status Tugas Akhir Mahasiswa</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-3 font-semibold text-gray-600">Nama Mahasiswa</th>
                                    <th class="p-3 font-semibold text-gray-600">Status Saat Ini</th>
                                    <th class="p-3 font-semibold text-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="p-3 text-primary font-medium">Andi Pratama</td>
                                    <td class="p-3"><span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Dikerjakan</span></td>
                                    <td class="p-3">
                                        <select class="rounded-md border-gray-300 shadow-sm text-sm">
                                            <option>Ubah Status</option>
                                            <option value="revisi">Revisi</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <td class="p-3 text-primary font-medium">Citra Lestari</td>
                                    <td class="p-3"><span class="bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Revisi</span></td>
                                    <td class="p-3">
                                        <select class="rounded-md border-gray-300 shadow-sm text-sm">
                                            <option>Ubah Status</option>
                                            <option value="dikerjakan">Dikerjakan</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <td class="p-3 text-primary font-medium">Dewi Anggraini</td>
                                    <td class="p-3"><span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">Selesai</span></td>
                                    <td class="p-3">
                                        <span class="text-gray-400">Tidak ada aksi</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>
