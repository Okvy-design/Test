<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 10px; }
        .info-periode { margin-bottom: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .text-left { text-align: left; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin-bottom: 5px;">GAYATRI ART</h2>
        <h3 style="margin-top: 0;">LAPORAN REKAPITULASI KEHADIRAN ANGGOTA</h3>
    </div>

    <div class="info-periode">
        Periode : <?= $bulan ?> <?= $tahun ?> <br>
        Total Pertemuan Selama Bulan Ini : <?= $total_pertemuan ?> Kali
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="15%">ID Anggota</th>
                <th width="20%">Nama Anggota</th>
                <th width="15%">Kelas</th>
                <th width="10%">Total Hadir</th>
                <th width="10%">Total Tidak Hadir</th>
                <th width="25%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($laporan)): ?>
                <?php $no=1; foreach($laporan as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['id_anggota'] ?></td>
                    <td class="text-left"><?= $row['nama'] ?></td>
                    <td><?= $row['nama_kelas'] ?></td>
                    <td style="color: green; font-weight: bold;"><?= $row['total_hadir'] ?></td>
                    <td style="color: red; font-weight: bold;"><?= $row['total_tidak_hadir'] ?></td>
                    <td class="text-left" style="font-size: 10px;">
                        <?= $row['kumpulan_keterangan'] ?: '-' ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Tidak ada data kehadiran pada periode ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top: 30px; float: right; text-align: center;">
        <p>Dicetak pada: <?= date('d/m/Y') ?></p>
       
        <br><br><br>
        <p>( __________________________ )</p>
        <p>Admin Sanggar Gayatri Art</p>
    </div>
</body>
</html>