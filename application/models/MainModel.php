<?php

class MainModel extends CI_Model
{

  public function get_data($table)
  {
    $hasil = $this->db->get($table);
    return $hasil->result_array();
  }
  public function is_loggin()
  {
    return $this->session->userdata('id_user');
  }

  public function input_data($table, $data)
  {
    $insert = $this->db->insert($table, $data);
    if ($insert) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  public function getInv()
  {
    $this->db->select('name, brand, count(*) as total');
    $this->db->group_by(array('name', 'brand'));
    $this->db->having('total > 1', null, false);
    $query = $this->db->get('inventory');
    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }
  public function add($data, $table)
  {
    $this->db->insert($table, $data);
  }


  function getAllData()
  {
    $query = $this->db->query('SELECT * FROM detailtask');
    return $query->result();
  }

  function deleteData($id)
  {
    $this->db->where("id", $id);
    $this->db->delete('detailtask');
  }

  public function getJTask()
  {
    $this->db->select('jenis_task');
    $query = $this->db->get('task');

    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }
  public function show_keluhanu($id)
  {

    $hasil = $this->db->query("SELECT id_kel,user_login.nama as namaopt,sites.description as nama,tanggal,discription,balas FROM keluhan JOIN user_login ON user_login.id_user = keluhan.id_site  JOIN sites ON sites.id_user = user_login.id_user WHERE sites.id_user=$id");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  public function show_keluhan()
  {

    $hasil = $this->db->query("SELECT id_kel,sites.description as nama,tanggal,discription FROM keluhan JOIN user_login ON user_login.id_user = keluhan.id_site  JOIN sites ON sites.id_user = user_login.id_user");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  public function show_keluhanuser($id)
  {

    $hasil = $this->db->query("SELECT id_kel,sites.description as nama,tanggal,discription FROM keluhan JOIN user_login ON user_login.id_user = keluhan.id_site  JOIN sites ON sites.id_user = user_login.id_user WHERE id_site = '$id'");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  public function deletekel($id)
  {
    $this->db->where('id_kel', $id);
    $this->db->delete('keluhan');
    return;
  }
  function show_keuangan()
  {

    $hasil = $this->db->query("SELECT id_uang,nama,tanggal,biaya_tr,ket_tr,nama_trans FROM keuangan JOIN user_login ON user_login.id_user = keuangan.nama_site");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  function show_keuanganu($id)
  {

    $hasil = $this->db->query("SELECT id_uang,nama,tanggal,biaya_tr,ket_tr,nama_trans FROM keuangan JOIN user_login ON user_login.id_user = keuangan.nama_site WHERE id_user=$id");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  function getuser()
  {
    $query = $this->db->get('user_login');
    return $query->result();
  }
  public function input_keuangan($data, $table)
  {
    $this->db->insert($table, $data);
  }
  public function deleteuang($id_uang)
  {
    $this->db->where('id_uang', $id_uang);
    $this->db->delete('keuangan');
    return;
  }

  public function showtask()
  {
    $hasil = $this->db->query("SELECT tbl_perintah.id_task,sites.description,tbl_perintah.jenis_task,tgl_masuk,tgl_selesai,nama_project,user_login.id_user,user_login.nama,keterangan,keadaan,user_info,apro_manager,apro_gm FROM tbl_perintah INNER JOIN sites ON sites.id = tbl_perintah.id_site INNER JOIN user_login ON user_login.id_operator=sites.id WHERE user_login.level = 2 GROUP BY id_task");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  public function showtaskmanager()
  {
    $hasil = $this->db->query("SELECT tbl_perintah.id_task,sites.description,tbl_perintah.jenis_task,tgl_masuk,tgl_selesai,nama_project,user_login.id_user,user_login.nama,keterangan,keadaan,user_info,apro_manager,apro_gm,file_pdf.id,file_pdf.nama_file as nama_file FROM tbl_perintah INNER JOIN sites ON sites.id = tbl_perintah.id_site INNER JOIN user_login ON user_login.id_operator=sites.id INNER JOIN file_pdf ON file_pdf.id_task=tbl_perintah.id_task WHERE user_info = TRUE AND apro_manager = FALSE AND apro_gm = FALSE GROUP BY id_task");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  public function showtaskgm()
  {
    $hasil = $this->db->query("SELECT tbl_perintah.id_task,sites.description,tbl_perintah.jenis_task,tgl_masuk,tgl_selesai,nama_project,user_login.id_user,user_login.nama,keterangan,keadaan,user_info,apro_manager,apro_gm,file_pdf.id,file_pdf.nama_file as nama_file FROM tbl_perintah INNER JOIN sites ON sites.id = tbl_perintah.id_site INNER JOIN user_login ON user_login.id_operator=sites.id INNER JOIN file_pdf ON file_pdf.id_task=tbl_perintah.id_task WHERE user_info = TRUE AND apro_manager = TRUE AND apro_gm = FALSE GROUP BY id_task");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  public function getaskuser($user)
  {
    $code = $this->db->query("SELECT site_code FROM user_login WHERE id_user ='$user'");
    return $code;
  }
  public function showtaskuser($id)
  {
    $hasil = $this->db->query("SELECT id_task,sites.description,user_login.nama,jenis_task,tgl_masuk,tgl_selesai,nama_project,keterangan,keadaan,user_info FROM tbl_perintah INNER JOIN sites ON sites.id = tbl_perintah.id_site INNER JOIN user_login ON user_login.id_operator=sites.id WHERE user_login.id_user = '$id' GROUP BY id_task");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  function getsiteuser()
  {
    $hasil = $this->db->query("SELECT id,site_code,description FROM sites");
    if ($hasil->num_rows() > 0) {
      return $hasil->result();
    }
  }
  function getsite()
  {
    $query = $this->db->get('sites');
    return $query->result();
  }
  function getopt()
  {

    $query = $this->db->query("SELECT id_user,nama, id_operator FROM user_login WHERE level=2");
    return $query->result();
  }
  function getoptuser($id)
  {

    $this->db->where('id_user', $id);
    $hasil = $this->db->get('user_login');
    return $hasil->result();
  }
  function createData($data, $table)
  {
    $this->db->insert($table, $data);
  }
  public function deletetask($id)
  {
    $this->db->where('id_task', $id);
    $this->db->delete('tbl_perintah');
    return;
  }
  function detailtask($id, $update)
  {
    $this->db->where('id_task', $id);
    $this->db->update('tbl_perintah', $update);
  }
  function gettaskongoing()
  {
    $query = $this->db->query("SELECT COUNT(*) as totalongoing FROM tbl_perintah WHERE user_info=FALSE AND apro_manager = FALSE AND apro_gm = FALSE");
    return $query->result();
  }
  function gettasksubmit()
  {
    $query = $this->db->query("SELECT COUNT(*) as totalsubmit FROM tbl_perintah WHERE user_info=TRUE AND apro_manager = FALSE AND apro_gm = FALSE");
    return $query->result();
  }
  function gettaskapromanager()
  {
    $query = $this->db->query("SELECT COUNT(*) as totalapromanager FROM tbl_perintah WHERE user_info=TRUE AND apro_manager = TRUE AND apro_gm = FALSE;");
    return $query->result();
  }
  function gettaskaprogm()
  {
    $query = $this->db->query("SELECT COUNT(*) as totalaprogm FROM tbl_perintah WHERE user_info=TRUE AND apro_manager = TRUE AND apro_gm = TRUE;");
    return $query->result();
  }
  function tglm14u()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('-14 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('-8 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE keadaan='On Going' AND tgl_selesai >= '$date2'");
    return $hasil->result();
  }
  function tglm14m()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('-14 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('-8 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = false AND apro_gm = false AND tgl_selesai >= '$date2'");
    return $hasil->result();
  }
  function tglm14g()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('-14 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('-8 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = true AND apro_gm = false AND tgl_selesai >= '$date2'");
    return $hasil->result();
  }
  function tglm7u()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('-7 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('-1 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = false AND apro_manager = false AND apro_gm = false AND tgl_selesai BETWEEN '$date' AND '$date2'");
    return $hasil->result();
  }
  function tglm7m()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('-7 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('-1 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = false AND apro_gm = false AND tgl_selesai BETWEEN '$date' AND '$date2'");
    return $hasil->result();
  }
  function tglm7g()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('-7 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('-1 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = true AND apro_gm = false AND tgl_selesai BETWEEN '$date' AND '$date2'");
    return $hasil->result();
  }
  function tgl7u()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('+6 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = false AND apro_manager = false AND apro_gm = false AND tgl_selesai BETWEEN '$today' AND '$date'");
    return $hasil->result();
  }
  function tgl7m()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('+6 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = false AND apro_gm = false AND tgl_selesai BETWEEN '$today' AND '$date'");
    return $hasil->result();
  }
  function tgl7g()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('+6 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = true AND apro_gm = false AND tgl_selesai BETWEEN '$today' AND '$date'");
    return $hasil->result();
  }
  function tgl14u()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('+6 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('+13 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = false AND apro_manager = false AND apro_gm = false AND tgl_selesai BETWEEN '$date' AND '$date2'");
    return $hasil->result();
  }
  function tgl14m()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('+6 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('+13 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = false AND apro_gm = false AND tgl_selesai BETWEEN '$date' AND '$date2'");
    return $hasil->result();
  }
  function tgl14g()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('+6 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('+13 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = true AND apro_gm = false AND tgl_selesai BETWEEN '$date' AND '$date2'");
    return $hasil->result();
  }
  function tgl20u()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('+14 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('+20 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = false AND apro_manager = false AND apro_gm = false AND tgl_selesai BETWEEN '$date' AND '$date2'");
    return $hasil->result();
  }
  function tgl20m()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('+14 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('+20 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = false AND apro_gm = false AND tgl_selesai BETWEEN '$date' AND '$date2'");
    return $hasil->result();
  }
  function tgl20g()
  {
    $today = date("Y/m/d");
    $date = date('Y/m/d', strtotime('+14 days', strtotime($today)));
    $date2 = date('Y/m/d', strtotime('+20 days', strtotime($today)));
    //$date = date("Y/m/d+7");
    $hasil = $this->db->query("SELECT COUNT(*) as total FROM tbl_perintah WHERE user_info = true AND apro_manager = true AND apro_gm = false AND tgl_selesai BETWEEN '$date' AND '$date2'");
    return $hasil->result();
  }
  public function getemail($id)
  {
    $result = $this->db->query("SELECT email FROM user_login WHERE id_user = $id");
    if ($result->num_rows() > 0) {
      $rs = $result->row(0);
      return $rs->email;
    } else {
      $rs = 0;
      return $rs;
    }
  }
}
