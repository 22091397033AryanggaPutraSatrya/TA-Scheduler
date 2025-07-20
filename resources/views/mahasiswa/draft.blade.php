<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Draft Tugas Akhir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
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

    <div id="draft-page">
        <div class="flex flex-col md:flex-row min-h-screen">
            
            {{-- Memanggil komponen sidebar --}}
            @include('mahasiswa.layouts.sidebar')

            <!-- Main Content -->
            <main class="flex-1 p-6 md:p-8 bg-background">
                <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Draft Tugas Akhir</h1>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        
                        <!-- Kolom Kiri: Form Upload -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Unggah Draft Baru</h3>
                            <form method="POST" action="{{ route('mahasiswa.draft.store') }}" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="file_draft" class="block text-sm font-medium text-gray-700">Pilih File (PDF, DOCX)</label>
                                    <input type="file" id="file_draft" name="file_draft" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-secondary file:text-primary hover:file:bg-blue-200 cursor-pointer" required>
                                    @error('file_draft')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="catatan_mahasiswa" class="block text-sm font-medium text-gray-700">Catatan untuk Dosen</label>
                                    <textarea id="catatan_mahasiswa" name="catatan_mahasiswa" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary" placeholder="Contoh: Mohon periksa Bagian 3 tentang metodologi penelitian.">{{ old('catatan_mahasiswa') }}</textarea>
                                </div>
                                <button type="submit" class="w-full bg-accent text-white font-bold py-3 px-4 rounded-lg hover:bg-orange-600 transition flex items-center justify-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <span>Kirim Draft</span>
                                </button>
                            </form>
                        </div>

                        <!-- Kolom Kanan: Riwayat Pengiriman -->
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Riwayat Pengiriman</h3>
                            <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2">
                                @forelse ($drafts as $draft)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between items-center">
                                            <p class="font-bold text-primary">Versi {{ $draft->versi }} - {{ $draft->nama_file }}</p>
                                            <span class="text-xs text-gray-500">{{ $draft->created_at->format('d M Y') }}</span>
                                        </div>
                                        @if($draft->catatan_mahasiswa)
                                            <p class="text-sm text-gray-600 mt-2 italic">"{{ $draft->catatan_mahasiswa }}"</p>
                                        @endif

                                        @if($draft->feedback_dosen)
                                            <div class="mt-3 bg-gray-50 border-l-4 border-secondary p-3 rounded-r-lg">
                                                <p class="text-sm font-semibold text-primary">Feedback Dosen:</p>
                                                <p class="text-sm text-gray-700 mt-1">{{ $draft->feedback_dosen }}</p>
                                            </div>
                                        @else
                                            <div class="mt-3 bg-yellow-50 border-l-4 border-yellow-400 p-3 rounded-r-lg">
                                                <p class="text-sm text-yellow-800">Menunggu feedback dari dosen.</p>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-center text-gray-500 py-8">
                                        <p>Belum ada draft yang pernah diunggah.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>
    </div>

</body>
</html>