<?= $this->extend('admin/layout') ?>
<?= $this->section('content') ?>

<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

<div class="row">
    <!-- Kolom Kiri -->
    <div class="col-xl-5 col-lg-5 mb-4">
        
        <div class="card shadow mb-4 p-3">
            <!-- ... Konten Sambutan ... -->
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="font-weight-bold text-primary mb-2">
                            👋 Selamat Datang, Admin!
                        </h4>
                        <p class="text-gray-700 mb-0" style="font-size: 0.9rem;">
                            Pantau dan kelola data Sanggar Tari <strong>Gayatri Art</strong> Anda hari ini.
                        </p>
                        <a href="<?= base_url('admin/anggota') ?>" class="btn btn-primary btn-sm mt-3">
                            <i class="fas fa-users"></i> Lihat Anggota Sanggar
                        </a>
                    </div>
                    <div class="col-4 text-right">
                        <i class="fas fa-hand-holding-heart fa-4x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-calendar-alt"></i> Hari ini </h6>
            </div>
            <div class="card-body" id="calendar-container">
                <p class="text-center font-weight-bold h4 mb-2"><?= date('l, d F Y') ?></p>
                <hr class="mt-0">
                <div class="text-center">
                    <p class="text-xs text-gray-600 mb-1">Waktu Saat Ini:</p>
                    <span id="liveClock" class="font-weight-bold text-primary" style="font-size: 2.5rem;"></span>
                </div>
                <hr>
            </div>
        </div>
        
    </div>
    
    <!-- Kolom Kanan -->
    <div class="col-xl-7 col-lg-7">

        <div class="row">
            <!-- Kartu Statistik Baris 1 -->
            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Jumlah Anggota</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalAnggota ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Jumlah Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlahKelas ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-school fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
    <div class="col-lg-6 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Pendaftar Menunggu (Hari Ini)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $menungguHariIni ?></div>
                        <div class="text-gray-500 small mt-1">Segera Cek dan Verifikasi</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Anggota Baru (Bulan Ini)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $aktifBulanIni ?></div>
                        <div class="text-gray-500 small mt-1">Bulan: <?= date('F Y') ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
        <!-- Area DIAGRAM DONAT -->
        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Statistik Anggota Aktif (Laki-laki vs Perempuan)</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Laki-laki Aktif (<?= $anggotaLaki ?>)
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> Perempuan Aktif (<?= $anggotaPerempuan ?>)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // --- SKRIP JAM DIGITAL ---
    function updateClock() {
        var now = new Date();
        
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        var seconds = now.getSeconds().toString().padStart(2, '0');
        
        var time = hours + ':' + minutes + ':' + seconds;
        document.getElementById('liveClock').innerHTML = time;
    }

    setInterval(updateClock, 1000);
    updateClock();
</script>

<script>
    // --- SKRIP CHART.JS ---
    // 1. Ambil data dari PHP Controller
    var anggotaLaki = <?= $anggotaLaki ?>;
    var anggotaPerempuan = <?= $anggotaPerempuan ?>;

    // 2. Konfigurasi dan Gambar Diagram Donat
    // Kami membungkusnya dalam $(document).ready() untuk memastikan DOM sepenuhnya siap.
    // Walaupun skrip ini dimuat setelah HTML, pembungkusan ini adalah praktik terbaik.
    $(document).ready(function() {
        var ctx = document.getElementById("myPieChart");
        if (ctx) {
            var myPieChart = new Chart(ctx, {
                type: 'doughnut', 
                data: {
                    labels: ["Laki-laki Aktif", "Perempuan Aktif"],
                    datasets: [{
                        data: [anggotaLaki, anggotaPerempuan], 
                        backgroundColor: ['#36b9cc', '#f6c23e'], 
                        hoverBackgroundColor: ['#2c9faf', '#dda200'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function(previousValue, currentValue) {
                                    return previousValue + currentValue;
                                });
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                                return data.labels[tooltipItem.index] + ': ' + currentValue + ' (' + percentage + '%)';
                            }
                        }
                    },
                    legend: {
                        display: false 
                    },
                    cutoutPercentage: 80, 
                },
            });
        }
    });

</script>
<?= $this->endSection() ?>
