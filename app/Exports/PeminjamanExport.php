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

class PeminjamanExport implements FromQuery,  WithMapping, WithHeadings, WithCustomStartCell,  WithEvents

{


    use Exportable;


    private $tanggal_peminjaman;

    protected $index = 1;

    private $nama_app;
    private $alamat_app;
    private $email_app;
    private $nomor_hp;



    public function __construct($tanggal_peminjaman, $identitas)
    {
        $this->tanggal_peminjaman = $tanggal_peminjaman;
        $this->nama_app = $identitas->nama_app;
        $this->alamat_app = $identitas->alamat_app;
        $this->email_app = $identitas->email_app;
        $this->nomor_hp = $identitas->nomor_hp;
    }

    public function map($peminjamans): array
    {

        // dd($peminjamans);
        return [
            [

                $this->index++,
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
        return 'B8';
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
                    ->setSize(17)
                    ->setBold(true)
                    ->getColor()->setRGB('#000');

                $event->sheet->setCellValue('B2', $this->tanggal_peminjaman)->getStyle('B2:G2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);;
                $event->sheet->getDelegate()->mergeCells('B2:G2');


                $event->sheet->getStyle('B2:G2')->getFont()
                    ->setSize(15)
                    ->setBold(true)
                    ->getColor()->setRGB('#000');


                $event->sheet->setCellValue('B3', $this->nama_app)->getStyle('B3:G3')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);;
                $event->sheet->getDelegate()->mergeCells('B3:G3');


                $event->sheet->getStyle('B3:G3')->getFont()
                    ->setSize(13)
                    ->setBold(false)
                    ->getColor()->setRGB('#000');


                $event->sheet->setCellValue('B4', $this->alamat_app)->getStyle('B4:G4')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);;
                $event->sheet->getDelegate()->mergeCells('B4:G4');


                $event->sheet->getStyle('B4:G4')->getFont()
                    ->setSize(13)
                    ->setBold(false)
                    ->getColor()->setRGB('#000');


                $event->sheet->setCellValue('B5', $this->email_app)->getStyle('B5:G5')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);;
                $event->sheet->getDelegate()->mergeCells('B5:G5');


                $event->sheet->getStyle('B5:G5')->getFont()
                    ->setSize(13)
                    ->setBold(false)
                    ->getColor()->setRGB('#000');


                $event->sheet->setCellValue('B6', $this->nomor_hp)->getStyle('B6:G6')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);;
                $event->sheet->getDelegate()->mergeCells('B6:G6');


                $event->sheet->getStyle('B6:G6')->getFont()
                    ->setSize(13)
                    ->setBold(false)
                    ->getColor()->setRGB('#000');

                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(50);
                $event->sheet->getDelegate()->getColumnDimension('G')->setWidth(30);



                $event->sheet->getStyle('B:G')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);;



                $event->sheet->styleCells(
                    'B8:G8',
                    [
                        //Set border Style
                        'borders' => [
                            'outline' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                            ],

                        ],

                        //Set font style
                        'font' => [
                            'name'      =>  'Calibri',
                            'size'      =>  12,
                            'bold'      =>  true,
                            'color' => ['argb' => 'FFFFFF'],
                        ],

                        //Set background style
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'rgb' => '4C81D9',
                            ]
                        ],

                    ]
                );


                // $event->sheet->getDelegate()->getStyle('A1:G1')->getFont()->setSize(14);
            },
        ];
    }
}
