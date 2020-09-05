<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

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
    <?php foreach($info as $it) :?>
    <form method="post" action="purchase?id=<?= $it->item_id ?>">
        
        <div class="container">
        <div class="row">
            <div class="col">
                <label for="itemcode">Item Code</label>
                <input type="text" class="form-control" name="itemcode" id="itemcode" placeholder="sample123" value='<?= $it->item_id ?>' readonly>
            </div>
            <div class="col">
                 <label for="itemname">Item Name</label>
                <input type="text" class="form-control" name="itemname" id="itemname" placeholder="sample123" value='<?= $it->item_name ?>' readonly>
            </div>
                
            
        </div>
        <div class="row">
            <div class='col'>
            <label for="itemname">Stock</label>
            <input type="text" class="form-control" name="stock" id="stock" placeholder="sample123" value='<?= $it->item_quantity ?>' readonly>
            </div>
        <div class="col">
            <label for="price">Price</label>
            <input type="text" class="form-control" name="price" id="price" placeholder="sample123" value='<?= number_format($it->item_price, 2, '.', ',') ?>' readonly>
        </div>
        </div>
        <?php endforeach; ?>
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="00" value='<?= set_value('quantity') ?>' onkeyup="sum()">
        </div>
        <hr>
        <div class="row">
            <div class="col">
            <label for="total">Total Amount</label>
            <input type="number" class="form-control" name="total" id="total" readonly>
            </div>
        <div class="col">
            <label for="amount">Payment Amount</label>
            <input type="number" class="form-control" name="amount" id="amount" placeholder="00" value="<?= set_value('amount') ?>" onkeyup="display()">
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
        <button type="submit" class="btn btn-success">Place Order</button>
</form>
    <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                  <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
</div>

<?= $this->endSection() ?>

        

    <option value="nonmember">Non-member</option>
    <option value="<?= $row->member_id ?>&name=<?= $row->member_last ?>, <?= $row->member_first ?>"><?= $row->member_last ?>, <?= $row->member_first ?></option>
  </select>
