<?php
\App\Models\Pembayaran::all()->each(function($p) {
    $decoded = json_decode($p->atas_nama, true);
    if (($decoded[0] ?? 0) == 0) {
        $jiwa = $p->zakat_fitrah_rp > 0 
            ? (int)round($p->zakat_fitrah_rp / 40000) 
            : ($p->zakat_fitrah_kg > 0 
                ? (int)round($p->zakat_fitrah_kg / 2.5) 
                : 1);
        $p->atas_nama = json_encode([$jiwa]);
        $p->save();
        echo "ID {$p->id} | {$p->nama} → {$jiwa} jiwa\n";
    }
});
