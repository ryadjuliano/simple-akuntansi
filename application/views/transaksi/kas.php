<main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Kas</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Tambah Kas</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Tambah Kas</h6>
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
                    <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom py-3">
                        <h6 class="text-dark mb-0">Data Kas</h6>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKas">
                            ➕ Tambah Kas
                        </button>
                    </div>
                    <div class="card-body px-4 pt-0 pb-4">
                        <div class="table-responsive">
                            <table id="tabelKas" class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="text-center text-xs">#</th>
                                        <th class="text-center text-xs">Tanggal</th>
                                        <th class="text-center text-xs">Nama Penyesuaian</th>
                                        <th class="text-center text-xs">Jenis</th>
                                        <th class="text-center text-xs">Keterangan</th>
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
                                        <td class="text-center text-sm"><?= date('d-m-Y', strtotime($row->tgl_transaksi)) ?></td>
                                        <td class="text-center text-sm"><?= $row->keterangan ?></td>
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

    <!-- Modal Tambah Kas -->
    <div class="modal fade" id="modalTambahKas" tabindex="-1" aria-labelledby="modalTambahKasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="<?= base_url('user/createKas') ?>" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahKasLabel">Tambah Kas Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tgl_transaksi" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_penyesuaian" class="form-label">Nama Penyesuaian</label>
                            <input type="text" class="form-control" id="nama_penyesuaian" name="nama_penyesuaian" required>
                        </div>
                        <div class="mb-3">
                            <label for="no_reff" class="form-label">Bidang Usaha</label>
                                            <?= form_dropdown('akun_bidang', getDropdownListUsaha('akun_bidang', ['id', 'nama_bidang']), isset($data->nama_bidang) ? $data->nama_bidang : '', ['class' => 'form-select', 'id' => 'akun_bidang']) ?>
                                            <?= form_error('nama_bidang') ?>
                            </div>
                       
                        <div class="mb-3">
                        <label for="jenis_saldo" class="form-label">Jenis Saldo</label>
                  <?= form_dropdown('jenis_saldo', [
    'debit' => 'Uang Keluar',
    'kredit' => 'Uang Masuk'
], $data->jenis_saldo, ['class' => 'form-select', 'id' => 'jenis_saldo']) ?>
                  <?= form_error('jenis_saldo') ?>
                        </div>
                        <div class="mb-3">
                            <label for="nama_penyesuaian" class="form-label">Saldo</label>
                            <input type="text" class="form-control" id="saldo" name="saldo" value="<?= $data->saldo ?>" placeholder="Masukkan Saldo">
                  <?= form_error('saldo') ?>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>


