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
                        <!-- Form Filter -->
<form method="post" action="<?= base_url('laporan/penjualan') ?>">
    <div class="row mb-4">
        <div class="col-md-3">
            <label class="form-label text-xs font-weight-bold">Bulan</label>
            <select class="form-control" name="periode_bulan" required>
                <option value="">-- Pilih Bulan --</option>
                <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $bulanNama = date('F', mktime(0, 0, 0, $i, 10));
                        $selected = ($i == set_value('periode_bulan')) ? 'selected' : '';
                        echo "<option value='{$i}' {$selected}>" . ucfirst($bulanNama) . "</option>";
                    }
                ?>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label for="akun_bidang" class="form-label">Bidang Usaha</label>
            <?= form_dropdown(
                'akun_bidang',
                getDropdownListUsaha('akun_bidang', ['id', 'nama_bidang']),
                set_value('akun_bidang'),
                ['class' => 'form-select', 'id' => 'akun_bidang']
            ); ?>
            <?= form_error('akun_bidang') ?>
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary btn-sm me-2">Submit</button>
            <button type="button" class="btn btn-outline-secondary btn-sm" onclick="printLaporan()">
                <i class="fa fa-print"></i> Print
            </button>
        </div>
    </div>
</form>

<?php if (!empty($laporan)) : ?>
<div  id="laporan-tabel" class="table-responsive mt-4">
  <table class="table table-bordered table-striped table-hover">
  <thead class="table-primary text-center align-middle">
    <tr>
      <th>No</th>
      <th>Tanggal</th>
      <th>Uraian</th>
      <th>Debit</th>
      <th>Kredit</th>
      <th>Setor Bank</th>
      <th>PIC</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $total_debit = 0;
    $total_kredit = 0;
    $total_setor = 0;

    foreach ($laporan as $row):
      $debit = ($row->jenis_saldo === 'debit') ? $row->saldo : 0;
      $kredit = ($row->jenis_saldo === 'kredit') ? $row->saldo : 0;
      $setor = ($row->keterangan === 'Setor') ? $row->saldo : 0;

      $total_debit += $debit;
      $total_kredit += $kredit;
      $total_setor += $setor;
    ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= date('d/m/Y', strtotime($row->tgl_transaksi)) ?></td>
        <td><?= $row->keterangan ?></td>
        <td class="text-end"><?= $debit ? number_format($debit, 0, ',', '.') : '' ?></td>
        <td class="text-end"><?= $kredit ? number_format($kredit, 0, ',', '.') : '' ?></td>
        <td class="text-end"><?= $setor ? number_format($setor, 0, ',', '.') : '' ?></td>
        <td><?= $row->nama_reff ?></td>
        <td><?= $row->keteranganDetail ?></td>
      </tr>
    <?php endforeach; ?>

    <tr class="fw-bold bg-light">
      <td colspan="3" class="text-end">Total</td>
      <td class="text-end"><?= number_format($total_debit, 0, ',', '.') ?></td>
      <td class="text-end"><?= number_format($total_kredit, 0, ',', '.') ?></td>
      <td class="text-end"><?= number_format($total_setor, 0, ',', '.') ?></td>
      <td colspan="2"></td>
    </tr>
    <tr class="fw-bold bg-success text-white">
      <td colspan="3" class="text-end">Saldo</td>
      <td colspan="5">Rp <?= number_format(($total_kredit - $total_debit), 0, ',', '.') ?></td>
    </tr>
  </tbody>
</table>

</div>
<?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
  function printLaporan() {
    const content = document.getElementById("laporan-tabel").innerHTML;
    const printWindow = window.open('', '', 'width=800,height=600');
    printWindow.document.write(`
      <html>
        <head>
          <title>Print Laporan</title>
          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
          <style>
            body { padding: 20px; font-size: 12px; }
            table { font-size: 12px; }
            th, td { padding: 5px; }
          </style>
        </head>
        <body onload="window.print(); window.close();">
          <h5 class="text-center mb-4">Laporan Keuangan</h5>
          ${content}
        </body>
      </html>
    `);
    printWindow.document.close();
  }
</script>
