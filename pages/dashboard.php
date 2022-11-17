<!-- Page Heading -->
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div> -->

<!-- Content Row -->
<?php 
$link = 'Dashboard';
?>
<div class="row">
    <?php
    $bulan = date('m');
    $tahun = date('Y');
    if ($tahun) {
        $query = mysqli_query($dbconnect, "SELECT * FROM transaksi WHERE YEAR(tanggal_waktu) = '$tahun' ");

        $total = 0;
        $pen_tahun = 0;
        while ($r = $query->fetch_assoc()) {
            // total adalah hasil dari harga x qty
            $total = $r['total'];
            // total bayar adalah penjumlahan dari keseluruhan total
            $pen_tahun += $total;
        }
    }
    if ($bulan) {
        $query = mysqli_query($dbconnect, "SELECT * FROM transaksi WHERE MONTH(tanggal_waktu) = '$bulan' ");

        $total = 0;
        $pen_bulan = 0;
        while ($r = $query->fetch_assoc()) {
            // total adalah hasil dari harga x qty
            $total = $r['total'];
            // total bayar adalah penjumlahan dari keseluruhan total
            $pen_bulan += $total;
        }
    }
    $query = mysqli_query($dbconnect, "SELECT * FROM barang");

    $total = 0;
    $jumlah_sisa = 0;
    while ($r = $query->fetch_assoc()) {
        // total adalah hasil dari harga x qty
        $total = $r['jumlah'];
        // total bayar adalah penjumlahan dari keseluruhan total
        $jumlah_sisa += $total;
    }
    $query = mysqli_query($dbconnect, "SELECT * FROM barang_km");

    $total = 0;
    $jumlah_keluar = 0;
    while ($r = $query->fetch_assoc()) {
        // total adalah hasil dari harga x qty
        $total = $r['jumlah_keluar'];
        // total bayar adalah penjumlahan dari keseluruhan total
        $jumlah_keluar += $total;
    }
    ?>
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pendapatan Bulan <?php echo date('M') ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "Rp. " . number_format($pen_bulan); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Pendapatan Tahun <?php echo date('Y') ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "Rp. " . number_format($pen_tahun); ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Sisa Barang
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format($jumlah_sisa); ?> Barang</div>
                            </div>
                            <!-- <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Barang Keluar</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($jumlah_keluar); ?> Barang</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<!-- 
<div class="row">

    
    <div class="col-xl col-lg">
        <div class="card shadow mb-4">
            
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                <form method="POST" action="" class="form-inline">
                    <label style="margin-right: 10px;" for="date1">Tampilkan transaksi bulan </label>

                    <select class="form-control mr-2 form-control-sm" name="tahun">
                        <?php
                        $qry = mysqli_query($dbconnect, "SELECT tanggal_waktu FROM transaksi GROUP BY YEAR(tanggal_waktu)");
                        while ($t = mysqli_Fetch_array($qry)) {
                            $data = explode('-', $t['tanggal_waktu']);
                            $tahun = $data[0];
                            echo "<option value='$tahun'>$tahun</option>";
                        }
                        ?>

                    </select>
                    <button type="submit" name="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                </form>
               
            </div>
           
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>

                </div>
            </div>
        </div>
    </div>

</div> -->