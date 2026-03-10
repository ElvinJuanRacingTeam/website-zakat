<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;

class ZakatController extends Controller
{

    public function simpan(Request $request)
    {
        $noKwitansi = 'KW-' . date('YmdHis');

        $atasNamaArray = $request->atas_nama ?? [];
        $atasNamaClean = array_filter($atasNamaArray);
        $atasNamaJson = json_encode($atasNamaClean);

        $fitrah = (int) str_replace('.', '', $request->fitrah ?? 0);
        $kg     = (float) ($request->kg ?? 0);
        $mal    = (int) str_replace('.', '', $request->mal ?? 0);
        $infaq  = (int) str_replace('.', '', $request->infaq ?? 0);
        $shodaqoh = (int) str_replace('.', '', $request->shodaqoh ?? 0);
        $fidya  = (int) str_replace('.', '', $request->fidya ?? 0);

        $total = $fitrah + $infaq + $shodaqoh + $mal + $fidya;

        // pastikan metode selalu ada
        $metode = $request->metode_pembayaran;
        if ($metode !== 'transfer') {
            $metode = 'cash';
        }

        $data = Pembayaran::create([
            'no_kwitansi'      => $noKwitansi,
            'nama'             => $request->nama,
            'alamat'           => $request->alamat,
            'atas_nama'        => $atasNamaJson,
            'zakat_fitrah_rp'  => $fitrah,
            'zakat_fitrah_kg'  => $kg,
            'zakat_mal'        => $mal,
            'infaq_shodaqoh'   => $infaq + $shodaqoh,
            'fidya'            => $fidya,
            'total'            => $total,
            'metode_pembayaran'=> $metode
        ]);

        return redirect()->route('cetak', $data->id);
    }


    public function cetak($id)
    {
        $data = Pembayaran::findOrFail($id);

        $atasNama = [];
        if (!empty($data->atas_nama)) {
            $decoded = json_decode($data->atas_nama, true);
            if (is_array($decoded)) {
                $atasNama = $decoded;
            }
        }

        return view('cetak', [
            'nama'   => $data->nama,
            'alamat' => $data->alamat,
            'fitrah' => $data->zakat_fitrah_rp,
            'kg'     => $data->zakat_fitrah_kg,
            'mal'    => $data->zakat_mal,
            'infaq'  => $data->infaq_shodaqoh,
            'shodaqoh'=> 0,
            'fidya'  => $data->fidya,
            'atas_nama'=> $atasNama,
            'metode' => $data->metode_pembayaran ?? 'cash'
        ]);
    }


    public function riwayat()
    {
        $data = Pembayaran::latest()->get();
        return view('riwayat', compact('data'));
    }


    public function laporan()
    {
        $data = Pembayaran::all();
        return view('laporan', compact('data'));
    }


    public function edit($id)
    {
        $data = Pembayaran::findOrFail($id);
        $atasNama = json_decode($data->atas_nama, true);

        return view('edit', compact('data','atasNama'));
    }


    public function update(Request $request, $id)
    {
        $data = Pembayaran::findOrFail($id);

        $atasNamaArray = $request->atas_nama ?? [];
        $atasNamaClean = array_filter($atasNamaArray);
        $atasNamaJson = json_encode($atasNamaClean);

        $fitrah = (int) str_replace('.', '', $request->fitrah ?? 0);
        $kg     = (float) ($request->kg ?? 0);
        $mal    = (int) str_replace('.', '', $request->mal ?? 0);
        $infaq  = (int) str_replace('.', '', $request->infaq ?? 0);
        $shodaqoh = (int) str_replace('.', '', $request->shodaqoh ?? 0);
        $fidya  = (int) str_replace('.', '', $request->fidya ?? 0);

        $total = $fitrah + $infaq + $shodaqoh + $mal + $fidya;

        $metode = $request->metode_pembayaran;
        if ($metode !== 'transfer') {
            $metode = 'cash';
        }

        $data->update([
            'nama'            => $request->nama,
            'alamat'          => $request->alamat,
            'atas_nama'       => $atasNamaJson,
            'zakat_fitrah_rp' => $fitrah,
            'zakat_fitrah_kg' => $kg,
            'zakat_mal'       => $mal,
            'infaq_shodaqoh'  => $infaq + $shodaqoh,
            'fidya'           => $fidya,
            'total'           => $total,
            'metode_pembayaran'=> $metode
        ]);

        return redirect()->route('riwayat');
    }


    public function hapus($id)
    {
        $data = Pembayaran::findOrFail($id);
        $data->delete();

        return redirect()->route('riwayat');
    }

}