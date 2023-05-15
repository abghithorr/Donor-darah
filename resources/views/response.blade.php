<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendonoran Darah</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>
    <form action="{{route('response.update', $darahId)}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="input-card">
            <label for="status">Status :</label>
            {{-- cek apakah data $report yg dr compact itu adaan, maksudnya adaaan tuh where di db responses nya ada data yg punya report_id sama kata yg dikirim ke path {report_id} --}}
            @if ($darahs)
            <select class="form-select" aria-label="Default select example" name="status">
                <option selected>Status</option>
                <option value="diterima" {{ $darahs['status'] == 'diterima' ? 'selected' : ''  }}>Diterima</option>
                <option value="ditolak" {{ $darahs['status'] == 'ditolak' ? 'selected' : ''  }}>Ditolak</option>
              </select>
            @else
            <select class="form-select" aria-label="Default select example" name="status" id="status">
                <option selected hidden disabled>Pilih Status</option>
                <option value="diterima">Diterima</option>
                <option value="ditolak">Ditolak</option>
              </select>
            @endif
        </div>
        <div class="form-control">
            <label for="">Schedule :</label>
            <input type="date" name="jadwal">
        </div>
        <button type="submit">Kirim Response</button>
    </form>
</body>
</html>