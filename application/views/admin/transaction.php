<?php $this->load->view('admintemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px;">
  <?php $this->load->view('admintemplate/navbar') ?>
  <div style="margin-left:40px; margin-top:40px;">
    <div class="row" style="padding-top: 12px;  margin-right:4px; margin-left:4px;">
      <div class="col" style="padding-top:16px;">
        <h1>Transaction</h1>
        <table class="table table-hover" id="mydata" style="text-align:center;">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Site</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Biaya Pengeluaran</th>
              <th scope="col">Keterangan</th>
              <th scope="col">Bukti</th>
              <th scope="col">Aksi</th>
            </tr>

          </thead>

          <tbody>
            <?php
            $no = 1;
            if ($data) {
              foreach ($data as $d) { ?>

                <th scope="col"><?php echo $no++ ?></th>
                <td><?php echo $d->nama ?></td>
                <td><?php echo $d->tanggal ?></td>
                <td><?php echo $d->biaya_tr ?></td>
                <td><?php echo $d->ket_tr ?></td>
                <td><?php echo '<a href="' . site_url('UserController/lakukan_download_gambar/') . $d->nama_trans . '"class="btn btn-primary fa fa-trash-o">Download</a>';
                    ?></td>
                <td><a href="<?php echo base_url('AdminController/delDatauang'); ?>/<?php echo $d->id_uang; ?>" class="btn btn-danger fa fa-trash-o text-white" onClick="return confirm('Serius?..')">
                    Delete</a></td>
                </tr>
              <?php
              }
            }
            ?>
          </tbody>

        </table>



      </div>
    </div>
  </div>

</body>