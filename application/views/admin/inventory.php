<?php $this->load->view('admintemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px;">
  <?php $this->load->view('admintemplate/navbar') ?>
  <div style="margin-left:40px; margin-top:40px;">
    <div class="row" style="padding-top: 12px;  margin-right:4px; margin-left:4px;">
      <div class="col" style="padding-top:16px;">
        <h1>Inventory</h1>
        <table class="table table-hover" id="mydata" style="margin-top: 15px;font-size: 14px; text-align: center;">
          <thead>
            <tr>
              <th scope="col">Nomor</th>
              <th scope="col">Nama Item</th>
              <th scope="col">Brand</th>
              <th scope="col">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;
            if ($jml) {
              foreach ($jml as $j) { ?>
                <tr>
                  <th scope="col"><?php echo $no++ ?></th>
                  <td><?php echo $j->name ?></td>
                  <td><?php echo $j->brand ?></td>
                  <td><?php echo $j->total ?></td>
                </tr>
              <?php
              }
            }
            ?>
          </tbody>
        </table>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" style="float: left;margin-bottom: 20px;">
          Input Item
        </button>

        <!-- Modal -->
        <div class=" modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalScrollableTitle">Input Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="<?php echo base_url() . 'AdminController/tambah'; ?>" method="post">
                  <div class="form-group row">
                    <label for="text" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                      <input type="text" name="name" class="form-control" placeholder="Nama">
                    </div>
                  </div>
                  <div class="form-group row">
                    <br>
                    <label for="text" class="col-sm-2 col-form-label">Merk</label>
                    <div class="col-sm-10">
                      <input type="text" name="brand" class="form-control" placeholder="Merk">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="text" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                      <input type="text" name="jumlah" class="form-control" placeholder="Jumlah">
                    </div>
                  </div>
                  <input type="submit" value="Input" class="btn btn-primary">

                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>