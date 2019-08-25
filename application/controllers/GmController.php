<?php

class GmController extends CI_Controller
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
        $today = date("Y/m/d");
        $datem14 = date('Y/m/d', strtotime('-14 days', strtotime($today)));
        $datem8 = date('Y/m/d', strtotime('-8 days', strtotime($today)));
        $datem7 = date('Y/m/d', strtotime('-7 days', strtotime($today)));
        $datem1 = date('Y/m/d', strtotime('-1 days', strtotime($today)));
        $date6 = date('Y/m/d', strtotime('+6 days', strtotime($today)));
        $date7 = date('Y/m/d', strtotime('+7 days', strtotime($today)));
        $date13 = date('Y/m/d', strtotime('+13 days', strtotime($today)));
        $date14 = date('Y/m/d', strtotime('+14 days', strtotime($today)));
        $date20 = date('Y/m/d', strtotime('+20 days', strtotime($today)));
        $date21 = date('Y/m/d', strtotime('+21 days', strtotime($today)));
        $date28 = date('Y/m/d', strtotime('+28 days', strtotime($today)));
        $data = array(
            'data1' => $this->MainModel->tglm14u(),
            'data2' => $this->MainModel->tglm14m(),
            'data3' => $this->MainModel->tglm14g(),
            'data4' => $this->MainModel->tglm7u(),
            'data5' => $this->MainModel->tglm7m(),
            'data6' => $this->MainModel->tglm7g(),
            'data7' => $this->MainModel->tgl7u(),
            'data8' => $this->MainModel->tgl7m(),
            'data9' => $this->MainModel->tgl7g(),
            'data10' => $this->MainModel->tgl14u(),
            'data11' => $this->MainModel->tgl14m(),
            'data12' => $this->MainModel->tgl14g(),
            'data13' => $this->MainModel->tgl20u(),
            'data14' => $this->MainModel->tgl20m(),
            'data15' => $this->MainModel->tgl20g(),
            'today' => $today,
            'tglm14' => $datem14,
            'tglm8' => $datem8,
            'tglm7' => $datem7,
            'tglm1' => $datem1,
            'tgl6' => $date6,
            'tgl7' => $date7,
            'tgl13' => $date13,
            'tgl14' => $date14,
            'tgl20' => $date20,
            'tgl21' => $date21,
            'tgl28' => $date28
        );
        $data['page'] = 'index';
        $this->load->view('gm/dashboard', $data);
    }

    public function report()
    {
        $data['page'] = 'report';
        $data['data'] = $this->MainModel->show_keluhan();
        $this->load->view('gm/report', $data);
    }

    public function transaction()
    {
        $data['page'] = 'transaction';
        $data['data'] = $this->MainModel->show_keuangan();
        $data['user'] = $this->MainModel->getuser();
        $this->load->view('gm/transaction', $data);
    }

    public function inventory()
    {
        $data['page'] = 'inventory';
        $data['jml'] = $this->MainModel->getInv();
        $this->load->view('gm/inventory', $data);
    }

    public function task()
    {
        $data['page'] = 'task';
        $data['stask'] = $this->MainModel->showtaskgm();
        $data['site'] = $this->MainModel->getsite();
        $data['operator'] = $this->MainModel->getopt();
        $this->load->view('gmtemplate/header');
        $this->load->view('gm/task', $data);
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
        redirect("GmController/task");
    }

    public function deltask($id)
    {
        $this->MainModel->deletetask($id);
        redirect("GmController/task");
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
        redirect(site_url('GmController/task'));
    }
    public function detailtask()
    {
        $id = $this->input->post('id_task');
        $update = array(
            'keadaan'   => "Selesai",
            'apro_gm' => TRUE
        );
        $this->MainModel->detailtask($id, $update);
        redirect("GmController/task");
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
        redirect('GmController/inventory');
    }

    public function delDatakel($id)
    {
        $this->MainModel->deletekel($id);
        redirect('GmController/report');
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
        redirect('GmController/transaction');
    }

    public function delDatauang($id)
    {
        $this->MainModel->deleteuang($id);
        redirect('GmController/transaction');
    }
    public function lakukan_download($name)
    {
        force_download("./files/$name", NULL);
    }
}
