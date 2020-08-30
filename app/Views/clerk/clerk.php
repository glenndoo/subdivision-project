<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<?php if (session()->get('success')) : ?>
          <div class="alert alert-success" role='alert'>
            <?= session()->get('success') ?>
          </div>
              <?php endif; ?>


    
    <table id="samples" class="table col-12 col-sm-2">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Item Code</th>
                <th>Item Quantity</th>
                <th>Quantity Status</th>
                <th>Item Price</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
        </tfoot>
    </table>
<!--<nav class="navbar navbar-light bg-light">
  <form class="form-inline" action="/clerk/clerk/search" method="get">
    <input class="form-control mr-sm-2" name='item' type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>-->

      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
 <!--   <script type="text/javascript">
//        $(document).ready(function() {
//    $('#samples').DataTable( {
//        "ajax": {
//            "url" : "http://localhost/clerk/clerk/jsonData",
//            "dataSrc" : ""
//        },"responsive": true,
//            "sPaginationType": "full_numbers",
//        "columns": [
//            {"data": "Name"},
//            {"data": "Code"},
//            {"data": "Quantity"},
//            {"data": "Quantity"},
//            {"data": "Price"}
//        ],
//        "columnDefs": [{ "targets": 5, "data": null, "defaultContent": "<input id='btnDetails' class='btn btn-success' width='25px' value='Buy' />"}]
//        } );
//        
//        $('#samples tbody').on('click', '[id*=btnDetails]', function () {
//            var data = table.row($(this).parents('tr')).data();
//            var customerID = data[0];
//            var name = data[1];
//            var title = data[2];
//            var city = data[3];
//            alert("Customer ID : " + customerID + "\n" + "Name : " + name + "\n" + "Title : " + title + "\n" + "City : " + city);
//        });
//    } );
//    </script> -->
<script type="text/javascript">
    $(function () {
        var table = $('#samples').DataTable
        ({
            "ajax": {
            "url" : "http://whai.intelektbusiness.com/jsonData",
            "dataSrc" : ""
        },"responsive": true,
            "sPaginationType": "full_numbers",
        "columns": [
            {"data": "Name"},
            {"data": "Code"},
            {"data": "Quantity"},
            {"data": "Quantity"},
            {"data": "Price"}
        ],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    {
                    return '<progress class="progress-bar bg-warning" role="progressbar" style="width: '+data+'%;" aria-valuenow="'+data+'" aria-valuemin="0" aria-valuemax="100">'+data +'</td>';
                    }
                },
                "targets": 3
                
            },
            {
                "render": function () {
                    {
                    return '<button class="btn btn-primary" id="btnDetails">Buy</button>';
                    }
                },
                "targets": 5
            }
        ]
        
        } );
        
        $('#samples tbody').on('click', '[id*=btnDetails]', function (e) {
            var data = table.row($(this).parents('tr')).data();
            var id = data["Code"];
            var name = data["Name"];
            var qty = data["Quantity"];
            var price = data["Price"];
            window.open("http://whai.intelektbusiness.com/order?id="+id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=500,width=500,height=1000");
        });
    });
</script>


<?= $this->endSection() ?>
