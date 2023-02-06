<?php

namespace Database\Seeders;

use App\Models\Buku;
use App\Models\Identitas;
use App\Models\Kategori;
use App\Models\Pemberitahuan;
use App\Models\Peminjaman;
use App\Models\Penerbit;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // User Seeder
        User::create(
            [
                'kode' => 'A1',
                'fullname' => 'ZoeMohamed',
                'username' => 'Joe',
                'password' => bcrypt('zoex'),
                'alamat' => "Jalan jalan",
                'role' => 'admin',
                'join_date' => "2022-09-01 23:09:02",
                'verif' => 'verified'

            ]

        );
        User::create(
            [
                'kode' => 'U2',
                'nis' => 3948320,
                'fullname' => 'Deumdo',
                'username' => 'Deum',
                'password' => bcrypt('ytta'),
                'kelas' => 'XII-BDP 1',
                'alamat' => "Jalan Pantai Indah Kapuk",
                'role' => 'user',
                'join_date' => "2022-09-01 23:09:02",

            ]

        );
        User::create(
            [
                'kode' => 'U3',
                'nis' => 39323420,
                'fullname' => 'KurniaMega',
                'username' => 'Kurmeg',
                'password' => bcrypt('usk mantep'),
                'kelas' => 'XII-OTKP 1',
                'alamat' => "Pejaten Raya",
                'role' => 'user',
                'join_date' => "2022-09-01 23:09:02",

            ]

        );

        // Seeder Kategori
        Kategori::create([
            'kode' => "umum",
            'nama' => 'Umum'
        ]);

        Kategori::create([
            'kode' => "sains",
            'nama' => 'Sains'
        ]);

        Kategori::create([
            'kode' => "sejarah",
            'nama' => 'Sejarah'
        ]);

        // Seeder Penerbit
        Penerbit::create([
            'kode' => "erlangga",
            'nama' => "Erlangga",


        ]);

        Penerbit::create([
            'kode' => "bse",
            'nama' => "BSE",

        ]);


        Penerbit::create([
            'kode' => "intermedia",
            'nama' => "Intermedia",

        ]);


        // Seeder Buku
        Buku::create([
            'judul' => 'Cara Memasak Nasi',
            'kategori_id' => 1,
            'penerbit_id' => 1,
            'pengarang' => 'Husein abdul Jabar',
            'tahun_terbit' => '2022-09-11',
            'isbn' => '3432423',
            'j_buku_baik' => 1,
            'j_buku_rusak' => 1

        ]);


        Buku::create([
            'judul' => 'Ensiklopedia Luar Angkasa',
            'kategori_id' => 2,
            'penerbit_id' => 2,
            'pengarang' => 'Husein abdul',
            'tahun_terbit' => '2022-09-11',
            'isbn' => '9473272',
            'j_buku_baik' => 1,
            'j_buku_rusak' => 1

        ]);


        Buku::create([
            'judul' => 'Api Sejarah',
            'kategori_id' => 3,
            'penerbit_id' => 3,
            'pengarang' => 'Husein',
            'tahun_terbit' => '2022-09-11',
            'isbn' => '4320423',
            'j_buku_baik' => 1,
            'j_buku_rusak' => 1,

        ]);


        // Seeder Identitas
        Identitas::create([
            "nama_app" => 'Perpus SMKN 10 Jakarta',
            "alamat_app" => 'JL.SMEAN 6,Cawang,Kramat Jati,Jakarta Timur',
            "email_app" => 'SMKN10@school.com',
            "nomor_hp" => '0812911',

        ]);

        // Seeder Pemberitahuan

        // Pemberitahuan::create([
        //     "isi" => "Maaf server maintance",
        //     "status" => 'nonaktif'
        // ]);


        // Pemberitahuan::create([
        //     "isi" => "Pengembalian Buku Paket sampai tanggal 30 Januari",
        //     "status" => 'aktif'
        // ]);

        // Pemberitahuan::create([
        //     "isi" => "Pengembalian Buku Paket sampai tanggal 30 Januari",
        //     "status" => 'aktif'
        // ]);


        // Pemberitahuan::create([
        //     "isi" => "Pengembalian Buku Paket sampai tanggal 30 Januari",
        //     "status" => 'aktif'
        // ]);


        // Pemberitahuan::create([
        //     "isi" => "Pengembalian Buku Paket sampai tanggal 30 Januari",
        //     "status" => 'aktif'
        // ]);


        // Pemberitahuan::create([
        //     "isi" => "Pengembalian Buku Paket sampai tanggal 30 Januari",
        //     "status" => 'aktif'
        // ]);




        // Seeder Peminjaman
        Peminjaman::create([
            "user_id" =>  2,
            "buku_id" =>  1,
            "tanggal_peminjaman" => "2022-09-01",
            "kondisi_buku_saat_dipinjam" =>  'baik',
        ]);

        Peminjaman::create([
            "user_id" =>  3,
            "buku_id" =>  2,
            "tanggal_peminjaman" => "2022-09-01",
            "kondisi_buku_saat_dipinjam" =>  'baik',
            // "kondisi_buku_saat_dikembalikan" =>  'rusak',
            // "denda" => 20000
        ]);


        Peminjaman::create([
            "user_id" =>  2,
            "buku_id" =>  3,
            "tanggal_peminjaman" => "2022-09-01",
            "kondisi_buku_saat_dipinjam" =>  'baik',
            // "denda" => 50000
        ]);

        // Seeder Pesan
        Pesan::create([
            "penerima_id" => 2,
            "pengirim_id" => 1,
            "judul" => "Buku Dipinjam",
            "isi"    => "Buku sedang dipinjam,harap mengembalikan harap mengembalikan sebelum 30",
            "tanggal_kirim" => "2022-09-01 23:09:02",

        ]);

        Pesan::create([
            "penerima_id" => 3,
            "pengirim_id" => 1,
            "judul" => "Anda Merusakan Buku",
            "isi"    => "Anda Terkenda denda 100000",
            "tanggal_kirim" => "2022-09-01 23:09:02",

        ]);


        Pesan::create([
            "penerima_id" => 2,
            "pengirim_id" => 1,
            "judul" => "Buku telah dikembalikan",
            "isi"    => "Terimakasih telah meminjam buku di perpus",
            "tanggal_kirim" => "2022-09-01 23:09:02",

        ]);
    }
}
