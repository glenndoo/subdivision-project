<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-light">
<div class="container-fluid">
<div class="row">
    <div class="col-sm-3">
      Displaying records for 
      <?php if(isset($month)) : ?>
        the Month of <h1><i><?= date("F", mktime(0, 0, 0, $month, 10));  ?>
      <?php else : ?>
        <h1><i><?= $dateNow ?>
        
      <?php endif; ?>  
        
        </i></h1>
    </div>
    <div class="col-sm-3">
      <form method="get" action="/sales">
      <input class="form-control" type="date" name="dateSelected" id="example-date-input">
      <button class="btn btn-primary">Search by Day</button>
      </form>
    </div>
    <div class="col-sm-3">
      <form method="get" action="/sales">
      <input class="form-control" type="month" name="dateSelected" id="example-month-input">
      <button class="btn btn-primary">Search by Month</button>
      </form>
    </div>

</div>
</div>
    
      

    
    
</nav>

<div>
<table id="sales" class="table" id="memberRecord">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Receipt Number</th>
      <th scope="col">Name</th>
      <th scope="col">Item</th>
      <th scope="col">Quantity Bought</th>
      <th scope="col">Cash Paid</th>
      <th scope="col">Credit</th>
      <th scope="col">Sales Date</th>
      <th scope="col">Sales Date</th>
    </tr>
  </thead>
  <tbody>
  <h3><span class="badge badge-pill badge-success ml-1" id="salestotal"></span>
<span class="badge badge-pill badge-warning" id="credittotal"></span></h3>
    </tbody></table>
    </div>
     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>

<script type="text/javascript">
    $(function () {
        $('#sales').DataTable
        ({ 
            "dom": 'l<"toolbar">frtip',
            "ajax": {
            "url" : "<?=base_url()?>/jsonSales?date=<?= $dateNow ?>",
            "dataSrc" : ""
        },"responsive": true,
            "sPaginationType": "full_numbers",
        "columns": [
            {"data": "salesid"},
            {"data": "name"},
            {"data": "Item"},
            {"data": "Quantity"},
            {"data": "Paid"},
            {"data": "Credit"},
            {"data": "Date"},
            {"data": "memberid"}
        ], 
        "columnDefs" : [
        {
          "render": function ( data, type, row ) {
                    {
                    return 'PHP '+data;
                    }
                },
                "targets": 5
        },
        {
          "render": function ( data, type, row ) {
                    {
                    return 'PHP '+data;
                    }
                },
                "targets": 4
        },
        {
                "targets": [ 7 ],
                "visible": false
            }],
 
        "order" : [[6, "ASC"]],
        
        drawCallback: function () {
        var sum = $('#sales').DataTable().column(4).data().sum();
        var sumcred = $('#sales').DataTable().column(5).data().sum();
        $('#salestotal').html("Total Sales in cash: <b>Php "+sum.toFixed(2)+"</b>");
        $('#credittotal').html("Total Sales in credit: <b>Php "+sumcred.toFixed(2)+"</b>");
      }	
        
        
        
        
        
        } );
        
    });

</script>
<?= $this->endSection() ?>
