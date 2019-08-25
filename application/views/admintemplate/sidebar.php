<div class="sidenav sidebar-expand-lg navbar-dark bg-dark scrolling-sidebar">
  <ul class="navbar-nav">
    <li class="nav-item" style="margin-top:32px;">
      <a class="nav-link <?php if ($page == 'index') {
                            $echo = 'active';
                          } else {
                            $echo = 'nonactive';
                          }
                          echo $echo; ?>" href="<?php echo site_url('AdminController/index'); ?>"><i data-feather="home" id="icon"></i>Dashboard</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if ($page == 'task') {
                            $echo = 'active';
                          } else {
                            $echo = 'nonactive';
                          }
                          echo $echo; ?>" href="<?php echo site_url('AdminController/task'); ?>"><i data-feather="briefcase" id="icon"></i>Task</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if ($page == 'report') {
                            $echo = 'active';
                          } else {
                            $echo = 'nonactive';
                          }
                          echo $echo; ?>" href="<?php echo site_url('AdminController/report'); ?>"><i data-feather="layers" id="icon"></i>Report</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if ($page == 'transaction') {
                            $echo = 'active';
                          } else {
                            $echo = 'nonactive';
                          }
                          echo $echo; ?>" href="<?php echo site_url('AdminController/transaction'); ?>"><i data-feather="dollar-sign" id="icon"></i>Transaction</a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?php if ($page == 'inventory') {
                            $echo = 'active';
                          } else {
                            $echo = 'nonactive';
                          }
                          echo $echo; ?>" href="<?php echo site_url('AdminController/inventory'); ?>"><i data-feather="package" id="icon"></i>Inventory</a>
    </li>
  </ul>

</div>

<script>
  feather.replace()
</script>