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

<div class="container">
              <label for="sel1">Members:</label>
              <select class="form-control" id="member" name="member">
              
                                <?php foreach($members as $row) : ?>
                  <option value="<?= $row->member_id ?>"><?= $row->member_last ?>, <?= $row->member_first ?></option>
                              <?php endforeach; ?>
              </select>
              </form>
              <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-success openBtn" data-toggle="modal" data-target="#cart">Cart
<span class="badge badge-danger" id="notif">

</span>
</button>

<!-- Modal -->
<div class="modal fade" id="cart" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Cart: </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="container">
        <form method="POST" action="purchase">
        <table id="cart">
        <thead>
            <tr>
                <th>Item Name</th>            
                <th>Item Quantity</th>
                <th>Item Price</th>
                <th>Item Total Cost</th>
                <th></th>
            </tr>
        </thead>
       
        <tr>
        </tr>

        <tfoot>
        </tfoot>
        </table>
        <hr>
        <p id="cont">
        Total: 
        </p>
        <hr>
        <p>
        <label for="paymentType">Payment Type</label>
        <select name="paymentType">
            <option value="cash">Cash</option>
            <option value="credit">Credit</option>
        </select></p>
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
</div>
    <table id="samples" class="table col-12 col-sm-2">
        <thead>
            <tr>
                <th>Item Code</th>
                <th>Item Name</th>            
                <th>Item Quantity</th>
                <th>Item Price</th>
                <th>Order Quantity</th>
            </tr>
        </thead>
        <tfoot>
        </tfoot>
    </table>
    

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

<script type="text/javascript">
var total = new Array();
var sum = 0;
    var ntf = 0;
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
                    return '<input type="number" step="0.01" id="qty" placeholder="Quantity" value="1"> <button class="btn btn-primary" id="btnBuy">Add to Cart</button>';
                    }
                },
                "targets": 4
            },
            
        ]
        
        } );
        
        $('#samples tbody').on('click', '[id*=btnBuy]', function (e) {
            var data = table.row($(this).parents('tr')).data();
            var id = data["Code"];
            var quant = data["Quantity"];
            var itemName = data["Name"];
            var price = data['Price'];
            var member = document.getElementById("member").value;
            var qty = document.getElementById("qty").value;
            var totalCost = parseInt(price*qty);
            var stock = quant-qty;
                var db = $("#cart tbody");
                db.append("<tr><td>"+itemName+"</td><td><input class='form-control' type='number' step='0.01' name='quantity[]' value='"+qty+"' readonly='readonly'></td><td><input class='form-control' type='number' step='0.01' id='sumPrice' value='"+price+"' name='price[]' readonly='readonly'></td><td><input class='form-control' type='number' readonly='readonly' name='total[]' value='"+totalCost+"'></td><input type='hidden' name='code[]' value='"+id+"'><input type='hidden' name='member[]' value='"+member+"'><input type='hidden' name='stock[]' value='"+stock+"'><input type='hidden' name='stock[]' value='"+stock+"'><input type='hidden' name='current[]' value='"+quant+"'></tr>");
                total.push(price);
                sum += parseInt(totalCost);
                
                

                
                $("#cont").text("TOTAL: PHP "+sum);              
                ntf++;
        });
        
    });

    $(document).ready(function() {
        
        setInterval(function(){
            $("#notif").text(ntf);
        }, 500);
            

            });

</script>


<?= $this->endSection() ?>
