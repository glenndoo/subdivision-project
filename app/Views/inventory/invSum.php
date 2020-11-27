<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<!--
<nav class="navbar navbar-expand-lg navbar-dark bg-light">
  <div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
          Displaying records for 
          <?php if(isset($month)) : ?>
            the Month of <h1><i><?= date("F", mktime(0, 0, 0, $month, 10));  ?>
          <?php else : ?>
            <h1><i><?= date("F", mktime(0, 0, 0, substr($dateNow, -2), 10));  ?>
          <?php endif; ?>  
            
            
            </i></h1>
        </div>

        <div class="col-sm-4">

        </div>
        <div class="col-sm-4">
          <form method="get" action="/inventorySummary">
          <input class="form-control" type="month" name="dateSelected" id="example-month-input">
          <button class="btn-sm btn-primary">Search by Month</button>
          </form>
        </div>

    </div>
  </div>
</nav>
-->
<nav class="navbar navbar-expand-lg navbar-dark navbar-survival101">
  <div class="container-fluid">
    <a class="navbar-brand form-inline" href="#">
          Displaying records for 
          <?php if(isset($month)) : ?>
            <p><i>the Month of <?= date("F", mktime(0, 0, 0, $month, 10));  ?>
          <?php else : ?>
            <b><?= date("F", mktime(0, 0, 0, substr($dateNow, -2), 10));  ?></b></i></p>
          <?php endif; ?>  
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <div class="nav-link">
            <form method="get" action="/inventorySummary" class="form-inline">
              <div class="form-group">
                <input class="form-control" type="month" name="dateSelected" id="example-month-input">
                <button class="btn btn-primary">Search by Month</button>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <div class="nav-link">
            <span class="badge badge-pill badge-success ml-1" id="salestotal"></span>
            <span class="badge badge-pill badge-warning" id="credittotal"></span>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br/>
<div class="container-fluid">
  <div class="row d-flex justify-content-center">
    <div class="col-sm-12 ">
      <table id="sales" class="table" id="memberRecord">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Item ID</th>
            <th scope="col">Item Name</th>
            <th scope="col">Ending inventory as of <?= date("F", mktime(0, 0, 0, substr($dateNow, -2)-1, 10)); ?></th>
            <th scope="col">Replenishment as of <?= date("F", mktime(0, 0, 0, substr($dateNow, -2), 10)); ?></th>
            <th scope="col">Inventory Count as of Replenishment (<?= date("F", mktime(0, 0, 0, substr($dateNow, -2), 10)); ?>)</th>
            <th scope="col">Current Count</th>
            <th scope="col">Items Sold</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Total</th>
            <th scope="col">Transaction By</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<link src="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"></script>
<link src="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css"></script>



<script type="text/javascript">
    $(function () {
        var table = $('#sales').DataTable
        ({ 
            "dom": 'Bfrtip',
            "buttons": [
            {extend:'excel', className: 'btn btn-primary btn-sm excel-btn'}

        ],
            "ajax": {
            "url" : "<?=base_url()?>/jsonInventory?date=<?= $dateNow ?>",
            "dataSrc" : ""
        },
        "responsive": true,
            "sPaginationType": "full_numbers",

        "columns": [
            {"data": "id"},
            {"data": "Item"},
            {"data": "Replenish"},
            {"data": "Present"},
            {"data": "Stock"},
            {"data": "Current"},
            {"data": "Sold"},
            {"data": "Price"},
            {"data": "Tot"},
            {"data": "Person"}
            
            
        ],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function (data, type, row) {
                    {
                    return '<a href="/showSummary?id='+data+'">'+data+'</a>';
                    }
                },
                "targets": 0
                
            }
            ],
        "order" : [[6, "ASC"]],

        drawCallback: function () {
        var sum = $('#sales').DataTable().column(8).data().sum();
        $('#salestotal').html("Total Item Cost: <b>"+sum.toFixed(2)+"</b>");
      }
        
        
        } );

    });

</script>
<?= $this->endSection() ?>
