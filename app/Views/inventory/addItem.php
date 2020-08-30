<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<div class="container">
    <?php if (session()->get('success')) : ?>
          <div class="alert alert-success" role='alert'>
            <?= session()->get('success') ?>
          </div>
        <?php endif; ?>
    <form method="post" action="/inventory/inventory/addItem">
  <div class="form-group">
    <label for="itemcode">Item Code</label>
    <input type="text" class="form-control" name="itemcode" id="itemcode" placeholder="sample123" value='<?= set_value('itemcode') ?>'>
  </div>
    <div class="form-group">
    <label for="itemname">Item Name</label>
    <input type="text" class="form-control" name="itemname"id="itemname" placeholder="Sprite">
  </div>
  <div class="form-group">
    <label for="category">Category</label>
    <select class="form-control" name="category" id="category">
      <option value="1">Canned Goods, Detergent, Fabcon</option>
      <option value="2">LPG</option>
      <option value="3">Rice</option>
      <option value="4">Meat, Fish, Chicken</option>
      <option value="5">Sim Card, Load Card</option>
      <option value="6">Candy</option>
      <option value="7">Miscellaneous</option>
    </select>
  </div>
    <div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Number only">
  </div>
        <div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" name="price" id="quantity" placeholder="Number only">
  </div>
    <button type="submit" class="btn btn-success">Add Item</button>
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
