<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller{
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

public function penjualan()
{
    $bulan = $this->input->post('periode_bulan');
    $bidang = $this->input->post('akun_bidang');

    $data['content'] = 'laporan/laporan_laba';
    $data['titleTag'] = 'Data Akun';

    $data['laporan'] = $this->jurnal->getJurnalJoinAkunDetailAllbyMonth($bulan, $bidang);
    // echo "<pre />";
    // print_r($data['laporan']);
    // exit();
    $data['bulan'] = $bulan;
    $data['bidang'] = $bidang;

    $this->load->view('template', $data);
}


    
}
