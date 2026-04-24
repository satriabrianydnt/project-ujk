<?php

namespace App\Exports;

use App\Models\Transaksi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transaksi::with('barang')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Kode Barang',
            'Nama Barang',
            'Tipe',
            'Jumlah',
            'Keterangan',
        ];
    }

    public function map($transaksi): array
    {

        $tipeTransaksi = $transaksi->jenis === 'masuk' ? 'Barang Masuk' : 'Barang Keluar';

        return [
            Carbon::parse($transaksi->tanggal_transaksi)->format('d/m/Y'),
            $transaksi->barang->kode_barang ?? 'N/A',
            $transaksi->barang->nama_barang ?? 'N/A',
            $tipeTransaksi,
            $transaksi->jumlah,
            $transaksi->keterangan ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1    => ['font' => ['bold' => true]],
        ];
    }
}
