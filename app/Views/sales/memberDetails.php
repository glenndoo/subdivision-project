<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <a href="showMembers" class="btn btn-primary col-1">Back</a>
    
</div>
</nav>
Showing records of <i> <?= $name ?></i>
<form method="get" action="/sales/sales/searchByMemberDate">

    <label>Date</label>
    <input type="month" name="selectedMonth">
    <input type="hidden" name="id" value="<?= $userId ?>">
    <input type="hidden" name="name" value="<?= $name ?>">
    <button class="btn btn-primary col-1">Search</button>
</form>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Receipt #</th>
      <th scope="col">Item Code</th>
      <th scope="col">Item Name</th>
      <th scope="col">Quantity Bought</th>
      <th scope="col">Total Cost</th>
      <th scope="col">Amount Paid in Cash</th>
      <th scope="col">Credit</th>
      <th scope="col">Payment Type</th>
      <th scope="col">Sales Date</th>
      <th scope="col">Sold By</th>
      
    </tr>
  </thead>
  <tbody>
        <?php $total = 0; $credit = 0 ?>
        <?php foreach($members as $row) : ?>
      <tr>
          <th scope="row"><?= $row->sales_receipt ?></th>
        <td><?= $row->item_code ?></td>
        <td><?= $row->item_name ?></td>
        <td><?= $row->sales_quantity ?></td>
        <td>Php <?= number_format($row->sales_total_amount, 2, '.', ',') ?></td>
        <?php if($row->sales_payment_type == 'cash') : ?>
        <td>Php <?= number_format($row->sales_amount_paid, 2, '.', ',') ?></td>
        <?php else :?>
        <td>-------</td>
        <?php endif; ?>
        <?php if($row->sales_payment_type == 'credit') : ?>
        <td>Php <?= number_format($row->sales_credit_amount, 2, '.', ',') ?></td>
        <?php else :?>
        <td>-------</td>
        <?php endif; ?>
        <?php if($row->sales_payment_type == 'cash') : ?>
        <td>Cash</td>
        <?php else :?>
        <td>Credit</td>
        <?php endif; ?>
        <td><?= $row->sales_date ?></td>
        <td><?= $row->user_last ?>, <?= $row->user_first ?></td>
         <?php if($row->sales_payment_type == 'cash') : ?>
        <?php $total += $row->sales_amount_paid ?>
        <?php else : ?>
        <?php $credit += $row->sales_credit_amount ?>
        <?php endif; ?>
        
        <?php endforeach; ?>
      </tr>
      <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <th>TOTAL: Php <?= number_format($total, 2, '.', ',') ?></th>
          <th>TOTAL: Php <?= number_format($credit, 2, '.', ',') ?></th>
          <td></td>
          <td></td>
          <td></td>
    
      </tr></tbody></table>

<?= $this->endSection() ?>
