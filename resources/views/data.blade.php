<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Admin</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
    <script src="/vendor/datatables/buttons.server-side.js"></script>
</head>
<body>
    <h2 class="title-table">Laporan Pendonoran</h2>
    <div style="display: flex; justify-content: center; margin-bottom: 30px">
        <a href="{{route('logout')}}" style="text-align: center">Logout</a>
        <div style="margin: 0 10px"> | </div>
        <a href="/" style="text-align: center">Home</a>
    </div>
    <div style="display: flex; justify-content: flex-end; align-items: center; padding: 0 30px">
        {{-- menggunakan method GET karna route untuk masuk ke halaman data ini menggunakan ::get --}}
        <form action="" method="GET">
            @csrf
            <input type="text" name="search" placeholder="Cari berdasarkan nama...">
            <button type="submit" class="btn-login" style="margin-top: -1px">Cari</button>
        </form>
        {{-- refresh balik lg ke route data karna nanti pas di klik refresh mau bersihin riwayat pencarian sebelumnya dan balikin lagi nya ke halaman data lagi --}}
        <a href="{{route('data')}}" style="margin-left: 10px; margin-top: -10px">Refresh</a>
        <a href="{{route('export-pdf')}}" style="margin-left: 10px; margin-top: -10px">Cetak PDF</a>
        <a href="{{route('export.excel')}}" style="margin-left: 10px; margin-top: -10px">Cetak Excel</a>
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
                    <th>Status</th>
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
                        @php 
        $telp =  substr_replace($donor->no_telp, "62", 0, 1);
         if ($donor->response) {
            if ($donor->response['status'] == 'diterima'){
                $pesanWA = 'Hallo%20'  .   $donor->nama  . '%20Pendonoran Anda %20'.  $donor->response['status']. '  Mohon ke rumah sakit terdepat pada tanggal :' .$donor->response['jadwal'];   
            }else {
                $pesanWA = 'Hallo%20'  .   $donor->nama  . '%20Pendonoran Anda %20'.  $donor->response['status'];   
            }
       } 
       else {
           $pesanWA = 'Belum Menambahkan Response!';
       }
        @endphp
        <td><a href="https://wa.me/{{$telp}}?text={{$pesanWA}}" target="_blank">{{$telp}}</a></td>
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
                    <td style="display: flex; justify-content: center;">
                        <form action="{{route('destroy', $donor->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
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
                        @php 
                        $telp =  substr_replace($donor->no_telp, "62", 0, 1);
                         if ($donor->response) {
                            if ($donor->response['status'] == 'diterima'){
                                $pesanWA = 'Hallo%20'  .   $donor->nama  . '%20Pendonoran Anda %20'.  $donor->response['status']. '  Mohon ke rumah sakit terdepat pada tanggal :' .$donor->response['jadwal'];   
                            }else {
                                $pesanWA = 'Hallo%20'  .   $donor->nama  . '%20Pendonoran Anda %20'.  $donor->response['status'];   
                            }
                       } 
                       else {
                           $pesanWA = 'Belum Menambahkan Response!';
                       }
                        @endphp
                        <td><a href="https://wa.me/{{$telp}}?text={{$pesanWA}}" target="_blank">{{$telp}}</a></td>{{$telp}}</a></td>
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
                    <td style="display: flex; justify-content: center;">
                        <form action="{{route('destroy', $donor->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">Hapus</button>
                        </form>
                    </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
