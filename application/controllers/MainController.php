<?php

class Maincontroller extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('MainModel');

    if ($this->session->userdata('logged_in') != 1) {
      redirect(site_url('LoginController/index'));
    }
  }

  public function index()
  {
    $this->load->view('dashboard');
  }

  public function report()
  {
    $data['data'] = $this->MainModel->show_keluhan();
    $this->load->view('report', $data);
  }

  public function transaction()
  {
    $data['data'] = $this->MainModel->show_keuangan();
    $data['user'] = $this->MainModel->getuser();
    $this->load->view('transaction', $data);
  }

  public function inventory()
  {
    $data['jml'] = $this->MainModel->getInv();
    $this->load->view('inventory', $data);
  }

  public function task()
  {
    $data['stask'] = $this->MainModel->showtask();
    $data['site'] = $this->MainModel->getsite();
    $data['operator'] = $this->MainModel->getopt();
    $this->load->view('header');
    $this->load->view('task', $data);
  }

  public function create()
  {
    $data = array(
      'jenis_task' => $this->input->post('jenis_task'),
      'id_site' => $this->input->post('pilih_site'),
      'tgl_masuk' => $this->input->post('tgl_masuk'),
      'tgl_selesai' => $this->input->post('tgl_selesai'),
      'nama_project' => $this->input->post('nama_project'),
      'id_operator' => $this->input->post('operator'),
      'keterangan' => $this->input->post('keterangan'),
      'keadaan'   => 'Belum Selesai'
    );
    $this->MainModel->createData($data, 'tbl_perintah');
    redirect("MainController/task");
  }

  public function deltask($id)
  {
    $this->MainModel->deletetask($id);
    redirect("MainController/task");
  }

  public function pilihsite()
  {
    $data = array(
      'id_site' => $this->input->post('pilih_site')
    );
    $this->MainModel->getopt($data);
  }

  public function delete($id)
  {
    $this->MainModel->deleteData($id);
    redirect(site_url('MainController/task'));
  }
  public function detailtask()
  {
    $id = $this->input->post('id_task');
    $update = array(
      'jenis_task' => $this->input->post('jenis_task'),
      //'id_site' => $this->input->post('pilih_site'),
      'tgl_masuk' => $this->input->post('tgl_masuk'),
      'tgl_selesai' => $this->input->post('tgl_selesai'),
      'nama_project' => $this->input->post('nama_project'),
      //'id_operator' => $this->input->post('operator'),
      'keterangan' => $this->input->post('keterangan'),
      'keadaan'   => $this->input->post('keadaan')
    );
    $this->MainModel->detailtask($id, $update);
    redirect("MainController/task");
  }

  public function getJTask()
  {
    $data['task'] = $this->MainModel->getJTask();
  }

  public function tambah()
  {
    $jenis = $this->input->post('name');
    $brand = $this->input->post('brand');
    $jumlah = $this->input->post('jumlah');
    $data = array(
      'name' => $jenis,
      'brand' => $brand
    );
    for ($i = 0; $i < $jumlah; $i++) {
      $this->MainModel->add($data, 'inventory');
    }
    redirect('MainController/inventory');
  }

  public function delDatakel($id)
  {
    $this->MainModel->deletekel($id);
    redirect('MainController/report');
  }

  public function insert_trans()
  {
    $nama_site = $this->input->post('nama_site');
    $tgl_masuk = $this->input->post('tgl_masuk');
    $biaya = $this->input->post('biaya');
    $keterangan = $this->input->post('keterangan');
    $data = array(
      'nama_site' => $nama_site,
      'tanggal' => $tgl_masuk,
      'biaya_tr' => $biaya,
      'ket_tr' => $keterangan
    );
    $this->MainModel->input_keuangan($data, 'keuangan');
    redirect('MainController/transaction');
  }

  public function delDatauang($id)
  {
    $this->MainModel->deleteuang($id);
    redirect('MainController/transaction');
  }
}
