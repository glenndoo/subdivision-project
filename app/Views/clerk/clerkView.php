<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

    



<table id="sales" class="table" id="memberRecord">
  <thead class="thead-dark">
    <tr>
        <th scope="col">Transaction ID</th>
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
            "url" : "<?=base_url()?>/jsonSales?date=<?= date("yy-m-d")?>",
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
        "columnDefs" : [{
            "render": function ( data, type, row ) {
                    {
                    return data;
                    }
                },
                "targets": 1
        },
        {
                "targets": [ 7 ],
                "visible": false
            }],
 
        "order" : [[6, "ASC"]]
      	
        
        
        
        
        
        } );
        
    });

</script>
<?= $this->endSection() ?>
