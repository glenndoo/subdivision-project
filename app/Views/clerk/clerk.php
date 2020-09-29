<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<?php if (session()->get('success')) : ?>
          <div class="alert alert-success" role='alert'>
            <?= session()->get('success') ?>
          </div>
              <?php endif; ?>
<script>



function load() {
           var txtFirstNumberValue = document.getElementById('loadQuantity').value;
           var txtSecondNumberValue = document.getElementById('loadPrice').value;
           var result = (Number(txtFirstNumberValue) * Number(txtSecondNumberValue)+ 2);
           if (!isNaN(result)) {
               document.getElementById('loadTotal').value = result;
           }
       }
       
function display() {
           var txtFirstNumberValue = document.getElementById('loadAmount').value;
           var txtSecondNumberValue = document.getElementById('loadTotal').value;
           var result = Number(txtFirstNumberValue) - Number(txtSecondNumberValue);
           if (!isNaN(result)) {
               document.getElementById('updateTotal').value = result;
           }
       }

function smartLoad() {
           var txtFirstNumberValue = document.getElementById('smartQuantity').value;
           var txtSecondNumberValue = document.getElementById('smartPrice').value;
           var result = (Number(txtFirstNumberValue) * Number(txtSecondNumberValue)+ 2);
           if (!isNaN(result)) {
               document.getElementById('smartTotal').value = result;
           }
       }
       
function smartDisplay() {
           var txtFirstNumberValue = document.getElementById('smartAmount').value;
           var txtSecondNumberValue = document.getElementById('smartTotal').value;
           var result = Number(txtFirstNumberValue) - Number(txtSecondNumberValue);
           if (!isNaN(result)) {
               document.getElementById('updateSmartTotal').value = result;
           }
       }       
</script>



<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#stamp">Stamp Inventory</button><br />

<div class="container">
              <label for="sel1">Members:</label>
              <select class="form-control" id="member" name="member">
              <option value="null"></option>
              
                                <?php foreach($members as $row) : ?>
                  <option value="<?= $row->member_id ?>"><?= $row->member_last ?>, <?= $row->member_first ?></option>
                              <?php endforeach; ?>
              </select>
              </form>
              <!-- Trigger the modal with a button -->
<button type="button" class="btn btn-warning openBtn" data-toggle="modal" data-target="#cart">Cart
<span class="badge badge-danger" id="notif">

</span>
</button>

<button type="button" class="btn btn-success " data-toggle="modal" data-target="#smart">Smart/TNT Load
</button>
<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#globe">Globe/TM Load
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
        <form method="POST" action="/purchase">
        <table id="cart">
        <thead>
            <tr>
                <th>Item Name</th>            
                <th>Item Quantity</th>
                <th>Selling Price</th>
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
          <button type="submit" class="btn btn-success" id="purchase">Purchase</button>
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
          <button type="button" class="btn btn-success">Purchase</button>
          </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>
</div>



<!-- LOAD MODAL -->
<div class="modal fade" id="globe" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Prepaid Load</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="container">
        <?php foreach($globe as $it) :?>
    <form method="post" action="globeLoad">
        
        <div class="container">
        <div class="row">
            <div class="col">
                <label for="itemcode">Item Code</label>
                <input type="text" class="form-control" name="loadCode" id="loadCode" placeholder="sample123" value='<?= $it->item_id ?>' readonly>
            </div>
            <div class="col">
                 <label for="itemname">Item Name</label>
                <input type="text" class="form-control" name="loadName" id="loadName" placeholder="sample123" value='<?= $it->item_name ?>' readonly>
            </div>
                
            
        </div>
        <div class="row">
            <div class='col'>
            <label for="itemname">Stock</label>
            <input type="text" class="form-control" name="loadStock" id="loadStock" placeholder="sample123" value='<?= $it->item_quantity ?>' readonly>
            </div>
        <div class="col">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="loadPrice" id="loadPrice" placeholder="sample123" value='<?= number_format($it->item_price, 2, '.', ',') ?>' readonly>
        </div>
        </div>
        <?php endforeach; ?>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="loadQuantity" id="loadQuantity" placeholder="00" value='' onkeyup="load()">
        </div>
        <div class="form-group">
            <label for="quantity">Actual Quantity</label>
            <input type="number" class="form-control" name="loadActual" id="loadActual" placeholder="00" value='' step="0.01">
        </div>
        <hr>
        <div class="row">
            <div class="col">
            <label for="total">Total Amount</label>
            <input type="number" class="form-control" name="loadTotal" id="loadTotal" readonly>
            </div>
        <div class="col">
            <label for="amount">Payment Amount</label>
            <input type="number" class="form-control" name="loadAmount" id="loadAmount" placeholder="00" value="" step="0.01" onkeyup="display()">
        </div>
        </div>
            <div class="form-group">
              <label for="sel1">Members:</label>
              <select class="form-control" id="loadMember" name="loadMember">
                                <?php foreach($members as $row) : ?>
                  <option value="<?= $row->member_id ?>"><?= $row->member_last ?>, <?= $row->member_first ?></option>
                              <?php endforeach; ?>
              </select>
        </div>
        <div class="form-group">
              <label for="sel1">Payment Type</label>
              <select class="form-control" id="loadType" name="loadType">
                  <option value="cash">Cash</option>
                  <option value="credit">Credit</option>
              </select>
        </div>
        <div class="form-group">
            <label for="updateTotal">Change</label>
            <input type="text" class="form-control" name="updateTotal" id="updateTotal" readonly>
        </div>
        
</form>
        
      <div class="modal-footer">
      <button type="submit" class="btn btn-success">Load</button>
          </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
</div>
  </div>
</div>

</div>
</div>
<!-- LOAD MODAL -->
<div class="modal fade" id="smart" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Prepaid Load</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="container">
        <?php foreach($smart as $it) :?>
            <form method="post" action="globeLoad">
        
        <div class="container">
        <div class="row">
            <div class="col">
                <label for="itemcode">Item Code</label>
                <input type="text" class="form-control" name="loadCode" id="smartCode" placeholder="sample123" value='<?= $it->item_id ?>' readonly>
            </div>
            <div class="col">
                 <label for="itemname">Item Name</label>
                <input type="text" class="form-control" name="loadName" id="smartName" placeholder="sample123" value='<?= $it->item_name ?>' readonly>
            </div>
                
            
        </div>
        <div class="row">
            <div class='col'>
            <label for="itemname">Stock</label>
            <input type="text" class="form-control" name="loadStock" id="smartStock" placeholder="sample123" value='<?= $it->item_quantity ?>' readonly>
            </div>
        <div class="col">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="loadPrice" id="smartPrice" placeholder="sample123" value='<?= number_format($it->item_price, 2, '.', ',') ?>' readonly>
        </div>
        </div>
        <?php endforeach; ?>
        <div class="form-group">
            <label for="quantity">Actual Quantity</label>
            <input type="number" class="form-control" name="loadActual" id="loadActual" placeholder="00" value='' step="0.01">
        </div>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="loadQuantity" id="smartQuantity" placeholder="00" value='' onkeyup="smartLoad()">
        </div>
        <hr>
        <div class="col">
            <label for="amount">Payment Amount</label>
            <input type="number" class="form-control" name="loadAmount" id="smartAmount" placeholder="00" value="" step="0.01"  onkeyup="smartDisplay()">
        </div>
        <div class="row">
            <div class="col">
            <label for="total">Total Amount</label>
            <input type="number" class="form-control" name="loadTotal" id="smartTotal" readonly>
            </div>
        </div>
            <div class="form-group">
              <label for="sel1">Members:</label>
              <select class="form-control" id="smartMember" name="loadMember">
                                <?php foreach($members as $row) : ?>
                  <option value="<?= $row->member_id ?>"><?= $row->member_last ?>, <?= $row->member_first ?></option>
                              <?php endforeach; ?>
              </select>
        </div>
        <div class="form-group">
              <label for="sel1">Payment Type</label>
              <select class="form-control" id="smartPayment" name="loadType">
                  <option value="cash">Cash</option>
                  <option value="credit">Credit</option>
              </select>
        </div>
        <div class="form-group">
            <label for="updateTotal">Change</label>
            <input type="text" class="form-control" name="updateSmartTotal" id="updateSmartTotal" readonly>
        </div>
        
</form>
        
      <div class="modal-footer">
      <button type="submit" class="btn btn-success">Load</button>
          </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
</div>
  </div>
</div>

</div>
</div>
<!-- MODAL FOR STAMPING -->
<div class="container">

    <div id="stamp" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Stamp Inventory</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p><div class="container">
    You are about to stamp the ending inventory. <h2>Only do this at the end of the month!</h2><br />
    This would mark the ending inventory for <b><?= date("F", mktime(0, 0, 0, substr((date("yy-m")), -2)+0, 10)); ?></b> in the inventory
      </div>
      <div class="modal-footer">
          <form action="stamp" id="" method="post">
         <button type="submit" class="btn btn-warning">Stamp Inventory</button>
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
    var ordered = new Array();
    var totalCost = 0;
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
            {"data": "Price"},
            {"data": "Code"}
        ],
        "columnDefs": [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                
                
            },
            {
                
                "render": function (data, type, row) {
                    {
                    return '<input type="number" step="0.01" id="qty'+data+'" placeholder="Quantity" value="1"> <button class="btn btn-primary" id="btnBuy">Add to Cart</button>';
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
            var qty = document.getElementById("qty"+id).value;
            totalCost = Number(price*qty);
            var stock = quant-qty;
            if(member != "null"){
                if(Number(quant) < Number(qty)){
                alert("Kulang na stock ng item. Please contact admin");
            }else{
                var db = $("#cart tbody");
                db.append("<tr><td>"+itemName+"</td><td><input class='form-control' type='number' step='0.01' id='qt"+id+"' name='quantity[]' value='"+qty+"' onkeyup='totalMe("+id+", "+quant+")'></td><td><input class='form-control' type='number' step='0.01' value='"+price+"' id='price"+id+"' name='price[]' readonly='readonly'></td><td><input class='form-control' type='number' readonly='readonly' name='total[]' value='"+totalCost+"' id='"+id+"'></td><input type='hidden' name='code[]' value='"+id+"'><input type='hidden' name='member[]' value='"+member+"'><input type='hidden' name='stock[]' value='"+stock+"'><input type='hidden' name='stock[]' value='"+stock+"'><input type='hidden' name='current[]' value='"+quant+"'></tr>");
                


                
                
                total.push(price);
                sum += Number(totalCost);
            alert("Added to cart!");
                

                
                $("#cont").text("TOTAL: PHP "+sum);              
                ntf++;
            }
            }else{
                alert("No member selected");
            }
            
                
        });
        
    });


    function totalMe(data, dt){
        var val = document.getElementById("qt"+data).value;
        var tot = document.getElementById(data).value;
        var actual = dt;
        var pr = document.getElementById("price"+data).value;
        var final = Number(val*pr);
        document.getElementById(data).value = final;
        var g = Number(document.getElementById(data).value);
        

        if(val <= actual){
            if(final > tot){
            sum += Number(final-tot);
            $("#cont").text("TOTAL: PHP "+sum); 
            document.getElementById("purchase").disabled = false;    
        }else{
            sum -= Number(tot-final);
            $("#cont").text("TOTAL: PHP "+sum); 
            document.getElementById("purchase").disabled = false;
        }
        }else{
            alert("Kulang na stock sa inventory");
            if(final > tot){
            sum += Number(final-tot);
            $("#cont").text("TOTAL: PHP "+sum); 
            document.getElementById("purchase").disabled = true;    
            }else{
                sum -= Number(tot-final);
                $("#cont").text("TOTAL: PHP "+sum); 
                document.getElementById("purchase").disabled = true;
            }
        }
        
        
        


        
    }
    function check(data){
    var ck = document.getElementById("qt"+data).value;
    alert(ck);
    }
    $(document).ready(function() {
        
        setInterval(function(){
            $("#notif").text(ntf);
        }, 500);
            

            });

</script>


<?= $this->endSection() ?>
