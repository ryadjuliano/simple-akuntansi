<main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
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
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
            </div>
          </div>
          <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <?= form_open('data_akunsub/tambah', ['method' => 'post']) ?> <!-- Ganti 'kategori/simpan' sesuai controller & method kamu -->
                        <div class="form-group">
                            <label for="no_reff" class="col-form-label">No Reff:</label>
                            <input type="text" class="form-control" id="no_reff" name="no_reff" required>
                        </div>  
                        <div class="form-group">
                            <label for="kategori" class="col-form-label">Kategori:</label>
                            <select class="form-control" name="nama_reff" id="nama_reff" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach($dataAkun as $kat): ?>
                                    <option value="<?= $kat->no_reff ?>"><?= $kat->nama_reff ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama" class="col-form-label">Nama SubKategori:</label>
                            <input type="text" class="form-control" id="nama_reff_sub" name="nama_reff_sub" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan" class="col-form-label">Keterangan:</label>
                            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                    </div>
                    <?= form_close() ?>
                    </div>
                </div>
                </div>


          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <!-- <button type="button" class="btn btn-lg btn-su ccess btn-sm w-100 mt-4 mb-0">Tambah Kategori</button> -->
                <button type="button" class="btn bg-gradient-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Kategori
                    </button>
              </a>
            </li>
           
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Sub Kategori</h6>
            </div>
            <div class="table-responsive p-3">
            <table id="datatable" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-right">Nama Kategori</th>
                  <th class="text-rgiht">Nama Subkategori</th>
                  <th class="text-right">Keterangan</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
              <?php 
                $no = 1;
                foreach($dataAkun as $row): 
              ?>
                <tr>
                  <td class="text-center"><?= $no++ ?></td>
                  <td class="text-right"><?= $row->nama_reff?></td>
                  <td class="text-right"><?= $row->nama_reff?></td>
                  <td class="text-right"><?= $row->keterangan?></td>
                  <td class="text-center">
                  <a href="<?= base_url('data_akun/edit/'.$row->no_reff) ?>"  class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                          Edit
                        </a>
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
  </main>