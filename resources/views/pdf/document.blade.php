<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        th {
            padding: 8px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }

        img {
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
        }
    </style>

</head>

<body>
    <div>
        <div>
            <h1>Bukti Pendaftaran Mahasiswa</h1>
            <div>
                <img src="{{ asset('storage/foto/' . $account->foto) }}" alt="Foto Profil"
                    style="max-width: 200px; height: auto; display: block; margin-bottom: 20px;">

            </div>
            <table>
                <tbody>
                    <tr>
                        <td><strong>Nama Lengkap:</strong></td>
                        <td>{{ $account->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td><strong>NISN:</strong></td>
                        <td>{{ $account->nisn }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat KTP:</strong></td>
                        <td>{{ $account->address_ktp }}</td>
                    </tr>
                    <tr>
                        <td><strong>Alamat Saat Ini:</strong></td>
                        <td>{{ $account->address_now }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kecamatan:</strong></td>
                        <td>{{ $account->kecamatan }}</td>
                    </tr>
                    <tr>
                        <td><strong>Provinsi:</strong></td>
                        <td>{{ $account->province->province }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kota/Kabupaten:</strong></td>
                        <td>{{ $account->city->city_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nomor Telepon:</strong></td>
                        <td>{{ $account->telp_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nomor Handphone:</strong></td>
                        <td>{{ $account->phone_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td>{{ $account->email }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal Lahir:</strong></td>
                        <td>{{ $account->tgl_lahir }}</td>
                    </tr>
                    <tr>
                        <td><strong>Kewarganegaraan:</strong></td>
                        <td>{{ $account->kewarganegaraan }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
