<?php $this->load->view('gmtemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px;">
  <?php $this->load->view('gmtemplate/navbar') ?>
  <div style="margin-left:40px; margin-top:40px;">
    <div class="row" style="padding-top: 12px;  margin-right:4px; margin-left:4px;">
      <div class="col" style="padding-top:16px;">
        <h1>Transaction</h1>
        <table class="table table-hover" id="mydata">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Site</th>
              <th scope="col">Tanggal</th>
              <th scope="col">Biaya Pengeluaran</th>
              <th scope="col">Deskripsi</th>
            </tr>

          </thead>

          <tbody>
            <?php
            $no = 1;
            if ($data) {
              foreach ($data as $d) { ?>
                <tr>
                  <th scope="col"><?php echo $no++ ?></th>
                  <td><?php echo $d->nama ?></td>
                  <td><?php echo $d->tanggal ?></td>
                  <td><?php echo $d->biaya_tr ?></td>
                  <td><?php echo $d->ket_tr ?></td>
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