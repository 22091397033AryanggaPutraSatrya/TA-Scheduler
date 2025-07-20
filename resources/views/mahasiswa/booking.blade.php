<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dosen {{ isset($dosen) ? '- ' . $dosen->name : '' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
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

    <div id="booking-page">
        <div class="flex flex-col md:flex-row min-h-screen">
            
            {{-- Memanggil komponen sidebar --}}
            @include('mahasiswa.layouts.sidebar')

            <!-- Main Content -->
            <main class="flex-1 p-6 md:p-8 bg-background" x-data="{ modalOpen: false, selectedDate: '', selectedTime: '' }">
                @if ($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg" role="alert">
                        <p class="font-bold">Terjadi Masalah</p>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Jadwal Bimbingan</h1>
                    <p class="text-lg text-gray-600 mb-6">Pilih slot waktu yang tersedia untuk booking bimbingan dengan <strong>{{ $dosen->name }}</strong>.</p>
                    
                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-gray-800">Jadwal Minggu Ini</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                            @forelse ($weekSchedule as $date => $schedule)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <p class="font-bold text-center text-primary mb-3">{{ $schedule['dayName'] }}</p>
                                    <p class="text-sm text-center text-gray-500 mb-3">{{ $schedule['date']->format('d M Y') }}</p>
                                    <div class="grid grid-cols-2 gap-2">
                                        @if (empty($schedule['slots']))
                                            <div class="col-span-2 text-center text-gray-400 py-4 text-sm">Tidak ada jadwal</div>
                                        @else
                                            @foreach ($schedule['slots'] as $slot)
                                                @if ($slot['status'] === 'available')
                                                    <button 
                                                        data-date="{{ $date }}"
                                                        data-time="{{ $slot['time'] }}"
                                                        @click="modalOpen = true; selectedDate = $el.dataset.date; selectedTime = $el.dataset.time"
                                                        class="bg-primary text-white py-2 rounded-lg hover:bg-blue-800 transition text-sm">
                                                        {{ $slot['time'] }}
                                                    </button>
                                                @else
                                                    <button class="bg-gray-300 text-gray-500 py-2 rounded-lg cursor-not-allowed text-sm" disabled>
                                                        {{ $slot['time'] }}
                                                    </button>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="col-span-full text-center text-gray-500 py-8">Tidak ada jadwal yang tersedia untuk minggu ini.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Booking Modal -->
                    <div x-show="modalOpen" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" @keydown.escape.window="modalOpen = false">
                        <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-lg" @click.outside="modalOpen = false">
                            <h3 class="text-2xl font-bold text-primary mb-2">Konfirmasi Booking Bimbingan</h3>
                            <p class="text-gray-600 mb-6">
                                Anda akan membuat janji pada <strong x-text="selectedDate"></strong> pukul <strong x-text="selectedTime"></strong>.
                            </p>
                            
                            <form method="POST" action="{{ route('mahasiswa.booking.store') }}">
                                @csrf
                                <input type="hidden" name="tanggal" :value="selectedDate">
                                <input type="hidden" name="jam" :value="selectedTime">
                                <div class="space-y-4">
                                    <div>
                                        <label for="topik_bahasan" class="block text-sm font-medium text-gray-700">Topik Bahasan</label>
                                        <textarea id="topik_bahasan" name="topik_bahasan" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" placeholder="Contoh: Revisi Bab 3 dan pengajuan Bab 4" required></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Metode Bimbingan</label>
                                        <div class="mt-2 space-x-4">
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="metode" value="online" class="form-radio text-primary focus:ring-primary" checked>
                                                <span class="ml-2">Online</span>
                                            </label>
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="metode" value="offline" class="form-radio text-primary focus:ring-primary">
                                                <span class="ml-2">Offline</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex justify-end space-x-3 pt-4">
                                        <button type="button" @click="modalOpen = false" class="bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded-lg hover:bg-gray-300 transition">Batal</button>
                                        <button type="submit" class="bg-accent text-white font-bold py-2 px-6 rounded-lg hover:bg-orange-600 transition">Booking Sekarang</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </main>
        </div>
    </div>

</body>
</html>