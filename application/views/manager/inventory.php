<?php $this->load->view('managertemplate/header') ?>

<body class="fixed-sn pink-skin" style="margin-left:160px;">
  <?php $this->load->view('managertemplate/navbar') ?>
  <div style="margin-left:40px; margin-top:40px;">
    <div class="row" style="padding-top: 12px;  margin-right:4px; margin-left:4px;">
      <div class="col" style="padding-top:16px;">
        <h1>Inventory</h1>
        <table class="table table-hover" style="text-align:center;" id="wow">
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

      </div>
</body>