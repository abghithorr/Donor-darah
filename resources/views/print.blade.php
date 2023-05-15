<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data Pendonor</title>
</head>
<body>
    <h2 style="text-align: center; margin-bottom: 20px">Pendaftaran Donor Darah</h2>
    <table style="width: 100%">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Umur</th>
            <th>Telpon</th>
            <th>Berat</th>
            <th>Gol.Darah</th>
            <th>Gambar</th>
            <th>Status</th>
            <th>Jadwal</th>
        </tr>
        @php $no = 1; @endphp
        @foreach ($darahs as $donor)
        <tr>
            <td>{{$no++}}</td>
            <td>{{$donor['nama']}}</td>
            <td>{{$donor['email']}}</td>
            <td>{{$donor['umur']}}</td>
            <td>{{$donor['no_telp']}}</td>
            <td>{{$donor['berat']}}</td>
            <td>{{$donor['darah']}}</td>
            <td><img src="assets/image/{{$donor['foto']}}" width="80"></td>
            <td>
                @if ($donor['response'])
                    {{ $donor['response']['status'] }}
                @else
                    -
                @endif
                </td>
                <td>
                    @if ($donor['response'])
                    {{ $donor['response']['status'] == 'diterima' ? \Carbon\Carbon::parse($donor['response']['jadwal'])->format('j F Y') : '-' }}  
                    @else 
                    -
                    @endif
        </tr>
        @endforeach
    </table>
</body>
</html>