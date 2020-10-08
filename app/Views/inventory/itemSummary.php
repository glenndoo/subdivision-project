<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


<table id="summary" class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Previous Count</th>
      <th scope="col">Added Quantity</th>
      <th scope="col">Date</th>
      <th scope="col">Type</th>
      <th scope="col">Transaction</th>
    </tr>
  </thead>
  <tbody>
    </tbody>
    </table>







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
       var table = $('#summary').DataTable
        ({ 
            "dom": 'l<"toolbar">frtip',
            "ajax": {
            "url" : "<?=base_url()?>/invDetails?id=<?= $id ?>",
            "dataSrc" : ""
        },
        "responsive": true,
            "sPaginationType": "full_numbers",
        "columns": [
            {"data": "prev"},
            {"data": "added"},
            {"data": "date"},
            {"data": "type"},
            {"data": "trans"}
            
        ],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function (data, type, row) {
                    {
                        if(data == 1){
                            return "Sales"
                        }else if(data == 3){
                            return "Inventory Stamp"
                        }else{
                            return "Replenishment"
                        }
                    
                    }
                },
                "targets": 3
                
            }
            ],	
            "order" : [[2, "ASC"]]
        
        } );
        
    });

</script>
<?= $this->endSection() ?>
