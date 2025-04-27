<main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Laporan</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Laporan</h6>
            </nav>
            <?php if ($this->session->flashdata('berhasil')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <?= $this->session->flashdata('berhasil'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Konten Laporan -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="text-dark mb-0">Laporan Penjualan</h6>
                    </div>
                    <div class="card-body px-4 pt-4 pb-4">
                        <!-- Form Filter -->
                        <form method="post" action="">
                            <div class="row mb-4">
                                <div class="col-md-3">
                                    <label class="form-label text-xs font-weight-bold">Periode</label>
                                    <input type="text" class="form-control" name="periode" placeholder="01-01-2025 s.d. 27-04-2025" value="01-01-2025 s.d. 27-04-2025">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-xs font-weight-bold">Pengeluaran</label>
                                    <select class="form-control" name="pengeluaran">
                                        <option value="resume">Resume</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-xs font-weight-bold">Tgl. Tandatangan</label>
                                    <input type="text" class="form-control" name="tgl_tandatangan" placeholder="27-04-2025" value="27-04-2025">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label text-xs font-weight-bold">Pejabat</label>
                                    <select class="form-control" name="pejabat">
                                        <option value="Agus Prawoto Hadi">Agus Prawoto Hadi (Pembina)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                </div>
                            </div>
                        </form>

                        <!-- Export Buttons -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-print"></i> Print</button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-file-excel"></i> Excel</button>
                                <button class="btn btn-sm btn-outline-secondary"><i class="fa fa-file-pdf"></i> PDF</button>
                            </div>
                        </div>

                        <!-- Laporan Laba Rugi -->
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <h5 class="text-uppercase">Laporan Laba Rugi</h5>
                                <h6 class="text-uppercase">Jagowebdev College</h6>
                                <p>Periode 01 Januari 2025 s.d. 27 April 2025</p>
                            </div>
                        </div>

                        <!-- Pendapatan -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-uppercase">Pendapatan</h6>
                                <p>Total Pendapatan: Rp <?= number_format(250000000, 0, ',', '.') ?></p>
                            </div>
                        </div>

                        <!-- Pengeluaran -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-uppercase">Pengeluaran</h6>
                                <p>Total Pengeluaran: Rp <?= number_format(150000000, 0, ',', '.') ?></p>
                            </div>
                        </div>

                        <!-- Laba -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <h6 class="text-uppercase">Laba</h6>
                                <p>Laba: Rp <?= number_format(250000000 - 150000000, 0, ',', '.') ?></p>
                            </div>
                        </div>

                        <!-- Tanda Tangan -->
                        <div class="row mt-5">
                            <div class="col-md-6 text-center">
                                <p>Yogyakarta, 27 April 2025</p>
                                <p>Pembina</p>
                                <br><br><br>
                                <p>Agus Prawoto Hadi</p>
                                <p>NIP Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>