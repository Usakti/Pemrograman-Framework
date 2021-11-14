<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2>Update Data Mahasiswa</h2>
        @foreach($dataMahasiswa as $data)
        <form action="{{ route('updateData') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Nama Mahasiswa:</label>
                <input type="text" class="form-control" id="name" value="{{ $data->nama_mahasiswa }}" name="name">
                <input type="hidden" class="form-control" value="{{ $data->id }}" name="id">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" id="email" value="{{ $data->email }}" name="email">
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan:</label>
                <input type="text" class="form-control" id="jurusan" value="{{ $data->jurusan }}" name="jurusan">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
        @endforeach
    </div>
</body>

</html>
