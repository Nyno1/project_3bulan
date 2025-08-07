<!DOCTYPE html>
<html>
<head>
    <title>Tambah Sertifikat Siswa</title>
</head>
<body>
    <h2>Form Tambah Sertifikat</h2>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form action="/sertifikat/store" method="POST" enctype="multipart/form-data">
        @csrf

        <label>NIS:</label><br>
        <input type="text" name="nis" required><br><br>

        <label>Nama Siswa:</label><br>
        <input type="text" name="nama_siswa" required><br><br>

        <label>Jenis Sertifikat:</label><br>
        <input type="text" name="jenis_sertifikat" required><br><br>

        <label>Tanggal Diraih:</label><br>
        <input type="date" name="tanggal_diraih" required><br><br>

        <label>Foto Sertifikat:</label><br>
        <input type="file" name="foto_sertifikat" accept="image/*" required><br><br>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>
