<!doctype>
<html>

<head>
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            @if(session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            <div class="col-2">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                </button>
            </div>
            <div class="col-2">
                <a type="button" href="{{ route('download-pdf') }}" class="btn btn-outline-secondary">
                    Download PDF
                </a>
            </div>
            <div class="col-4">
                @if(session('user'))
                    <div class="my-auto text-center">
                        <h4>Selamat Datang {{ session('nama') }}</h4>
                    </div>
                @endif
            </div>
            <div class="col-2">
                <a type="button" href="{{ route('download-excel') }}" class="btn btn-outline-success">
                    Export Excel
                </a>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#import">
                    Import Excel
                </button>
            </div>
            <div class="col-5"></div>
            <div class="col-5"></div>
            <div class="col-2">
                <a type="button" href="{{ route('logout') }}" class="btn btn-danger my-2">
                    Logout
                </a>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <tr>
                        <th>ID</th>
                        <th>Nama Mahasiswa</th>
                        <th>Jurusan</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach($showData as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->nama_mahasiswa }}</td>
						<td>{{ $data->jurusan }}</td>
                        <td>{{ $data->email }}</td>
                        <td>
                            <!-- button ini di control oleh LatihanController dengan public function showViewUpdateData -->
                            <a href="{{ route('showViewUpdateData', $data->id) }}" class="btn btn-primary btn-sm">Update</a>
                            <a href="{{ route('deleteData', $data->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-12">
                <div id="chartData"></div>
            </div>
        </div>
    </div>
    @include('modal')
    @include('modalimport')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('chartData', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Data Analitik Jumlah Mahasiswa'
            },
            xAxis: {
                categories: {!!json_encode($categories)!!},
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f} Mahasiswa</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Jurusan',
                data: {!!json_encode($jumlah)!!}
            }]
        });
    </script>
</body>
