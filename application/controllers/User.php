<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(['url','form','sia','tgl_indo']);
        $this->load->library(['session','form_validation']);
        $this->load->model('Akun_model','akun',true);
        $this->load->model('Jurnal_model','jurnal',true);
        $this->load->model('User_model','user',true);
        $login = $this->session->userdata('login');
        if(!$login){
            redirect('login');
        }
    }

    public function index(){
        $titleTag = 'Dashboard';
        $content = 'user/dashboard_grafik';
        $dataAkun = $this->akun->getAkun();
        $dataAkunTransaksi = $this->jurnal->getAkunInJurnal();
        
        foreach($dataAkunTransaksi as $row){
            $data[] = (array) $this->jurnal->getJurnalByNoReff($row->no_reff);
            $saldo[] = (array) $this->jurnal->getJurnalByNoReffSaldo($row->no_reff);
        }




        // if($data == null || $saldo == null){
        //     $data = 0;
        //     $saldo = 0;
        // }
        
        $jumlah = count($data);

        $jurnals = $this->jurnal->getJurnalJoinAkun();
        $totalDebit = $this->jurnal->getTotalSaldoGroup('debit');
        $totalKredit = $this->jurnal->getTotalSaldoGroup('kredit');
        $totalKreditGroup = $this->jurnal->getTotalSaldoGroup('kredit');
        

        // echo '<pre>';
        // print_r($totalKreditGroiup);
        // die();
        $this->load->view('template',compact('content','dataAkun','titleTag','jurnals','totalDebit','totalKreditGroup','totalKredit','jumlah','data','saldo','dataAkunTransaksi'));
    }

    public function dataAkun(){
        $content = 'income/kategori';
        $titleTag = 'Data Akun';
        $dataAkun = $this->akun->getAkun();
        $this->load->view('template',compact('content','dataAkun','titleTag'));
    }
    
    public function getKategori() {
        $dataAkun = $this->akun->getAkunWithSub();
       
        // $data['kategori'] = $this->akun->getKategori(); // method baru ambil data kategori
        $content = 'income/subkategori';
        $this->load->view('template',compact('content','dataAkun'));
    }

    public function isNamaAkunThere($str){
        $namaAkun = $this->akun->countAkunByNama($str);
        if($namaAkun >= 1){
            $this->form_validation->set_message('isNamaAkunThere', 'Nama Akun Sudah Ada');
            return false;
        }
        return true;
    }

    // isNoAkunThere berarti no akun sudah ada
    public function isNoAkunThere($str){
        $noAkun = $this->akun->countAkunByNoReff($str);
        if($noAkun >= 1){
            $this->form_validation->set_message('isNoAkunThere', 'No.Reff Sudah Ada');
            return false;
        }
        return true;
    }

    public function createAkun(){
        $title = 'Tambah';
        $titleTag = 'Tambah Data Akun';
        $action = 'data_akun/tambah';
        $content = 'user/form_akun';

        if(!$_POST)
        {
            $data = (object) $this->akun->getDefaultValues();
        }
        else
        {
            $data = (object) $this->input->post(null,true);
            $data->id_user = $this->session->userdata('id');
        }

        if(!$this->akun->validate())
        {
            // $this->load->view('template',compact('content','title','action','data','titleTag'));
            return;
        }
        $this->akun->insertAkun($data);
        $this->session->set_flashdata('berhasil','Data Akun Berhasil Di Tambahkan');
        redirect('data_akun');
    }

    public function editAkun($no_reff = null){
        $title = 'Edit';
        $titleTag = 'Edit Data Akun';
        $action = 'data_akun/edit/'.$no_reff;
        $content = 'user/form_akun';

        if(!$_POST)
        {
            $data = (object) $this->akun->getAkunByNo($no_reff);
        }
        else
        {
            $data = (object) $this->input->post(null,true);
            $data->id_user = $this->session->userdata('id');
        }

        if(!$this->akun->validate())
        {
            $this->load->view('template',compact('content','title','action','data','titleTag'));
            return;
        }
        
        $this->akun->updateAkun($no_reff,$data);
        $this->session->set_flashdata('berhasil','Data Akun Berhasil Di Ubah');
        redirect('data_akun');
    }

    public function deleteAkun(){
        $id = $this->input->post('id',true);
        $noReffTransaksi = $this->jurnal->countJurnalNoReff($id);

        if($noReffTransaksi >= 0 )
        {
            $this->session->set_flashdata('dataNull','No.Reff '.$id.' Tidak Bisa Di Hapus Karena Data Akun Ada Di Jurnal Umum');
            redirect('data_akun');
        }
        $this->akun->deleteAkun($id);
        $this->session->set_flashdata('berhasilHapus','Data akun dengan No.Reff '.$id.' berhasil di hapus');
        redirect('data_akun');
    }


    public function createAkunSub(){
        // $title = 'Tambah';
        // $titleTag = 'Tambah Data Akun';
        // $action = 'data_akunsub/tambah';
        // $content = 'user/form_akun';

        if(!$_POST)
        {
            $data = (object) $this->akun->getDefaultValues();
        }
        else
        {
            $data = (object) $this->input->post(null,true);
            $data->id_user = $this->session->userdata('id');
        }

        
        $this->akun->insertAkunSub($data);
        $this->session->set_flashdata('berhasil','Data Akun Berhasil Di Tambahkan');
        redirect('data_kategori');
    }

    public function jurnalUmum(){
        $titleTag = 'Jurnal Umum';
        $content = 'transaksi/view';
        // $listJurnal = $this->jurnal->getJurnalByYearAndMonth();
        $tahun = $this->jurnal->getJurnalByYear();
        // $bulan = date('m');
        $listJurnal = $this->jurnal->getJurnalJoinAkunDetailAll();
        // echo '<pre>';
        // print_r($listJurnal);
        // die();
   
        $this->load->view('template',compact('content','listJurnal','titleTag','tahun'));
    }
    public function jurnalUmumDetail(){
        $content = 'user/jurnal_umum';
        $titleTag = 'Jurnal Umum';
        $bulan = $this->input->post('bulan',true);
        $tahun = $this->input->post('tahun',true);
        $jurnals = null;

        if(empty($bulan) || empty($tahun)){
            redirect('jurnal_umum');
        }

        $jurnals = $this->jurnal->getJurnalJoinAkunDetail($bulan,$tahun);
        $totalDebit = $this->jurnal->getTotalSaldoDetail('debit',$bulan,$tahun);
        $totalKredit = $this->jurnal->getTotalSaldoDetail('kredit',$bulan,$tahun);

        if($jurnals==null){
            $this->session->set_flashdata('dataNull','Data Jurnal Dengan Bulan '.bulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
            redirect('jurnal_umum');
        }

        $this->load->view('template',compact('content','jurnals','totalDebit','totalKredit','titleTag'));
    }

    public function createJurnal()
    {
        $title = 'Tambah'; 
        $content = 'transaksi/create'; 
        $action = 'jurnal_umum/tambah'; 
        $tgl_input = date('Y-m-d H:i:s'); 
        $id_user = $this->session->userdata('id'); 
        $titleTag = 'Tambah Jurnal Umum';

        if(!$_POST)
        {
            $data = (object) $this->jurnal->getDefaultValues();
        }
        else
        {
            $data = (object) 
            [
                'id_user'=>$id_user,
                'no_reff'=>$this->input->post('no_reff',true),
                'tgl_input'=>$tgl_input,
                'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                'jenis_saldo'=>$this->input->post('jenis_saldo',true),
                'saldo'=>$this->input->post('saldo',true),
                'keterangan'=>$this->input->post('keterangan',true),
                'akun_bidang'=>$this->input->post('akun_bidang',true),                                                                                                                                              
                'no_reff_sub'=>$this->input->post('akun_sub',true)
            ];


        }

        if(!$this->jurnal->validate()){
            $this->load->view('template',compact('content','title','action','data','titleTag'));
            return;
        }
        
        $this->jurnal->insertJurnal($data);
        $this->session->set_flashdata('berhasil','Data Jurnal Berhasil Di Tambahkan');
        redirect('jurnal_umum');    
    }

    public function createKas()
    {
        $title = 'Tambah'; 
        $content = 'transaksi/kas'; 
        $action = 'user/createKas'; 
        $tgl_input = date('Y-m-d H:i:s'); 
        $id_user = $this->session->userdata('id'); 
        // $titleTag = 'Tambah Jur';

        if(!$_POST)
        {
            $data = (object) $this->jurnal->getDefaultValues();
          
        }
        else
        {
            $data = (object) 
            [
                'id_user'=>$id_user,
                // 'no_reff'=>$this->input->post('no_reff',true),
                'tgl_input'=>$tgl_input,
                'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                'jenis_saldo'=>$this->input->post('jenis_saldo',true),
                'saldo'=>$this->input->post('saldo',true),
                'keterangan'=>$this->input->post('keterangan',true),
                'status_kas'=> 1,
            ];


            
        }
    
       
        $this->jurnal->insertJurnal($data);
        $this->session->set_flashdata('berhasil','Data Jurnal Berhasil Di Tambahkan');
        redirect('kas');   
    }

    
    public function kas()
    {
        $title = 'Tambah'; 
        $content = 'transaksi/kas'; 
        $action = 'user/createKas'; 
        $tgl_input = date('Y-m-d H:i:s'); 
        $id_user = $this->session->userdata('id'); 
        $titleTag = 'Tambah Kas';
        
        $data = (object) $this->jurnal->getDefaultValues();
        $listJurnal = $this->jurnal->getJurnalJoinAkunDetailAllKas('kredit',1);


        // echo "<pre />";
        // print_r($listJurnal);
        // exit();
   
        $this->load->view('template',compact('content','title','listJurnal','action','data','titleTag'));
    }


    public function editForm(){
        if($_POST){
            $id = $this->input->post('id',true);
            $title = 'Edit'; $content = 'user/form_jurnal'; $action = 'jurnal_umum/edit'; $titleTag = 'Edit Jurnal Umum';

            $data = (object) $this->jurnal->getJurnalById($id);

            $this->load->view('template',compact('content','title','action','data','id','titleTag'));
        }else{
            redirect('jurnal_umum');
        }
    }

    public function editJurnal(){
        $title = 'Edit'; $content = 'user/form_jurnal'; $action = 'jurnal_umum/edit'; $tgl_input = date('Y-m-d H:i:s'); $id_user = $this->session->userdata('id'); $titleTag = 'Edit Jurnal Umum';

        if($_POST){
            $data = (object) [
                'id_user'=>$id_user,
                'no_reff'=>$this->input->post('no_reff',true),
                'tgl_input'=>$tgl_input,
                'tgl_transaksi'=>$this->input->post('tgl_transaksi',true),
                'jenis_saldo'=>$this->input->post('jenis_saldo',true),
                'saldo'=>$this->input->post('saldo',true),
                'keterangan'=>$this->input->post('keterangan',true)
            ];
            $id = $this->input->post('id',true);
        }

        if(!$this->jurnal->validate()){
            $this->load->view('template',compact('content','title','action','data','id','titleTag'));
            return;
        }
        
        $this->jurnal->updateJurnal($id,$data);
        $this->session->set_flashdata('berhasil','Data Jurnal Berhasil Di Ubah');
        redirect('jurnal_umum');    
    }

    public function deleteJurnal()
    {
        $id = $this->input->post('id',true);
        $this->jurnal->deleteJurnal($id);
        $this->session->set_flashdata('berhasilHapus','Data Jurnal berhasil di hapus');
        redirect('jurnal_umum');
    }

    public function bukuBesar()
    {
        $titleTag = 'Buku Besar';
        $content = 'user/buku_besar_main';
        $listJurnal = $this->jurnal->getJurnalByYearAndMonth();
        $tahun = $this->jurnal->getJurnalByYear();
        $this->load->view('template',compact('content','listJurnal','titleTag','tahun'));
    }

    public function bukuBesarDetail()
    {
        
        $content = 'user/buku_besar';
        $titleTag = 'Buku Besar';
        $bulan = $this->input->post('bulan',true);
        $tahun = $this->input->post('tahun',true);

        if(empty($bulan) ||empty($tahun)){
            redirect('buku_besar');
        }
        
        $dataAkun = $this->akun->getAkunByMonthYear($bulan,$tahun);
        $data = null;
        $saldo = null;

        foreach($dataAkun as $row){
            $data[] = (array) $this->jurnal->getJurnalByNoReffMonthYear($row->no_reff,$bulan,$tahun);
            $saldo[] = (array) $this->jurnal->getJurnalByNoReffSaldoMonthYear($row->no_reff,$bulan,$tahun);
        }

        if($data == null || $saldo == null){
            $this->session->set_flashdata('dataNull','Data Buku Besar Dengan Bulan '.bulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
            redirect('buku_besar');
        }

        $jumlah = count($data);

        $this->load->view('template',compact('content','titleTag','dataAkun','data','jumlah','saldo'));
    }

    public function neracaSaldo()
    {
        $titleTag = 'Neraca Saldo';
        $content = 'user/neraca_saldo_main';
        $listJurnal = $this->jurnal->getJurnalByYearAndMonth();
        $tahun = $this->jurnal->getJurnalByYear();
        $this->load->view('template',compact('content','listJurnal','titleTag','tahun'));
    }
    public function neracaSaldoDetail(){
        $content = 'user/neraca_saldo';
        $titleTag = 'Neraca Saldo';
        $bulan = $this->input->post('bulan',true);
        $tahun = $this->input->post('tahun',true);

        if(empty($bulan) || empty($tahun)){
            redirect('neraca_saldo');
        }

        $dataAkun = $this->akun->getAkunByMonthYear($bulan,$tahun);
        $data = null;
        $saldo = null;
        
        foreach($dataAkun as $row){
            $data[] = (array) $this->jurnal->getJurnalByNoReffMonthYear($row->no_reff,$bulan,$tahun);
            $saldo[] = (array) $this->jurnal->getJurnalByNoReffSaldoMonthYear($row->no_reff,$bulan,$tahun);
        }
        if($data == null || $saldo == null){
            $this->session->set_flashdata('dataNull','Neraca Saldo Dengan Bulan '.bulan($bulan).' Pada Tahun '.date('Y',strtotime($tahun)).' Tidak Di Temukan');
            redirect('neraca_saldo');
        }
        $jumlah = count($data);
        $this->load->view('template',compact('content','titleTag','dataAkun','data','jumlah','saldo'));
    }

    public function logout(){
        $this->user->logout();
        redirect('');
    }

    // public function get_subkategori()
    // {
       
    //     $id_kategori = $this->input->post('id_kategori');
    //     // echo $id_kategori;
    //     $subkategori = $this->akun->getSubKategoriByNoReff($id_kategori);
    //     header('Content-Type: application/json');
    //     echo json_encode($subkategori);
    // }

    public function get_subkategori()
{
    $id_kategori = $this->input->post('id_kategori');
    $subkategori = $this->akun->getSubKategoriByNoReff($id_kategori);

    // Konversi manual (tidak fleksibel tapi bisa jalan sementara)
    header('Content-Type: application/json');
    echo '[';
    $first = true;
    foreach ($subkategori as $row) {
        if (!$first) echo ',';
        echo '{';
        $i = 0;
        foreach ($row as $key => $value) {
            if ($i++) echo ',';
            echo '"' . $key . '":"' . addslashes($value) . '"';
        }
        echo '}';
        $first = false;
    }
    echo ']';
}

    public function LaporanLaba(){
        $content = 'laporan/laporan_laba';
        $titleTag = 'Data Akun';
        $dataAkun = $this->akun->getAkun();
        $this->load->view('template',compact('content','dataAkun','titleTag'));
    }
    
}
