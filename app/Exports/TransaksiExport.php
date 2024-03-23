<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $tanggal_awal = request()->get('tanggal_awal');
        $tanggal_akhir = request()->get('tanggal_akhir');
        return Transaksi::join('jenis_transaksi', 'jenis_transaksi.id', '=', 'transaksi.id_jenis_transaksi')
            ->leftJoin('penanggung_jawab', 'penanggung_jawab.id', '=', 'transaksi.id_penanggung_jawab')
            ->select('transaksi.tanggal_transaksi', 'jenis_transaksi.jenis', 'transaksi.penerima', 'transaksi.tujuan', 'transaksi.status', 'penanggung_jawab.nama_lengkap', 'transaksi.keterangan')
            ->whereBetween('tanggal_transaksi', [$tanggal_awal, $tanggal_akhir])
            ->get();
    }
    public function headings(): array
    {
        return [
            'Tanggal',
            'Jenis',
            'Penerima',
            'Tujuan',
            'Status',
            'Penanggung Jawab',
            'Keterangan',
        ];
    }
}
