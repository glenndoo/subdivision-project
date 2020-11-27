<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<!--
<nav class="navbar navbar-expand-lg navbar-dark bg-light">
<div class="container-fluid">
<div class="row">
    <div class="col-sm-3">
      Displaying records for 
      <?php if(isset($month)) : ?>
        the Month of <h1><i><?= date("F", mktime(0, 0, 0, $month, 10));  ?>
      <?php else : ?>
        </h1></i><?= $dateNow ?>
        
      <?php endif; ?>  
        
        </i></h1>
    </div>
    <div class="col-sm-3">
      <a class="btn btn-primary" href="showMembers">Members</a>
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
</nav>-->
<nav class="navbar navbar-expand-lg navbar-dark navbar-survival101">
  <div class="container-fluid">
    <a class="navbar-brand form-inline" href="#">
          
          <?php if(isset($month)) : ?>
            <p><i>Displaying records for <?= date("F", mktime(0, 0, 0, $month, 10));  ?>
          <?php else : ?>
            <b><?= $dateNow ?></b></i></p>
          <?php endif; ?>  
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto row">
        <li class="nav-item">
          <div class="nav-link">
            <form method="get" action="/sales"class="form-inline">
              <input class="form-control" type="date" name="dateSelected" id="example-date-input">
              <button class="btn btn-primary">Search by Day</button>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <div class="nav-link" href="#">
            <form method="get" action="/sales" class="form-inline">
              <input class="form-control" type="month" name="dateSelected" id="example-month-input">
              <button class="btn btn-primary">Search by Month</button>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <div class="nav-link" href="#">
            <span class="badge badge-pill badge-success ml-1" id="salestotal"></span>
            <span class="badge badge-pill badge-warning" id="credittotal"></span>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!--MODAL FOR REMOVING-->
<div class="container-fluid">
  <div id="remove" class="modal fade row" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Remove Item</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>
            <div class="container">
            This action cannot be undone
            <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                 <?= $validation->listErrors() ?>
              </div>
            </div>
            <?php endif; ?>
          </p>
        </div>
        <div class="modal-footer">
          <form action="" id="removeAction" method="post">
            <button type="submit" class="btn btn-danger">Remove Item</button>
          </form>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<br/>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <!--<table id="sales" class="table" id="memberRecord">-->
      <table id="sales" class="table">
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
          <th scope="col">Options</th>
          <th scope="col">Hide</th>
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>

<script type="text/javascript">
    $(function () {
        var table = $('#sales').DataTable
        ({ 
           /* "dom": 'l<"toolbar">frtip',*/
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
            {"data": "memberid"},
            {"data": "sId"},
            {"data": "itemId"}
        ], 
        "columnDefs" : [{
            "render": function ( data, type, row ) {
                    {
                    return '<a href="<?=base_url()?>/memberPurchases?id='+row['memberid']+'&name='+row['name']+'">'+data+'</a>';
                    }
                },
                "targets": 1
        },
        {
            "render": function ( data, type, row ) {
                    {
                    return '<a href="<?=base_url()?>/memberPurchases?receipt='+row['salesid']+'">'+data+'</a>';
                    }
                },
                "targets": 0
        },
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
            "render": function ( data, type, row ) {
                    {
                    return '<a class="btn btn-danger" id="removeMe'+data+'" data-toggle="modal" data-target="#remove">Remove</a>';
                    }
                },
                "targets": 8
        },
        {
                "targets": [ 7, 9 ],
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

        $('#sales tbody').on('click', '[id*=removeMe]', function () {
            var data = table.row($(this).parents('tr')).data();
            var id = data["sId"];
            var item = data["itemId"];
            var amt = data['Credit'];
            var mem = data['memberid'];
            var qty = data["Quantity"];
            var rcpt = data["salesid"];
            document.getElementById("removeAction").action = "<?= base_url() ?>/removeSales?id="+id+"&item="+item+"&qty="+qty+"&rcpt="+rcpt+"&amt="+amt+"&mem="+mem;
        });
        
    });

</script>
<?= $this->endSection() ?>
