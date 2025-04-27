<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><?= $title ?></li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0"><?= $titleTag ?></h6>
        </nav>
        <?php if ($this->session->flashdata('berhasil')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <?= $this->session->flashdata('berhasil'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
            </div>
          </div>
        
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
     <!-- Konten Tabel -->
     <div class="container-fluid mt--8">
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="card shadow">
        <div class="card-header bg-gradient-warning text-white">
          <h4 class="mb-0"><?= $title ?> Transaksi</h4>
        </div>
        <div class="card-body">
          <form action="<?= base_url($action) ?>" method="post">
            <?php if (!empty($id)): ?>
              <input type="hidden" name="id" value="<?= $id ?>">
            <?php endif; ?>

            <div class="row mb-3">
              <div class="col-md-6 mb-3">
                <label for="datepicker" class="form-label">Tanggal Transaksi</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                  <input type="text" class="form-control" id="datepicker" name="tgl_transaksi" value="<?= $data->tgl_transaksi ?>" placeholder="YYYY-MM-DD">
                </div>
                <?= form_error('tgl_transaksi') ?>
              </div>

              <div class="col-md-6 mb-3">
                <label for="no_reff" class="form-label">Nama Transaksi</label>
                <?= form_dropdown('no_reff', getDropdownList('akun', ['no_reff','nama_reff']), $data->no_reff, ['class'=>'form-select', 'id'=>'no_reff']) ?>
                <?= form_error('no_reff') ?>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6 mb-3">
                <!-- <label for="reff" class="form-label">No. Reff</label> -->
                <input type="hidden" class="form-control" id="reff" name="reff" readonly>

                <label for="sub_kategori">Sub Kategori:</label>
                    <select name="sub_kategori" id="sub_kategori" class="form-control">
                        <option value="">-- Pilih Sub Kategori --</option>
                    </select>
              </div>

              <div class="col-md-6 mb-3">
                <label for="jenis_saldo" class="form-label">Jenis Saldo</label>
                <?= form_dropdown('jenis_saldo', ['debit'=>'Debit','kredit'=>'Kredit'], $data->jenis_saldo, ['class'=>'form-select', 'id'=>'jenis_saldo']) ?>
                <?= form_error('jenis_saldo') ?>
              </div>
            </div>

            <div class="row mb-3">
              <div class="col-md-6 mb-3">
                <label for="saldo" class="form-label">Saldo</label>
                <input type="text" class="form-control" id="saldo" name="saldo" value="<?= $data->saldo ?>" placeholder="Masukkan Saldo">
                <?= form_error('saldo') ?>
              </div>

              <div class="col-md-6 mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $data->keterangan ?>" placeholder="Keterangan transaksi">
                <?= form_error('keterangan') ?>
              </div>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success"><?= $title ?></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

    </div>
  </main>
