<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>



<div>
<table class="table" id="credit">
  <thead class="thead-dark">
    <tr>
    <th scope="col">Member ID</th>
        <th scope="col">Member Name</th>
        <th scope="col">Credits</th>
        <th scope="col">Make Payment</th>
    </tr>
  </thead>
  <tbody>
    
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
        var table = $('#credit').DataTable
        ({ 
            "dom": 'l<"toolbar">frtip',
            "ajax": {
            "url" : "<?=base_url()?>/jsonCredit",
            "dataSrc" : ""
        },"responsive": true,
            "sPaginationType": "full_numbers",
        "columns": [
          {"data": "Member"},
          {"data": "Name"},
          {"data": "Total"}
        ],
        "columnDefs" : [
          {
            "render" : function () {
                    {
                    return '<input type="number" id="payment"> <a class="btn btn-primary" id="payCredit">Make Payment</a>';
                    }
                },
                "targets" : 3
            }
          
        ]

        });  


        $('#credit tbody').on('click', '[id*=payCredit]', function () {
            var data = table.row($(this).parents('tr')).data();
            console.log(document.getElementById("payment").value);
        });
    });

</script>
<?= $this->endSection() ?>

