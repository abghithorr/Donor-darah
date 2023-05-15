<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Petugas</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <h2 class="title-table">Pendonoran Darah (Petugas)</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 30px">
        <a href="/logout" style="text-align: center">Logout</a>
        <div style="margin: 0 10px"> | </div>
        <a href="/" style="text-align: center">Home</a>
    </div>
    <div style="display: flex; justify-content: flex-end; align-items: center; padding: 0 30px">
        {{-- menggunakan method GET karna route untuk masuk ke halaman data ini menggunakan ::get --}}
        <form action="" method="GET">
            @csrf
            <label for="Status">Cari Berdasarkan Status</label>  
<select name="search" id="search">
<option selected hidden disabled>Pilih Status</option>
<option value="diterima">Diterima</option>
<option value="ditolak">Ditolak</option>
</select>
<button type="submit" class="btn btn-success">Cari</button>
        </form>
        {{-- refresh balik lg ke route data karna nanti pas di klik refresh mau bersihin riwayat pencarian sebelumnya dan balikin lagi nya ke halaman data lagi --}}
        <a href="{{route('data.petugas')}}" style="margin-left: 10px; margin-top: -10px">Refresh</a>
    </div>
    <div style="padding: 0 30px">
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telp</th>
                    <th>Umur</th>
                    <th>Berat</th>
                    <th>Darah</th>
                    <th>Gambar</th>
                    <th>Status </th>
                    <th>Jadwal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                $no = 1;
                $search = '';
                if (@$_GET['search']) {
                    $search = $_GET['search'];
                }
                
            @endphp
            @foreach ($darahs as $donor)
                @if ($search !== '')
                    @if ($donor->response)
                        @if ($donor->response['status'] == $search)
    
                    <tr>
                        {{-- menambahkan angka 1 dr $no di php tiap baris nya --}}
                        <td>{{$no++}}</td>
                        <td>{{$donor['nama']}}</td>
                        <td>{{$donor['email']}}</td>
                        <td>{{$donor['no_telp']}}</td>
                        <td>{{$donor['umur']}}</td>
                        <td>{{$donor['berat']}}</td>
                        <td>{{$donor['darah']}}</td>
                        <td>
                            <a href="../assets/image/{{$donor->foto}}" target="_blank">
                                <img src="{{asset('assets/image/'.$donor->foto)}}" width="120">
                            </a>
                        </td>
                        <td>
                        @if ($donor->response)
                        {{ $donor->response['status'] }}
                        @else 
                        - 
                        @endif
                    </td>
                    <td>
                        @if ($donor->response)
                    {{ $donor->response['status'] == 'diterima' ? \Carbon\Carbon::parse($donor->response['jadwal'])->format('j F Y') : '-' }}                    
                    @else
                    -
                    @endif
                    </td>
                    <td>
                        <a href="{{route('response.edit', $donor->id)}}" class="btn btn-success">Change Response</a>
                    </td>
                    </tr>
                    @endif
                    @endif
                    @else
                    <tr>
                        {{-- menambahkan angka 1 dr $no di php tiap baris nya --}}
                        <td>{{$no++}}</td>
                        <td>{{$donor['nama']}}</td>
                        <td>{{$donor['email']}}</td>
                        <td>{{$donor['no_telp']}}</td>
                        <td>{{$donor['umur']}}</td>
                        <td>{{$donor['berat']}}</td>
                        <td>{{$donor['darah']}}</td>
                        <td>
                            <a href="../assets/image/{{$donor->foto}}" target="_blank">
                                <img src="{{asset('assets/image/'.$donor->foto)}}" width="120">
                            </a>
                        </td>
                        <td>
                        @if ($donor->response)
                        {{ $donor->response['status'] }}
                        @else 
                        - 
                        @endif
                    </td>
                    <td>
                        @if ($donor->response)
                    {{ $donor->response['status'] == 'diterima' ? \Carbon\Carbon::parse($donor->response['jadwal'])->format('j F Y') : '-' }}                    
                    @else
                    -
                    @endif
                    </td>
                    <td>
                        <a href="{{route('response.edit', $donor->id)}}" class="btn btn-success">Change Response</a>
                    </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
