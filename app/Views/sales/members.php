<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <a href="sales" class="btn btn-primary col-1">Back</a>
    <div class="form-control">
    <form method="GET" action="/showMembers">
    <input type="month" name="searchDate" />
    <input class="btn btn-primary"type='submit' value='Search By Month' />
    </form>
    </div>

</nav>
<?php $sum = 0 ?>

<table class="table">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Member Name</th>
        <th scope="col">Total Payment as of <?= date("F", mktime(0, 0, 0, substr(date($dateNow), -2), 10));  ?></th>
        <th scope="col">Credits</th>
    </tr>
    
  </thead>
  <tbody>
    
        <?php $total = 0 ?>
        <?php foreach($members as $row) : ?>
      <tr>
          <td><a href="<?=base_url()?>/memberPurchases?id=<?= $row->Member ?>&name=<?= $row->Name?>"><?= $row->Name ?></a></td>
          <td><?= $row->Payment?></td>
          <td>Php <?= $row->Total ?></td>
          <?php $sum += $row->Payment ?></td>
        <?php endforeach; ?>
        
      </tr>
      <tr><td></td><td><b><?= $sum ?></b></td></tr>
</tbody></table>

<?= $this->endSection() ?>
