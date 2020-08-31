<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-light">
<div class="container-fluid">
<div class="row">
    <div class="col-sm-4">
      Displaying records for 
      <?php if(isset($month)) : ?>
        the Month of <h1><i><?= date("F", mktime(0, 0, 0, $month, 10));  ?>
      <?php else : ?>
        <h1><i><?= $dateNow ?>
      <?php endif; ?>  
        
        
        </i></h1>
    </div>

    <div class="col-sm-4">

    </div>
    <div class="col-sm-4">
      <form method="get" action="/inventorySummary">
      <input class="form-control" type="month" name="dateSelected" id="example-month-input">
      <button class="btn btn-primary">Search by Month</button>
      </form>
    </div>

</div>
</div>
    
      

    
    
</nav>


<table id="sales" class="table" id="memberRecord">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Item</th>
      <th scope="col">Replenishment Count</th>
      <th scope="col">Current Count</th>
      <th scope="col">Items Sold</th>
    </tr>
  </thead>
  <tbody>
  <h3><span class="badge badge-pill badge-success ml-1" id="salestotal"></span>
<span class="badge badge-pill badge-warning" id="credittotal"></span></h3>
    </tbody></table>
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#sales').DataTable
        ({ 
            "dom": 'l<"toolbar">frtip',
            "ajax": {
            "url" : "<?=base_url()?>/jsonInventory?date=<?= $dateNow ?>",
            "dataSrc" : ""
        },
        "responsive": true,
            "sPaginationType": "full_numbers",
        "columns": [
            {"data": "Item"},
            {"data": "Replenish"},
            {"data": "Current"},
            {"data": "Sold"}

        ],
        "order" : [[1, "ASC"]],
        "buttons": [
            'print'
        ],
        
        
        
        
        
        } );
        
    });

</script>
<?= $this->endSection() ?>
