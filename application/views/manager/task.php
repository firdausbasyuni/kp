<?php $this->load->view('managertemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px;">
  <?php $this->load->view('managertemplate/navbar') ?>
  <div style="margin-left:40px; margin-top:40px;">
    <div class="row" style="padding-top: 12px;  margin-right:4px; margin-left:4px;">
      <div class="col" style="padding-top:16px;">
        <h1>Task</h1>

        <table class="table table-hover" style="text-align:center;">
          <thead class="">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Site</th>
              <th scope="col">Nama Project</th>
              <th scope="col">Nama Operator</th>
              <th scope="col">Jenis Task</th>
              <th scope="col">Tanggal Mulai</th>
              <th scope="col">Tanggal Selesai</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Status</th>
              <th scope="col" colspan="2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if ($stask) {
              foreach ($stask as $s) { ?>
                <tr>
                  <th><?php echo $no++ ?></th>
                  <td><?php echo $s->description ?></td>
                  <td><?php echo $s->nama_project ?></td>
                  <td><?php echo $s->nama ?></td>
                  <td><?php echo $s->jenis_task ?></td>
                  <td><?php echo $s->tgl_masuk ?></td>
                  <td><?php echo $s->tgl_selesai ?></td>
                  <td><?php echo $s->keterangan ?></td>
                  <td><?php echo $s->keadaan ?></td>
                  <td><a class="btn btn-xs btn-info text-white" data-toggle="modal" data-target="#modal_info<?php echo $s->id_task; ?>">Aprove</a></td>
                  <td>
                    <?php if ($s->user_info == TRUE) {
                      echo '<a href="' . site_url('managerController/lakukan_download/') . $s->nama_file . '"class="btn  btn-primary fa fa-trash-o">Download laporan</a>';
                    } else {
                      echo "Belum ada Laporan masuk";
                    } ?></td>
                <?php
                }
              }
              ?>

            </tr>
          </tbody>
        </table>

        <?php foreach ($stask as $dt) : ?>
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
                  <form method="post" action="<?php echo site_url('managerController/detailtask') ?>">
                    <div class="form-group">
                      <input type="hidden" name="id_task" value="<?php echo $dt->id_task; ?>">

                      <?php if ($dt->user_info == true) {
                        $lap =  'Laporan dari user jika task selesai dikerjakan';
                      } else {
                        $lap = 'Belum ada laporan dari user';
                      } ?>
                      <label for="1">Laporan : <?php echo $lap ?></label>

                    </div>
                    <div class="form-group">
                      <input type="submit" name="keadaan" class="btn btn-primary" value="Selesai">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>