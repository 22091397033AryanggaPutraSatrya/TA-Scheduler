<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\JadwalTemplate;
use App\Models\TugasAkhir;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Menampilkan halaman booking dengan kalender dan slot waktu yang sudah di-generate.
     */
    public function index()
    {
        // 1. Ambil data tugas akhir mahasiswa. Gunakan first() agar tidak error jika data tidak ada.
        $tugasAkhir = TugasAkhir::where('mahasiswa_user_id', Auth::id())->first();

        // 2. Jika mahasiswa belum punya data TA, tampilkan view dengan pesan error.
        if (!$tugasAkhir) {
            // Anda bisa membuat view khusus untuk pesan ini.
            // Di sini kita return view yang sama dengan pesan error.
            return view('mahasiswa.booking')->withErrors(['Belum ada data tugas akhir. Silakan hubungi administrasi.']);
        }

        // 3. Ambil data dosen pembimbing
        $dosen = User::find($tugasAkhir->dosen_pembimbing_id);
        if (!$dosen) {
            return view('mahasiswa.booking')->withErrors(['Dosen pembimbing tidak ditemukan.']);
        }
        
        // 4. Generate jadwal untuk 7 hari ke depan
        $weekSchedule = $this->generateWeekSchedule($dosen->id);

        // 5. Kirim data dosen dan jadwal ke view
        return view('mahasiswa.booking', compact('dosen', 'weekSchedule'));
    }

    /**
     * Helper function untuk men-generate jadwal selama 7 hari.
     * @param int $dosenId
     * @return array
     */
    private function generateWeekSchedule(int $dosenId): array
    {
        $scheduleData = [];
        $today = Carbon::today();
        $endDate = $today->copy()->addDays(6);

        // Ambil semua template jadwal & booking dalam satu query untuk efisiensi
        $templates = JadwalTemplate::where('dosen_user_id', $dosenId)->get()->keyBy('hari_dalam_minggu');
        $bookings = Booking::where('dosen_user_id', $dosenId)
            ->whereBetween('waktu_mulai', [$today, $endDate->copy()->endOfDay()])
            ->whereIn('status', ['pending', 'confirmed'])
            ->get()
            ->map(fn($booking) => Carbon::parse($booking->waktu_mulai)->format('H:i'));

        for ($date = $today->copy(); $date <= $endDate; $date->addDay()) {
            $dayOfWeekIso = $date->dayOfWeekIso; // 1: Senin, 7: Minggu
            $daySlots = [];

            if (isset($templates[$dayOfWeekIso])) {
                $template = $templates[$dayOfWeekIso];
                $startTime = Carbon::parse($template->jam_mulai);
                $endTime = Carbon::parse($template->jam_selesai);
                $duration = $template->durasi_sesi_menit;

                while ($startTime < $endTime) {
                    $slotTime = $startTime->format('H:i');
                    $status = 'available';

                    if ($bookings->contains($slotTime)) {
                        $status = 'booked';
                    } elseif ($date->isToday() && $startTime->isPast()) {
                        $status = 'past';
                    }

                    $daySlots[] = ['time' => $slotTime, 'status' => $status];
                    $startTime->addMinutes($duration);
                }
            }

            $scheduleData[$date->toDateString()] = [
                'date' => $date->copy(),
                'dayName' => $date->translatedFormat('l'), // Format nama hari dalam Bahasa Indonesia
                'slots' => $daySlots,
            ];
        }

        return $scheduleData;
    }


    // API untuk mengambil slot waktu yang tersedia pada tanggal tertentu
    // Method ini sudah cukup baik, tidak perlu diubah.
    public function fetchAvailableSlots(Request $request)
    {
        $request->validate(['tanggal' => 'required|date']);
        $tanggal = Carbon::parse($request->tanggal);
        $hariDalamMinggu = $tanggal->dayOfWeekIso; // 1:Senin, 7:Minggu
        
        $tugasAkhir = TugasAkhir::where('mahasiswa_user_id', Auth::id())->firstOrFail();
        $dosenId = $tugasAkhir->dosen_pembimbing_id;

        // 1. Ambil template jadwal dosen pada hari tersebut
        $template = JadwalTemplate::where('dosen_user_id', $dosenId)
            ->where('hari_dalam_minggu', $hariDalamMinggu)
            ->first();

        if (!$template) {
            return response()->json([]); // Tidak ada jadwal di hari itu
        }

        // 2. Generate semua kemungkinan slot
        $allSlots = [];
        $waktuMulai = Carbon::parse($template->jam_mulai);
        $waktuSelesai = Carbon::parse($template->jam_selesai);
        $durasi = $template->durasi_sesi_menit;

        while ($waktuMulai->copy()->addMinutes($durasi) <= $waktuSelesai) {
            $allSlots[] = $waktuMulai->format('H:i');
            $waktuMulai->addMinutes($durasi);
        }

        // 3. Ambil booking yang sudah ada pada tanggal tersebut
        $existingBookings = Booking::where('dosen_user_id', $dosenId)
            ->whereDate('waktu_mulai', $tanggal->toDateString())
            ->whereIn('status', ['pending', 'confirmed'])
            ->get()
            ->map(fn($booking) => Carbon::parse($booking->waktu_mulai)->format('H:i'));

        // 4. Filter slot yang tersedia
        $availableSlots = collect($allSlots)->diff($existingBookings);

        return response()->json($availableSlots->values());
    }

    // Menyimpan data booking baru
    // Method ini sudah cukup baik, tidak perlu diubah.
    public function store(StoreBookingRequest $request)
    {
        $tugasAkhir = TugasAkhir::where('mahasiswa_user_id', Auth::id())->firstOrFail();
        $validated = $request->validated();
        
        $waktuMulai = Carbon::parse($validated['tanggal'] . ' ' . $validated['jam']);

        Booking::create([
            'mahasiswa_user_id' => Auth::id(),
            'dosen_user_id' => $tugasAkhir->dosen_pembimbing_id,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuMulai->copy()->addMinutes(30), // Asumsi durasi 30 menit
            'topik_bahasan' => $validated['topik_bahasan'],
            'metode' => $validated['metode'],
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Booking bimbingan berhasil diajukan.');
    }
}