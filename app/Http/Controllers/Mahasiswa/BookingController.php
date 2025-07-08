<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\JadwalTemplate;
use App\Models\TugasAkhir; // Asumsi mahasiswa punya data TA
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    // Menampilkan halaman booking dengan kalender
    public function index()
    {
        // Asumsi kita bisa dapat ID dosen dari relasi
        $tugasAkhir = TugasAkhir::where('mahasiswa_user_id', Auth::id())->firstOrFail();
        $dosen = User::find($tugasAkhir->dosen_pembimbing_id);
        
        return view('mahasiswa.booking.index', compact('dosen'));
    }

    // API untuk mengambil slot waktu yang tersedia pada tanggal tertentu
    // Ini akan dipanggil oleh JavaScript dari sisi frontend
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