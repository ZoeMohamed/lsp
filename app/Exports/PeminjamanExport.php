<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class PeminjamanExport implements FromQuery,  WithMapping, WithHeadings, WithCustomStartCell, ShouldAutoSize, WithEvents

{


    use Exportable;


    private $tanggal_peminjaman;


    public function __construct($tanggal_peminjaman)
    {
        $this->tanggal_peminjaman = $tanggal_peminjaman;
    }

    public function map($peminjamans): array
    {

        // dd($peminjamans);
        return [
            [

                $peminjamans->id,
                $peminjamans->user->username,
                $peminjamans->buku->judul,
                $peminjamans->tanggal_peminjaman,
                $peminjamans->tanggal_pengembalian,
                $peminjamans->denda
            ],

        ];
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Anggota',
            'Judul Buku',
            'Tanggal Peminjaman',
            'Tanggal Pengembalian',
            'Denda',
        ];
    }
    public function query()
    {

        return Peminjaman::query()->where('tanggal_peminjaman', $this->tanggal_peminjaman);
    }

    public function startCell(): string
    {
        return 'B3';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->setCellValue('B1', 'Laporan Peminjaman')->getStyle('B1:G1')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);;
                $event->sheet->getDelegate()->mergeCells('B1:G1');

                $event->sheet->getStyle('B1:G1')->getFont()
                    ->setSize(16)
                    ->setBold(true)
                    ->getColor()->setRGB('0000ff');

                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(200);


                // $event->sheet->getDelegate()->getStyle('A1:G1')->getFont()->setSize(14);
            },
        ];
    }
}
