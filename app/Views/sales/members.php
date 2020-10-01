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
<table id="sales" class="table">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Member Name</th>
        <th scope="col">Total Payment as of <?= date("F", mktime(0, 0, 0, substr(date($dateNow), -2), 10));  ?></th>
        <th scope="col">Credits</th>
    </tr>
    
  </thead>
  <tbody>
    
        
</tbody></table>
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
            'excel'
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
