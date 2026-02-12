<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #e9ecef; }
        .text-left { text-align: left; }
        .footer { margin-top: 30px; float: right; width: 250px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin: 0;">SANGGAR TARI GAYATRI ART</h2>
        <p style="margin: 5px 0;">Kota Pekalongan</p>
        <h4 style="margin: 5px 0;">REKAP DATA ANGGOTA ANGKATAN <?= $angkatan ?> TAHUN <?= $tahun ?></h4>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th>ID Anggota</th>
                <th>Nama Anggota</th>
                <th>L/P</th>
                <th>Kelas</th>
                <th>Status</th>
                <th>Umur</th>
                <th>Tgl Daftar</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($laporan)): ?>
                <?php $no=1; foreach($laporan as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['id_anggota'] ?></td>
                    <td class="text-left"><?= $row['nama'] ?></td>
                    <td><?= ($row['jenis_kelamin'] == 'laki-laki') ? 'L' : 'P' ?></td>
                    <td><?= $row['nama_kelas'] ?? '-' ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                    <td><?= $row['umur'] ?> Thn</td>
                    <td><?= date('d/m/Y', strtotime($row['tgl_daftar'])) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Tidak ada data anggota untuk angkatan dan tahun ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?= $tanggal_cetak ?></p>
        <p>Dicetak oleh Admin: <strong><?= $admin ?></strong></p>
        <br><br><br>
        <p>( __________________________ )</p>
        <p>Admin Sanggar Gayatri Art</p>
    </div>
</body>
</html>