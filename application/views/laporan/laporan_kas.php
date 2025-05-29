<main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="#">Pages</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Laporan</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Laporan</h6>
            </nav>
        </div>
    </nav>

    <!-- Konten -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom py-3">
                        <h6 class="text-dark mb-0">Laporan Keuangan Perusahaan</h6>
                    </div>
                    <div class="card-body px-4 pt-4 pb-4">
                        <!-- Filter Perusahaan -->
                        <form method="post" action="">
                            <div class="row mb-4">
                                <div class="col-md-4">
                                    <label class="form-label">Pilih Perusahaan</label>
                                    <select name="perusahaan" class="form-control">
                                        <option value="">-- Pilih Perusahaan --</option>
                                        <option value="PT Maju Jaya" <?= set_value('perusahaan') == 'PT Maju Jaya' ? 'selected' : '' ?>>PT Maju Jaya</option>
                                        <option value="CV Sukses Selalu" <?= set_value('perusahaan') == 'CV Sukses Selalu' ? 'selected' : '' ?>>CV Sukses Selalu</option>
                                        <option value="PT Digital Nusantara" <?= set_value('perusahaan') == 'PT Digital Nusantara' ? 'selected' : '' ?>>PT Digital Nusantara</option>
                                    </select>
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                                </div>
                            </div>
                        </form>

                        <!-- Tabel Laporan -->
                        <?php if (isset($laporan)) : ?>
                            <div class="table-responsive mt-4">
                                <table class="table table-bordered">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Perusahaan</th>
                                            <th>Jumlah Uang</th>
                                            <th>Kas</th>
                                            <th>Pendapatan</th>
                                            <th>Uang Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($laporan as $i => $data): ?>
                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= $data['perusahaan'] ?></td>
                                                <td>Rp <?= number_format($data['jumlah_uang'], 0, ',', '.') ?></td>
                                                <td>Rp <?= number_format($data['kas'], 0, ',', '.') ?></td>
                                                <td>Rp <?= number_format($data['pendapatan'], 0, ',', '.') ?></td>
                                                <td>Rp <?= number_format($data['uang_keluar'], 0, ',', '.') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                            <div class="alert alert-warning mt-4">Data tidak ditemukan untuk perusahaan yang dipilih.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
