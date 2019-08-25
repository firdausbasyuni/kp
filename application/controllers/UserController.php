<?php

class UserController extends CI_Controller
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
        $data['page'] = 'index';
        $this->load->view('user/user', $data);
    }

    public function report()
    {
        $data['page'] = 'report';
        $id = $this->session->userdata('id_user');
        $data['data'] = $this->MainModel->show_keluhanu($id);
        $data['user'] = $this->MainModel->getsiteuser();
        $this->load->view('user/report', $data);
    }

    public function transaction()
    {
        $id = $this->session->userdata('id_user');
        $data['page'] = 'transaction';
        $data['data'] = $this->MainModel->show_keuanganu($id);
        $data['user'] = $this->MainModel->getuser();
        $this->load->view('user/transaction', $data);
    }

    public function inventory()
    {
        $data['page'] = 'inventory';
        $data['jml'] = $this->MainModel->getInv();
        $this->load->view('user/inventory', $data);
    }

    public function task()
    {
        $data['page'] = 'task';
        $id = $this->session->userdata('id_user');
        $data['ustask'] = $this->MainModel->showtaskuser($id);
        $data['site'] = $this->MainModel->getsite();
        $data['operator'] = $this->MainModel->getoptuser($id);
        $this->load->view('usertemplate/header');
        $this->load->view('user/task', $data);
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
        redirect("UserController/task");
    }

    public function deltask($id)
    {
        $this->MainModel->deletetask($id);
        redirect("UserController/task");
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
        redirect(site_url('UserController/task'));
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
            'keadaan'   => "Menunggu Aproval Manager",
            'user_info' => TRUE
        );
        $this->MainModel->detailtask($id, $update);
        redirect("UserController/task");
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
        redirect('UserController/inventory');
    }

    public function delDatakel($id)
    {
        $this->MainModel->deletekel($id);
        redirect('UserController/report');
    }

    public function insert_trans()
    {

        redirect('UserController/transaction');
    }
    public function insert_report()
    {
        $id_site = $this->input->post('nama_user');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $keterangan = $this->input->post('keterangan');
        $data = array(
            'id_site' => $id_site,
            'tanggal' => $tgl_masuk,
            'discription' => $keterangan
        );
        $this->MainModel->input_data('keluhan', $data);
        redirect('UserController/report');
    }

    public function delDatauang($id)
    {
        $this->MainModel->deleteuang($id);
        redirect('UserController/transaction');
    }

    public function upload()
    {
        $config['upload_path']          = './files/';
        $config['allowed_types']        = 'doc|docx|pdf';
        $config['max_size']             = 100000;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('namafile')) {
            $id = $this->session->userdata('id_user');
            $idtask = $this->input->post('id_task');
            $upload_file = $this->upload->data();
            $data = array(
                'nama_file' => $upload_file['file_name'],
                'id_site' => $id,
                'id_task' => $this->input->post('id_task'),
                'jenis_task' => $this->input->post('jenis_task')
            );
            $info = array(
                'nama_file' => $upload_file['file_name'],
                'user_info' => TRUE,
                'keadaan' => 'Menunggu Aproval dari Manager'

            );
            $this->MainModel->input_data('file_pdf', $data);
            $this->MainModel->detailtask($idtask, $info);
            redirect("UserController/task");
        }
    }
    public function uploadtrans()
    {
        $config['upload_path']          = './trans/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 20000;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('namafile')) {
            $upload_file = $this->upload->data();
            $data = array(
                'nama_trans' => $upload_file['file_name'],
                'nama_site' => $this->input->post('nama_user'),
                'tanggal' => $this->input->post('tgl_masuk'),
                'biaya_tr' => $this->input->post('biaya'),
                'ket_tr' => $this->input->post('keterangan')
            );
            $this->MainModel->input_data('keuangan', $data);
            redirect("UserController/transaction");
        } else {
            redirect("UserController/transaction");
        }
    }
    public function lakukan_download_gambar($name)
    {
        force_download("./trans/$name", NULL);
    }
    public function lakukan_download_form1()
    {
        force_download("./form/FORM 1 - CHECK LIST PREVENTIVE MAINTENANCE MECHANICAL ELECTRICAL & EXTERNAL ALARM SYSTEM.pdf", NULL);
    }
    public function lakukan_download_form2()
    {
        force_download("./form/FORM 2 - CHECK LIST PREVENTIVE MAINTENANCE TRANSMISI.pdf", NULL);
    }
    public function lakukan_download_form3()
    {
        force_download("./form/FORM 3 - CHECK LIST PREVENTIVE MAINTENANCE MECHANICAL ELECTRICAL & EXTERNAL ALARM SYSTEM.pdf", NULL);
    }
}
