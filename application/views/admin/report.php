<?php $this->load->view('admintemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px;">
      <?php $this->load->view('admintemplate/navbar') ?>
      <div style="margin-left:40px; margin-top:40px;">
            <div class="row" style="padding-top: 12px;  margin-right:4px; margin-left:4px;">
                  <div class="col" style="padding-top:16px;">

                        <h1>Report</h1>
                        <table class="table table-hover" id="mydata" style="text-align:center">
                              <thead>
                                    <tr>
                                          <th scope="col">No</th>
                                          <th scope="col">Nama Site</th>
                                          <th scope="col">Tanggal</th>
                                          <th scope="col">Deskripsi</th>
                                          <th scope="col">Aksi</th>
                                    </tr>

                              </thead>

                              <tbody>
                                    <?php
                                    $no = 1;
                                    if ($data) {
                                          foreach ($data as $d) { ?>
                                                <th scope="col"><?php echo $no++ ?></td>
                                                <td><?php echo $d->nama ?></td>
                                                <td><?php echo $d->tanggal ?></td>
                                                <td><?php echo $d->discription ?></td>
                                                <td>
                                                      <a class="btn btn-xs btn-primary text-white" data-toggle="modal" data-target="#modal_balas<?php echo $d->id_kel; ?>">Tanggapi</a>
                                                      <a class="btn btn-xs btn-danger text-white" data-toggle="modal" data-target="#modal_delete<?php echo $d->id_kel; ?>">Hapus</a>
                                                </td>
                                                </tr>
                                          <?php
                                          }
                                    }
                                    ?>
                              </tbody>

                        </table>
                  </div>
            </div>
            <?php foreach ($data as $d) : ?>
                  <div class="modal fade" id="modal_balas<?php echo $d->id_kel ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                    <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Kirim Tanggapan</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                                    <div class="modal-body">
                                          <form action="balasreport" method="post">
                                                <input type="hidden" name="id" value="<?php echo $d->id_kel ?>">
                                                <textarea type="text" class="form-control" name="balas"></textarea>
                                                <input type="submit" class="btn btn-primary" value="Kirim" style="margin-top:8px;">
                                          </form>
                                    </div>
                              </div>
                        </div>
                  </div>
            <?php endforeach ?>
            <?php foreach ($data as $d) : ?>
                  <div class="modal fade" id="modal_delete<?= $d->id_kel; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                              <div class="modal-content">
                                    <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Hapus Task</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                          </button>
                                    </div>
                                    <div class="modal-body">
                                          <h2>Apakah anda yakin akan menghapus report ini?</h2>
                                          <?php echo '<a href="' . site_url('AdminController/deldatakel/') . $d->id_kel . '"class="btn  btn-primary fa fa-trash-o">Ya</a>' ?>
                                    </div>
                              </div>
                        </div>
                  </div>
            <?php endforeach; ?>
</body>