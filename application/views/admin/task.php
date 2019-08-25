<?php $this->load->view('admintemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px;">
  <?php $this->load->view('admintemplate/navbar') ?>
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
              <th scope="col">Aksi</th>
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
                  <td><a class="btn btn-xs btn-danger text-white" data-toggle="modal" data-target="#modal_delete<?php echo $s->id_task; ?>"> Delete</a></td>
                <?php
                }
              }
              ?>
            </tr>
          </tbody>
        </table>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="margin-bottom:12px">
          Input Task
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" id="inputtask" action="<?php echo site_url('AdminController/create') ?>">
                  <div>
                    <label for="exampleInputEmail">Jenis Task : </label>
                    <select name="jenis_task" class="form-control">
                      <option disabled selected>-- Select Task --</option>
                      <option>Refuelling BBM</option>
                      <option>Preventive Maintenance Mechanical & External Alarm System</option>
                      <option>Preventive Maintenance Transmisi</option>
                    </select>
                  </div>
                  <br>
                  <div class="form-group" style="">
                    <label for="text">Nama Site : </label>
                    <select name="pilih_site" id="pilih_site" class="form-control" required>
                      <option disabled selected>-- Select Task --</option>
                      <?php
                      foreach ($site as $st) {
                        echo "<option value='" . $st->id . "'>" . $st->description . "</option>";
                      }
                      echo "
		                    </select>"
                      ?>
                    </select> </div>
                  <div class="form-group">
                    <label for="">Tgl Mulai : </label>
                    <input type="date" class="form-control" name="tgl_masuk" placeholder="Tgl Mulai">
                  </div>

                  <div class="form-group">
                    <label for="">Tgl Selesai : </label>
                    <input type="date" class="form-control" name="tgl_selesai" placeholder="Tgl Mulai">
                  </div>

                  <div class="form-group">
                    <label for="1">Nama Project : </label>
                    <input type="text" class="form-control" name="nama_project" aria-describedby="emailHelp" placeholder="Nama Project">
                  </div>
                  <div class="form-group" style="">
                    <label for=" text">Nama Operator : </label>
                    <select name="operator" id="operator" class="form-control">
                      <option value="" name="operator" disabled selected>-- Pilih Operator --</option>
                      <?php
                      foreach ($operator as $opt) {
                        echo "<option value='" . $opt->id_user . "'>" . $opt->nama . "</option>";
                      }
                      echo "
		                    </select>"
                      ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="1">Deskripsi</label>
                    <textarea type="text" class="form-control" name="keterangan" aria-describedby="emailHelp"></textarea>
                  </div>
                  <input type="submit" class="btn btn-primary" value="Input">
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 
        <script type="text/javascript">
          $(document).ready(function() {
            $('#pilih_site').change(function() {
              var id = $(this).val();
              $.ajax({
                url: "<?php echo base_url(); ?>admincontroller/getoperator",
                methodB: "POST",
                data: {
                  id: id
                },
                async: false,
                dataType: 'json',
                success: function(operator) {
                  var html = '';
                  var i;
                  for (i = 0; i < operator.length; i++) {
                    html += '<option>' + operator[i].nama + '</option>';
                  }
                  $('.operator').html(html);

                }
              });
            });
          });
        </script>
         -->
        <?php foreach ($stask as $del) : ?>
          <div class="modal fade" id="modal_delete<?= $del->id_task; ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Task</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h2>Apakah anda yakin akan menghapus task ini?</h2>
                  <?php echo '<a href="' . site_url('AdminController/deltask/') . $del->id_task . '"class="btn  btn-primary fa fa-trash-o">Ya</a>' ?>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

</body>