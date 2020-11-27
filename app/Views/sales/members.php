<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<!--
<nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <a href="sales" class="btn btn-primary col-1">Back</a>
    <div class="form-control">
    <form method="GET" action="/showMembers">
    <input type="month" name="searchDate" />
    <input class="btn btn-primary"type='submit' value='Search By Month' />
    </form>
    </div>
</nav>
-->
<nav class="navbar navbar-expand-lg navbar-dark navbar-survival101">
  <div class="container-fluid">
    <a class="navbar-brand form-inline" href="#">
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
            <form method="GET" action="/showMembers" class="form-inline">
                <div class="form-group">
                    <input type="month" name="searchDate" class="form-control" />
                    <input class="btn btn-primary"type='submit' value='Search By Month' />
                </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <div class="nav-link">
            <a href="sales" class="btn btn-primary form-inline">Back to sales</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<br/>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <table id="sales" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Member Name</th>
                        <th scope="col">Total Payment as of <?= date("F", mktime(0, 0, 0, substr(date($dateNow), -2), 10));  ?></th>
                        <th scope="col">Credits</th>
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
            "url" : "<?=base_url()?>/jsonShowMembers?date=<?= $dateNow ?>",
            "dataSrc" : ""
        },
        "responsive": true,
            "sPaginationType": "full_numbers",

        "columns": [
            {"data": "Name"},
            {"data": "Payment"},
            {"data": "Total"}
            
            
        ],
        
        
        
        } );

    });

</script>
<?= $this->endSection() ?>
