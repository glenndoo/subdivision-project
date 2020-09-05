<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<?php if (session()->get('success')) : ?>
          <div class="alert alert-success" role='alert'>
            <?= session()->get('success') ?>
          </div>
              <?php endif; ?>
              <script>
function sum() {
           var txtFirstNumberValue = document.getElementById('quantity').value;
           var txtSecondNumberValue = document.getElementById('price').value;
           var result = Number(txtFirstNumberValue) * Number(txtSecondNumberValue);
           if (!isNaN(result)) {
               document.getElementById('total').value = result;
           }
       }
       
function display() {
           var txtFirstNumberValue = document.getElementById('amount').value;
           var txtSecondNumberValue = document.getElementById('total').value;
           var result = Number(txtFirstNumberValue) - Number(txtSecondNumberValue);
           if (!isNaN(result)) {
               document.getElementById('updateTotal').value = result;
           }
       }
</script>

    
    <table id="samples" class="table col-12 col-sm-2">
        <thead>
            <tr>
                <th>Item Code</th>
                <th>Item Name</th>            
                <th>Item Quantity</th>
                <th>Item Price</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
        </tfoot>
    </table>
    <
<!--<nav class="navbar navbar-light bg-light">
  <form class="form-inline" action="/clerk/clerk/search" method="get">
    <input class="form-control mr-sm-2" name='item' type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>-->
<div class="container">

    <div id="buy" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Purchase Item</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p><div class="container">
        <form method="post" id="purchaseItem" action="">
        
        <div class="container">
        <div class="row">
            <div class="col">
                <label for="itemcode">Item Code</label>
                <input type="text" class="form-control" name="itemcode" id="itemcode" placeholder="sample123" readonly>
            </div>
            <div class="col">
                 <label for="itemname">Item Name</label>
                <input type="text" class="form-control" name="itemname" id="itemname" placeholder="sample123" readonly>
            </div>
                
            
        </div>
        <div class="row">
            <div class='col'>
            <label for="itemname">Stock</label>
            <input type="text" class="form-control" name="stock" id="stock" placeholder="sample123" readonly>
            </div>
        <div class="col">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="sample123" readonly>
        </div>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="00" onkeyup="sum()">
        </div>
        <hr>
        <div class="row">
            <div class="col">
            <label for="total">Total Amount</label>
            <input type="number" class="form-control" name="total" id="total" readonly>
            </div>
        <div class="col">
            <label for="amount">Payment Amount</label>
            <input type="number" class="form-control" name="amount" id="amount" placeholder="00" onkeyup="display()">
        </div>
        </div>
            <div class="form-group">
              <label for="sel1">Members:</label>
              <select class="form-control" id="member" name="member">
                                <?php foreach($members as $row) : ?>
                  <option value="<?= $row->member_id ?>"><?= $row->member_last ?>, <?= $row->member_first ?></option>
                              <?php endforeach; ?>
              </select>
        </div>
        <div class="form-group">
              <label for="sel1">Payment Type</label>
              <select class="form-control" id="paymentType" name="paymentType">
                  <option value="cash">Cash</option>
                  <option value="credit">Credit</option>
              </select>
        </div>
        <div class="form-group">
            <label for="updateTotal">Change</label>
            <input type="text" class="form-control" name="updateTotal" id="updateTotal" readonly>
        </div>
        <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                  <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
</div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-success">Purchase</button>
          </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>
</div>
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
            "url" : "<?=base_url()?>/jsonData",
            "dataSrc" : ""
        },"responsive": true,
            "sPaginationType": "full_numbers",
        "columns": [
            {"data": "Code"},
            {"data": "Name"},            
            {"data": "Quantity"},
            {"data": "Price"}
        ],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                
                
            },
            {
                "render": function () {
                    {
                    return '<button class="btn btn-primary" id="btnBuy" data-toggle="modal" data-target="#buy">Buy</button>';
                    }
                },
                "targets": 4
            }
        ]
        
        } );
        
        $('#samples tbody').on('click', '[id*=btnBuy]', function (e) {
            var data = table.row($(this).parents('tr')).data();
            var id = data["Code"];
            var name = data["Name"];
            var qty = data["Quantity"];
            var price = data["Price"];
            document.getElementById("itemcode").value = id;
            document.getElementById("itemname").value = name;
            document.getElementById("stock").value = qty;
            document.getElementById("price").value = price;
            document.getElementById("purchaseItem").action = "<?=base_url()?>/purchase?id="+id;
            
        });
    });
</script>


<?= $this->endSection() ?>
