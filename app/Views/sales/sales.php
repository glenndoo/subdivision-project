<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-light">
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Search By
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="/sales/sales/showAll">Show All Records</a>
    <a class="dropdown-item" href="#">Another action</a>
    <a class="dropdown-item" href="#">Something else here</a>
  </div>
</div>
</nav>




<?= $this->endSection() ?>
