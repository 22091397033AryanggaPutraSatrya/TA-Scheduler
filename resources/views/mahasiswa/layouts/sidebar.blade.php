<aside class="w-full md:w-64 bg-primary text-white p-6 flex flex-col">
    <div>
        <!-- User Profile -->
        <div class="text-center">
            {{-- Mengambil 2 huruf pertama dari nama untuk inisial foto profil --}}
            @php
                // Menggunakan Auth::user() agar komponen ini mandiri
                $user = Auth::user();
                $initials = strtoupper(substr($user->name, 0, 2));
            @endphp
            <img src="https://placehold.co/100x100/A2D5F2/07689F?text={{ $initials }}" alt="Foto Profil" class="rounded-full w-24 h-24 mx-auto mb-4 border-4 border-secondary">
            
            {{-- Menampilkan nama lengkap user dari database --}}
            <h2 class="text-xl font-bold">{{ $user->name }}</h2>
            <p class="text-sm text-secondary">Mahasiswa</p>
        </div>

        <!-- Navigation -->
        <nav class="space-y-2 mt-8">
            {{-- Menggunakan helper request()->routeIs() untuk menandai link aktif --}}
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('dashboard') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('mahasiswa.booking') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('mahasiswa.booking') ? 'bg-white/20' : 'hover:bg-white/10' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                <span>Jadwal Dosen</span>
            </a>
            <a href="{{ route('mahasiswa.draft') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg transition {{ request()->routeIs('mahasiswa.draft') ? 'bg-white/20' : 'hover:bg-white/10' }}">
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