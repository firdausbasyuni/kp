<?php $this->load->view('usertemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px;">
  <?php $this->load->view('usertemplate/navbar') ?>
  <div style="margin-left:40px; margin-top:40px;">
    <div class="row" style="padding-top: 12px;  margin-right:4px; margin-left:4px;">
      <div class="col" style="padding-top:16px;">
        <h1>Transaction</h1>
        <table style="text-align: center;" class="table table-hover" id="mydata">
          <thead>
            <tr>
              <td>No</td>
              <td>Nama Site</td>
              <td>Tanggal</td>
              <td>Biaya Pengeluaran</td>
              <td>Deskripsi</td>
              <td>Upload</td>
              <td>Action</td>
            </tr>

          </thead>

          <tbody>
            <?php
            $no = 1;
            if ($data) {
              foreach ($data as $d) { ?>

                <td><?php echo $no++ ?></td>
                <td><?php echo $d->nama ?></td>
                <td><?php echo $d->tanggal ?></td>
                <td><?php echo $d->biaya_tr ?></td>
                <td><?php echo $d->ket_tr ?></td>
                <td><?php echo '<a href="' . site_url('UserController/lakukan_download_gambar/') . $d->nama_trans . '"class="btn  btn-primary fa fa-trash-o">Download</a>';
                    ?></td>
                <td><a href="<?php echo base_url('UserController/delDatauang'); ?>/<?php echo $d->id_uang; ?>
                                                                                                                                                                                                                                                                                                                                                    " class="btn  btn-warning fa fa-trash-o" onClick="return confirm('Serius?..')">
                    Delete</a></td>
                </tr>
              <?php
              }
            }
            ?>
          </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Input
        </button>
      </div>


      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Input</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php echo form_open_multipart('UserController/uploadtrans') ?>
              <input type="hidden" name="nama_user" value="<?php echo $this->session->userdata('id_user'); ?>">
              <div class="form-group">
                <label class="control-label col-sm-3">
                  Tanggal
                </label>
                <div class="col-sm-9">
                  <input class="form-control" type="date" class="input-tanggal" name="tgl_masuk">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">
                  Biaya
                </label>
                <div class="col-sm-9">
                  <input type="number" name="biaya" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">
                  Deskripsi
                </label>
                <div class="col-sm-9">
                  <input type="text" name="keterangan" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3">
                  Upload :
                </label>
                <input type="file" name="namafile"><? echo $error ?>
                <div class="col-sm-9">
                  <input class="btn btn-primary" type="submit" value="Input">
                </div>
              </div>
              <?php echo form_close() ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>