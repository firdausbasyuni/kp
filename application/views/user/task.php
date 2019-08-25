<?php $this->load->view('usertemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px;">
  <?php $this->load->view('usertemplate/navbar') ?>
  <div style="margin-left:40px; margin-top:40px;">
    <div class="row" style="padding-top: 12px;  margin-right:4px; margin-left:4px;">
      <div class="col" style="padding-top:16px;">
        <h1>Task</h1>
        <table class="table table-hover" style="text-align:center;">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Site</th>
              <th scope="col">Nama Project</th>
              <th scope="col">Nama Operator</th>
              <th scope="col">Jenis Task</th>
              <th scope="col">Tgl Mulai</th>
              <th scope="col">Tgl Selesai</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Status</th>
              <th scope="col" colspan="2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if ($ustask) {
              foreach ($ustask as $s) { ?>
                <tr>
                  <td><?php echo $no++ ?></td>
                  <td><?php echo $s->description ?></td>
                  <td><?php echo $s->nama_project ?></td>
                  <td><?php echo $s->nama ?></td>
                  <td><?php echo $s->jenis_task ?></td>
                  <td><?php echo $s->tgl_masuk ?></td>
                  <td><?php echo $s->tgl_selesai ?></td>
                  <td><?php echo $s->keterangan ?></td>
                  <td><?php echo $s->keadaan ?></td>
                  <td><a class="btn btn-xs btn-info" data-toggle="modal" data-target="#modal_info<?php echo $s->id_task; ?>"> Info</a></td>
                <?php
                }
              }
              ?>

            </tr>
          </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#downloadform">
          Download Form
        </button>
        <div class="modal fade" id="downloadform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Download Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php
                echo '<a href="' . site_url('UserController/lakukan_download_form1/') . '"class="btn  btn-primary fa fa-trash-o">Download Form 1</a><br><br>';
                echo '<a href="' . site_url('UserController/lakukan_download_form2/') . '"class="btn  btn-primary fa fa-trash-o">Download Form 2</a><br><br>';
                echo '<a href="' . site_url('UserController/lakukan_download_form3/') . '"class="btn  btn-primary fa fa-trash-o">Download Form 3</a>';
                ?>
              </div>
            </div>
          </div>
        </div>

        <?php foreach ($ustask as $dt) : ?>
          <div class="modal fade" id="modal_info<?= $dt->id_task; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php echo form_open_multipart('UserController/upload') ?>
                  <label for="">Upload</label>
                  <input type="hidden" name="id_task" value="<?php echo $dt->id_task ?>">
                  <input type="text" name="jenis_task" value="<?php echo $dt->jenis_task ?>" readonly>
                  <input type="file" name="namafile"><? echo $error ?>
                  <br>
                  <input type="submit" value="upload">
                  <?php echo form_close() ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

      </div>

    </div>
</body>