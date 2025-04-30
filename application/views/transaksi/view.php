<main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tables</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Tables</h6>
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

    <!-- Konten Tabel -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="text-dark mb-0">Data Kategori</h6>
                    </div>
                    <div class="card-body px-4 pt-0 pb-4">
                        <div class="table-responsive">
                            <table id="tabelKategori" class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center text-xs">#</th>
                                        <th class="text-center text-xs">Bidang Usaha</th>
                                        <th class="text-center text-xs">Jenis Kategori</th>
                                        <th class="text-center text-xs">No Reference</th>
                                        <th class="text-center text-xs">Keterangan</th>
                                        <th class="text-center text-xs">Kategori</th>
                                        <th class="text-center text-xs">Jumlah Uang</th>
                                        <th class="text-center text-xs">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        foreach($listJurnal as $row): 
                                    ?>
                                    <tr>
                                        <td class="text-center text-sm"><?= $no++ ?></td>
                                        <td class="text-center text-sm"><?= $row->nama_bidang ?></td>
                                        <td class="text-center text-sm"><?= $row->nama_reff ?></td>
                                        <td class="text-center text-sm"><?= $row->no_reff ?></td>
                                        <td class="text-center text-sm">
                                          <?= ($row->jenis_saldo === 'kredit') ? 'Pemasukan' : 'Pengeluaran'; ?>
                                        </td>
                                        <td class="text-center text-sm"><?= $row->keteranganDetail ?></td>
                                        <td class="text-center text-sm"><?= number_format($row->saldo, 0, ',', '.') ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url('data_akun/edit/'.$row->tgl_transaksi) ?>" class="btn btn-sm btn-warning">Edit</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
