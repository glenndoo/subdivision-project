<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-light">

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
        <th scope="col">Make Payment</th>
    </tr>
  </thead>
  <tbody>
    
        <?php $total = 0 ?>
        <?php foreach($members as $row) : ?>
      <tr>
          <td><?= $row->member_last ?>, <?= $row->member_first ?></td>
          <td>Php <?=number_format( $row->totalCredit, 2)?></td>
          <td><form method="POST" action="<?=base_url()?>/payment"><input type="number" name="payment"><input type='submit' class="btn btn-primary" value="Make payment"><input type="hidden" name="id" value="<?= $row->member_id?>"><input type="hidden" name="total" value="<?= $row->totalCredit?>"></form></td>
        <?php endforeach; ?>
          
      </tr>
</tbody></table>

<?= $this->endSection() ?>
