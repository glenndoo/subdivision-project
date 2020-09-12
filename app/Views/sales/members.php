<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <a href="sales" class="btn btn-primary col-1">Back</a>
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Search By
  </a>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" href="#">Members</a>
    <a class="dropdown-item" href="#">Non-members</a>
  </div>
</div>
</nav>


<table class="table">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Member Name</th>
        <th scope="col">Credits</th>
    </tr>
  </thead>
  <tbody>
    
        <?php $total = 0 ?>
        <?php foreach($members as $row) : ?>
      <tr>
          <td><a href="<?=base_url()?>/memberPurchases?id=<?= $row->Member ?>&name=<?= $row->Name?>"><?= $row->Name ?></a></td>
          <td>Php <?= $row->Total ?></td>
        <?php endforeach; ?>
          
      </tr>
</tbody></table>

<?= $this->endSection() ?>
