<title>Laporan Pengembalian</title>
<style>
    .center {
        margin-left: auto;
        margin-right: auto;
    }

    .left {
        margin-left: 50px;
    }

    table {
        font-family: arial, sans-serif;
        font-size: 10px;
        border-collapse: collapse;
        width: 85%;

    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>

<div class="row">
    <div style="position:relative;">
        <div style="position:absolute; left:37px; top:15px; width:200px;">

            <img src="{{ public_path($identitas->foto) }}" width="35%" class="" alt="Logo-Intek"
                style="border-radius:50%" />
        </div>
        <div style="margin-left:11px; text-align:center; font-family:sans-serif">
            <h2>{{ $identitas->nama_app }}</h2>
            <p style="font-size: 11px">
                {{ $identitas->alamat_app }}
                <br>
                {{ $identitas->email_app }}
                <br>
                {{ $identitas->nomor_hp }}
            </p>
        </div>

    </div>

    <hr>
    <br />





    <h3 style="text-align: center; font-family:sans-serif;"><span class="border border-dark">Laporan Pengembalian
            Buku</span>
    </h3>

    @if (count($datas) != 0)

        <table class="center">
            <thead>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
            </thead>
            <tbody>
                @foreach ($datas as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->user->fullname }}</td>
                        <td>{{ $d->buku->judul }}</td>
                        <td>{{ $d->tanggal_peminjaman }}</td>
                        <td>{{ $d->tanggal_pengembalian }}</td>
                        <td>{{ $d->denda }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h5 style="text-align:center;margin-top:25px;">Laporan Pengembalian : {{ $tanggal_pengembalian }}</h5>
    @else
        <table class="center">
            <thead>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Tanggal Pengembalian</th>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" style="text-align:center;">Datas Not Found</td>

                </tr>
            </tbody>


        </table>

        <h5 style="text-align:center;margin-top:25px;">Laporan Pengembalian : {{ $tanggal_pengembalian }}</h5>



    @endif


</div>
