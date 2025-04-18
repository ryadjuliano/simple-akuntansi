  <!-- Main content -->
  <div class="main-content">
    <!-- Top navbar -->
    <nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
      <div class="container-fluid">
        <!-- Brand -->
        <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="">Dashboard</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <div class="media align-items-center">
                <span class="avatar avatar-sm rounded-circle">
                  <img alt="Image placeholder" src="<?= base_url('assets/img/theme/team-4-800x800.jpg') ?>">
                </span>
                <div class="media-body ml-2 d-none d-lg-block">
                  <span class="mb-0 text-sm  font-weight-bold"><?= ucwords($this->session->userdata('username')) ?></span>
                </div>
              </div>
            </a>
            <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
              <a href="<?= base_url('logout') ?>" class="dropdown-item">
                <i class="ni ni-user-run"></i>
                <span>Logout</span>
              </a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">    
          
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--8">
      <div class="row mt-5">
        <div class="col mb-5">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0 text-right">Jurnal Umum</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <div class="p-4">
                    <h4 class="text-center">Grafik Debit dan Kredit per Akun (Dummy Data)</h4>
                    <canvas id="jurnalChart" style="max-height: 400px;"></canvas>
                </div>
            </div>
          </div>
        </div>
        <div class="col mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0 text-right">Jurnal Umum</h3>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Akun</th>
                    <th scope="col">Ref</th>
                    <th scope="col">Debet</th>
                    <th scope="col">Kredit</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    foreach($jurnals as $row):
                    if($row->jenis_saldo=='debit'):
                  ?>
                  <tr>
                    <td>
                      <?= date_indo($row->tgl_transaksi) ?>
                    </td>
                    <td>
                      <?= $row->nama_reff ?>
                    </td>
                    <td>
                      <?= $row->no_reff ?>
                    </td>
                    <td>
                      <?= 'Rp. '.number_format($row->saldo,0,',','.') ?>
                    </td>
                    <td>
                      Rp. 0
                    </td>
                    <td>
                      <?= $row->keterangan ?>
                    </td>
                  </tr>
                  <?php 
                    endif;
                    if($row->jenis_saldo=='kredit'):
                  ?>
                  <tr>
                    <td>
                      <?= date_indo($row->tgl_transaksi) ?>
                    </td>
                    <td class="text-right"><?= $row->nama_reff ?></td>
                    <td><?= $row->no_reff ?></td>
                    <td>
                      Rp. 0
                    </td>
                    <td>
                    <?= 'Rp. '.number_format($row->saldo,0,',','.') ?>
                    </td> 
                    <td>
                      <?= $row->keterangan ?>
                    </td>          
                  </tr>  
                  <?php endif;?>
                  <?php endforeach ?>
                  <?php if($totalDebit->saldo != $totalKredit->saldo){ ?>
                  <tr>
                    <td colspan="3" class="text-center"><b>Jumlah Total</b></td>
                    <td class="text-danger"><b><?= 'Rp. '.number_format($totalDebit->saldo,0,',','.') ?></b></td>
                    <td colspan="2" class="text-danger"><b><?= 'Rp. '.number_format($totalKredit->saldo,0,',','.') ?></b></td>
                  </tr>
                  <tr  class="text-center bg-danger ">
                    <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">TIDAK SEIMBANG</td>
                  </tr>
                  <?php }else{  ?>
                    <tr>
                    <td colspan="3" class="text-center"><b>Jumlah Total</b></td>
                    <td class="text-success"><b><?= 'Rp. '.number_format($totalDebit->saldo,0,',','.') ?></b></td>
                    <td colspan="2" class="text-success"><b><?= 'Rp. '.number_format($totalKredit->saldo,0,',','.') ?></b></td>
                  </tr>
                  <tr class="text-center bg-success">
                    <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">SEIMBANG</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
        </div>
        <div class="col mt-5 p-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0 text-right">Buku Besar</h3>
                </div>
              </div>
            </div>
            <div class="nav-wrapper mx-3">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <?php 
                      $i = 0;
                      foreach($dataAkunTransaksi as $row):
                      $i++;
                    ?>
                    <li class="nav-item mb-4">
                        <a class="nav-link mb-sm-3 mb-md-0 tab-nav" id="tabs-icons-text-<?=$i?>-tab" data-toggle="tab" href="#tabs-icons-text-<?=$i?>" role="tab" aria-controls="tabs-icons-text-<?=$i?>" aria-selected="true"><?= $row->nama_reff ?></a>
                    </li>
                    <?php endforeach ?>
                </ul>
            </div>
            <div class="card" style="border-top: 2px solid white">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <?php 
                          $a=0;
                          $debit = 0;
                          $kredit = 0;
                          
                          for($i=0;$i<$jumlah;$i++) :                          
                          $a++;
                          $s=0;
                          $deb = $saldo[$i];
                        ?>
                        <div class="tab-pane fade" id="tabs-icons-text-<?= $a ?>" role="tabpanel" aria-labelledby="tabs-icons-text-<?= $a ?>-tab">
                            <div class="row">
                              <div class="col">
                                <b><?= $data[$i][$s]->nama_reff ?></b>
                              </div>
                              <div class="col text-right">
                                <b>No. <?= $data[$i][$s]->no_reff ?></b>
                              </div>
                            </div>
                            <p class="description">
                            <div class="table-responsive">
                              <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                  <tr>
                                    <th rowspan="2">Tanggal</th>
                                    <th rowspan="2">Keterangan </th>
                                    <th rowspan="2">Debit</th>
                                    <th rowspan="2">Kredit</th>
                                    <th colspan="2" class="text-center">Saldo</th>
                                  </tr>
                                  <tr>
                                    <th class="text-center">Debit</th>
                                    <th class="text-center">Kredit</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    for($j=0;$j<count($data[$i]);$j++):
                                      $timeStampt = strtotime($data[$i][$j]->tgl_transaksi);
                                      $bulan = date('m',$timeStampt);

                                      $tahun = date('Y',$timeStampt);
                                      $tgl = date('d',$timeStampt);
                                      $bulan = medium_bulan($bulan);
                                  ?>
                                  <tr>
                                      <td><?= $tgl.' '.$bulan.' '.$tahun ?></td>
                                      <td><?= $data[$i][$j]->keterangan ?></td>
                                      <?php 
                                        if($data[$i][$j]->jenis_saldo=='debit'){
                                      ?>
                                        <td>
                                          <?= 'Rp. '.number_format($data[$i][$j]->saldo,0,',','.') ?>
                                        </td>
                                        <td>Rp. 0</td>
                                      <?php 
                                        }else{
                                      ?>
                                        <td>Rp. 0</td>
                                        <td>
                                          <?= 'Rp. '.number_format($data[$i][$j]->saldo,0,',','.') ?>
                                        </td>
                                      <?php } ?>
                                      <?php
                                        if($deb[$j]->jenis_saldo=="debit"){
                                          $debit = $debit + $deb[$j]->saldo;
                                        }else{
                                          $kredit = $kredit + $deb[$j]->saldo;
                                        }
  
                                        $hasil = $debit-$kredit;
                                      ?>
                                      <?php if($hasil>=0){ ?>
                                        <td><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                                        <td> - </td>
                                      <?php }else{ ?>
                                        <td> - </td>
                                        <td><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
                                      <?php } ?>
                                  </tr>
                                  <?php endfor ?>
                                  <?php
                                    $debit = 0;
                                    $kredit = 0;
                                  ?>
                                  <td class="text-center" colspan="4"><b>Total</b></td>
                                  <?php if($hasil>=0){ ?>
                                    <td class="text-success"><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                                    <td> - </td>
                                  <?php }else{ ?>
                                    <td> - </td>
                                    <td class="text-danger"><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                        <?php endfor ?>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col mt-5 p-0">
                  <div class="card shadow">
                    <div class="card-header border-0">
                      <div class="row align-items-center">
                        <div class="col">
                          <h3 class="mb-0 text-right">Neraca Saldo</h3>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
            <?php 
                $a=0;
                $debit = 0;
                $kredit = 0;
            ?>
              <!-- Projects table Neraca Saldo -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" class="text-center">No. Akun</th>
                    <th scope="col" class="text-center">Nama Akun</th>
                    <th scope="col" class="text-center">Debit</th>
                    <th scope="col" class="text-center">Kredit</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        $totalDebit=0;
                        $totalKredit=0;
                        for($i=0;$i<$jumlah;$i++) :                          
                            $a++;
                            $s=0;
                            $deb = $saldo[$i];
                    ?>
                    <tr>
                        <td class="text-center">
                            <?= $data[$i][$s]->no_reff ?>
                        </td>
                        <td >
                            <?= $data[$i][$s]->nama_reff ?>
                        </td>
                        <?php 
                            for($j=0;$j<count($data[$i]);$j++):
                                if($deb[$j]->jenis_saldo=="debit"){
                                    $debit = $debit + $deb[$j]->saldo;
                                }else{
                                    $kredit = $kredit + $deb[$j]->saldo;
                                }
                                $hasil = $debit-$kredit;
                            endfor 
                        ?>
                        <?php 
                            if($hasil>=0){ ?>
                                <td><?= 'Rp. '.number_format($hasil,0,',','.') ?></td>
                                <td> - </td>
                            <?php $totalDebit += $hasil; ?>
                        <?php }else{ ?>
                                <td> - </td>
                                <td><?= 'Rp. '.number_format(abs($hasil),0,',','.') ?></td>
                                <?php $totalKredit += $hasil; ?>
                        <?php } ?>
                        <?php
                            $debit = 0;
                            $kredit = 0;
                        ?>
                    </tr>
                    <?php endfor ?>
                    <?php if($totalDebit != abs($totalKredit)){ ?>
                    <tr>
                        <td class="text-center" colspan="2"><b>Total</b></td>
                        <td class="text-danger"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                        <td class="text-danger"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
                    </tr>
                    <tr class="bg-danger text-center">
                        <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">TIDAK SEIMBANG</td>
                    </tr>
                    <?php }else{ ?>
                      <tr>
                        <td class="text-center" colspan="2"><b>Total</b></td>
                        <td class="text-success"><?= 'Rp. '.number_format($totalDebit,0,',','.') ?></td>
                        <td class="text-success"><?= 'Rp. '.number_format(abs($totalKredit),0,',','.') ?></td>
                    </tr>
                    <tr class="bg-success text-center">
                        <td colspan="6" class="text-white" style="font-weight:bolder;font-size:19px">SEIMBANG</td>
                    </tr>
                    <?php } ?>  
                </tbody>
              </table>
            </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  // Dummy data untuk grafik
  const jurnalData = [
    { nama_reff: 'Kas', debit: 5000000, kredit: 1000000 },
    { nama_reff: 'Piutang Usaha', debit: 3000000, kredit: 500000 },
    { nama_reff: 'Utang Usaha', debit: 0, kredit: 4000000 },
    { nama_reff: 'Pendapatan', debit: 200000, kredit: 6000000 },
    { nama_reff: 'Beban Operasional', debit: 2500000, kredit: 0 }
  ];

  // Siapkan data untuk Chart.js
  const labels = jurnalData.map(item => item.nama_reff);
  const debitData = jurnalData.map(item => item.debit);
  const kreditData = jurnalData.map(item => item.kredit);

  // Buat barchart
  const ctx = document.getElementById('jurnalChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: labels,
      datasets: [
        {
          label: 'Debit',
          data: debitData,
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        },
        {
          label: 'Kredit',
          data: kreditData,
          backgroundColor: 'rgba(255, 99, 132, 0.6)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Nominal (Rp)'
          },
          ticks: {
            callback: function(value) {
              return 'Rp ' + value.toLocaleString('id-ID');
            }
          }
        },
        x: {
          title: {
            display: true,
            text: 'Nama Akun'
          }
        }
      },
      plugins: {
        legend: {
          position: 'top'
        },
        tooltip: {
          callbacks: {
            label: function(context) {
              let label = context.dataset.label || '';
              if (label) {
                label += ': ';
              }
              label += 'Rp ' + context.parsed.y.toLocaleString('id-ID');
              return label;
            }
          }
        }
      }
    }
  });
</script>