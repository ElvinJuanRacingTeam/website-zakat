<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'required|mimes:csv,txt'
        ]);

        $errors = [];
        $successCount = 0;

        try {

            $file = fopen(
                $request->file('excel')->getRealPath(),
                'r'
            );

            if (!$file) {
                return back()->with(
                    'error',
                    'File tidak dapat dibaca'
                );
            }

            // Header CSV
            $header = fgetcsv($file, 0, ';');

            if (!$header) {
                return back()->with(
                    'error',
                    'Header CSV tidak ditemukan'
                );
            }

            // Hilangkan BOM UTF-8
            $header = array_map(function ($value) {
                return trim(
                    str_replace("\xEF\xBB\xBF", '', $value)
                );
            }, $header);

            $baris = 1;

            while (($row = fgetcsv($file, 0, ';')) !== false) {

                $baris++;

                // Skip baris kosong
                if (count(array_filter($row)) == 0) {
                    continue;
                }

                // Jumlah kolom harus sama
                if (count($row) != count($header)) {

                    $errors[] =
                        "Baris {$baris}: jumlah kolom tidak sesuai";

                    continue;
                }

                $data = array_combine(
                    $header,
                    $row
                );

                // Nama wajib
                if (empty(trim($data['nama'] ?? ''))) {

                    $errors[] =
                        "Baris {$baris}: nama wajib diisi";

                    continue;
                }

                // Validasi angka
                $numericFields = [
                    'jumlah_jiwa',
                    'fitrah',
                    'kg',
                    'mal',
                    'infaq',
                    'shodaqoh',
                    'fidya'
                ];

                $isValid = true;

                foreach ($numericFields as $field) {

                    if (
                        isset($data[$field]) &&
                        $data[$field] !== '' &&
                        !is_numeric($data[$field])
                    ) {

                        $errors[] =
                            "Baris {$baris}: kolom '{$field}' harus berupa angka";

                        $isValid = false;
                        break;
                    }
                }

                if (!$isValid) {
                    continue;
                }

                // Validasi metode pembayaran
                $metode = strtolower(
                    trim(
                        $data['metode_pembayaran'] ?? ''
                    )
                );

                if (
                    !in_array(
                        $metode,
                        ['cash', 'transfer']
                    )
                ) {

                    $errors[] =
                        "Baris {$baris}: metode_pembayaran harus cash atau transfer";

                    continue;
                }

                // Simpan ke database
                Pembayaran::create([

                    'user_id' => Auth::id(),

                    'no_kwitansi' =>
                        'CSV-' .
                        strtoupper(Str::random(6)),

                    'nama' =>
                        trim($data['nama']),

                    'alamat' =>
                        trim($data['alamat'] ?? ''),

                    'atas_nama' => json_encode([
                        $data['jumlah_jiwa'] ?? 0
                    ]),

                    'zakat_fitrah_rp' =>
                        (int) ($data['fitrah'] ?? 0),

                    'zakat_fitrah_kg' =>
                        (float) ($data['kg'] ?? 0),

                    'zakat_mal' =>
                        (int) ($data['mal'] ?? 0),

                    'infaq_shodaqoh' =>
                        (int) ($data['infaq'] ?? 0)
                        +
                        (int) ($data['shodaqoh'] ?? 0),

                    'fidya' =>
                        (int) ($data['fidya'] ?? 0),

                    'total' =>
                        (int) ($data['fitrah'] ?? 0)
                        +
                        (int) ($data['mal'] ?? 0)
                        +
                        (int) ($data['infaq'] ?? 0)
                        +
                        (int) ($data['shodaqoh'] ?? 0)
                        +
                        (int) ($data['fidya'] ?? 0),

                    'metode_pembayaran' =>
                        $metode
                ]);

                $successCount++;
            }

            fclose($file);

        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Import gagal: ' .
                $e->getMessage()
            );
        }

        if (!empty($errors)) {

            return back()
                ->with(
                    'warning',
                    "{$successCount} data berhasil diimport, terdapat "
                    . count($errors)
                    . " kesalahan."
                )
                ->with('import_errors', $errors);
        }

        return back()->with(
            'success',
            "{$successCount} data berhasil diimport."
        );
    }

    public function export()
    {
        return back()->with(
            'success',
            'Fitur export belum dibuat'
        );
    }
}