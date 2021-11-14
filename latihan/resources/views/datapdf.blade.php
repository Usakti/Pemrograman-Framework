<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        #mhs{
            border-collapse: collapse;
            width: 100%;
        }
        #mhs td, #mhs th{
            border: 1px solid #ddd;
            padding: 8px;
        }
        #mhs tr:nth-child(even){
            background-color: lightcoral;
        }
        #mhs th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: lightblue;
            color: #000000;
        }
    </style>
    <title>Data PDF</title>
</head>
<body>
    <table id="mhs">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Mahasiswa</th>
                <th>Jurusan</th>
                <th>Email</th>
            </tr>
        </thead>
        @foreach($showData as $data)
        <tbody>
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->nama_mahasiswa }}</td>
				<td>{{ $data->jurusan }}</td>
                <td>{{ $data->email }}</td>
            </tr>
        </tbody>
        @endforeach
    </table>
</body>
</html>
