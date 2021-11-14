<!doctype>
<html>

<head>
    <title>File Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah File
                </button>
            </div>
            <br>
            <div class="col-12">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Nama File</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach($showData as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->nama_file }}</td>
                        <td>
                            <!-- button ini di control oleh LatihanController dengan public function showViewUpdateData -->
                            <a href="{{ url('storage/'.$data->url) }}" class="btn btn-primary btn-sm">View</a>
                            <a href="/download/{{ $data->url }}" class="btn btn-primary btn-sm">Download</a>
                            <a href="{{ route('deleteFile', $data->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-1">
                <a type="button" href="{{ route('index') }}" class="btn btn-danger">
                    Kembali
                </a>
            </div>
        </div>
    </div>
    @include('modalfile')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>
