<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Jadwal Kelas <?= $kelas['nama_kelas']; ?></title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12pt; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
        .header { margin-bottom: 20px; }
        .header p { margin: 4px 0; }
        .bold { font-weight: bold; }
        .label { font-weight: bold; }
        .info { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <p>Tanggal <span class="label">Cetak :</span> <?= $tanggal; ?></p>
        <p class="bold">Nama Kelas : <?= $kelas['nama_kelas']; ?></p>
        <p>Pelatih : <?= $kelas['nama_pelatih']; ?></p>
        <p>Jumlah anggota kelas : <?= count($anggota); ?></p>
    </div>

    <p>Berikut daftar nama anggota kelas</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($anggota) > 0): ?>
                <?php $no = 1; foreach ($anggota as $a): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $a['nama']; ?></td>
                    <td><?= $a['umur']; ?></td>
                    <td><?= $a['alamat']; ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" style="text-align:center;">Belum ada anggota pada kelas ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
