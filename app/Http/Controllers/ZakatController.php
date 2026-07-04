<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ZakatController extends Controller
{
    public function simpan(Request $request)
    {
        $pembayaran = DB::transaction(function () use ($request) {
            
            $noKwintasi = 'ZKT-' . date('Ymd') . '-' . strtoupper(Str::random(5));

            $jumlahJiwa = (int) ($request->jumlah_jiwa ?? 0);
            $fitrah = (int) str_replace('.', '', $request->fitrah ?? 0);
            $kg = (float) ($request->kg ?? 0);
            $mal = (int) str_replace('.', '', $request->mal ?? 0);
            $infaq = (int) str_replace('.', '', $request->infaq ?? 0);
            $shodaqoh = (int) str_replace('.', '', $request->shodaqoh ?? 0);
            $fidya = (int) str_replace('.', '', $request->fidya ?? 0);

            $total = $fitrah + $infaq + $shodaqoh + $mal + $fidya;

            $metode = ($request->metode_pembayaran === 'transfer') ? 'transfer' : 'cash';

            return Pembayaran::create([
                'user_id' => Auth::id(),
                'no_kwitansi' => $noKwintasi,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'jumlah_jiwa' => $jumlahJiwa,
                'zakat_fitrah_rp' => $fitrah,
                'zakat_fitrah_kg' => $kg,
                'zakat_mal' => $mal,
                'infaq_shodaqoh' => $infaq + $shodaqoh,
                'fidya' => $fidya,
                'total' => $total,
                'metode_pembayaran' => $metode,
            ]);
        });

        return redirect()->route('cetak', ['id' => $pembayaran->id]);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv' => 'required|mimes:csv,txt'
        ]);

        $file = fopen($request->file('csv')->getRealPath(), 'r');
        $header = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($header, $row);

            Pembayaran::create([
                'user_id' => Auth::id(),
                'no_kwitansi' => 'CSV-' . strtoupper(Str::random(8)),
                'nama' => $data['nama'],
                'alamat' => $data['alamat'] ?? '-',
                'jumlah_jiwa' => (int) ($data['jumlah_jiwa'] ?? 1),
                'zakat_fitrah_rp' => (int) ($data['fitrah'] ?? 0),  
                'zakat_mal' => (int) ($data['mal'] ?? 0),   
                'jumlah_jiwa' => $data['jumlah_jiwa'],
                'infaq_shodaqoh' => (int) ($data['infaq'] ?? 0),
                'fidya' => (int) ($data['fidya'] ?? 0),
                'total' => (int) ($data['fitrah'] + $data['mal'] + $data['infaq'] + $data['fidya']),
                'metode_pembayaran' => $data['metode_pembayaran'] ?? 'cash'
            ]);
        }

        fclose($file);
        return back()->with('success', 'CSV berhasil diimport');
    }

    public function cetak($id)
    {
        $data = Pembayaran::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
            
        return view('cetak', [
            'nama' => $data->nama,
            'alamat' => $data->alamat,
            'fitrah' => $data->zakat_fitrah_rp,
            'kg' => $data->zakat_fitrah_kg,
            'mal' => $data->zakat_mal,
            'infaq' => $data->infaq_shodaqoh,
            'shodaqoh' => 0,
            'fidya' => $data->fidya,
            'jumlahJiwa' => $data->jumlah_jiwa ?? 0,
            'metode' => $data->metode_pembayaran ?? 'cash',
        ]);
    }

    public function riwayat(Request $request)
    {
        $tahun = $request->tahun;
        $query = Pembayaran::where('user_id', Auth::id());

        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        $data = $query->latest()->get();
        $tahunList = Pembayaran::selectRaw('YEAR(created_at) as tahun')
            ->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        return view('riwayat', compact('data', 'tahunList', 'tahun'));
    }

    public function laporan(Request $request)
{
    $query = Pembayaran::where('user_id', Auth::id());

    if ($request->tahun) {
        $query->whereYear('created_at', $request->tahun);
    }

    if ($request->metode) {
        $query->where('metode_pembayaran', $request->metode);
    }

    if ($request->tanggal) {
        $query->whereDate('created_at', $request->tanggal);
    }

    // Tambahkan di sini
    switch ($request->kategori) {

        case 'fitrah_rp':
            $query->where('zakat_fitrah_rp', '>', 0);
            break;

        case 'fitrah_kg':
            $query->where('zakat_fitrah_kg', '>', 0);
            break;

        case 'mal':
            $query->where('zakat_mal', '>', 0);
            break;

        case 'infaq':
            $query->where('infaq_shodaqoh', '>', 0);
            break;

        case 'fidya':
            $query->where('fidya', '>', 0);
            break;

        case 'cash':
            $query->where('metode_pembayaran', 'cash');
            break;

        case 'transfer':
            $query->where('metode_pembayaran', 'transfer');
            break;
    }

    $data = $query->orderBy('created_at', $request->sort ?? 'desc')->get();

    if ($request->no_dari || $request->no_sampai) {
        $mulai = max(1, (int) $request->no_dari);
        $akhir = (int) ($request->no_sampai ?? count($data));
        $data = $data->slice($mulai - 1, ($akhir - $mulai) + 1)->values();
    }

    return view('laporan', [
        'data' => $data,
        'tahunList' => Pembayaran::selectRaw('YEAR(created_at) as tahun')->distinct()->pluck('tahun'),
        'tahun' => $request->tahun,
        'metode' => $request->metode,
        'tanggal' => $request->tanggal,
        'sort' => $request->sort,
        'no_dari' => $request->no_dari,
        'no_sampai' => $request->no_sampai
    ]);
}

    public function edit($id)
    {
        $data = Pembayaran::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Pembayaran::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $fitrah = (int) str_replace('.', '', $request->fitrah ?? 0);
        $mal = (int) str_replace('.', '', $request->mal ?? 0);
        $infaq = (int) str_replace('.', '', $request->infaq ?? 0);
        $shodaqoh = (int) str_replace('.', '', $request->shodaqoh ?? 0);
        $fidya = (int) str_replace('.', '', $request->fidya ?? 0);

        $data->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jumlah_jiwa' => (int) ($request->jumlah_jiwa ?? 0),
            'zakat_fitrah_rp' => $fitrah,
            'zakat_fitrah_kg' => (float) ($request->kg ?? 0),
            'zakat_mal' => $mal,
            'infaq_shodaqoh' => $infaq + $shodaqoh,
            'fidya' => $fidya,
            'total' => $fitrah + $infaq + $shodaqoh + $mal + $fidya,
            'metode_pembayaran' => ($request->metode_pembayaran === 'transfer') ? 'transfer' : 'cash',
        ]);

        return redirect()->route('riwayat');
    }

    public function hapus($id)
    {
        Pembayaran::where('id', $id)->where('user_id', Auth::id())->firstOrFail()->delete();
        return redirect()->route('riwayat');
    }
}