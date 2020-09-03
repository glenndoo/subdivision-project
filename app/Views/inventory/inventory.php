<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>


            <?php if(session()->get('success')) : ?>
              <div class="alert alert-success" role="alert">
                    Item saved!
              <?php elseif (session()->get('remove')): ?>
                <div class="alert alert-danger" role="alert">
                    Item removed!
               <?php else : ?>
            <?php endif; ?>
</div>
                    
<table id="samples" class="table bg-light">
    <div class="float-xl-right mt-1 ml-1 mb-1">
                                  <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Add Item</button>
                    </div>
  <thead class="thead-dark">
    <tr>
      <th>Item Code</th>
      <th>Item Name</th>
      <th>Category</th>
      <th>Quantity</th>
      <th>Price</th>
      <th>Added By</th>
      <th>Options</th>
    </tr>
  </thead>

</table>





<!--MODAL FOR ADD ITEM-->
<div class="container">
    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Add Item</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p><div class="container">

    <form method="post" action="<?= base_url() ?>/addItem">
  <div class="form-group">
    <label for="itemcode">Item Code</label>
    <input type="text" class="form-control" name="itemcode" id="itemcode" placeholder="sample123" value=''>
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
    <input type="number" step="0.01" class="form-control" name="quantity" id="quantity" placeholder="Number only">
  </div>
        <div class="form-group">
    <label for="price">Price</label>
    <input type="number" step="0.01" class="form-control" name="price" id="quantity" placeholder="Number only">
  </div>
    

    <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                  <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?></p>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-success">Add Item</button>
          </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>
</div>

<!--MODAL FOR UPDATE ITEM-->
<div class="container">

    <div id="update" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Update Item</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p><div class="container">

    <form method="post" id="updateAction" action="">
  <div class="form-group">
    <label for="itemcode">Item Code</label>
    <input type="text" class="form-control" name="itemcodeupdate" id="itemcodeupdate" placeholder="sample123" value='' disabled="true">
  </div>
    <div class="form-group">
    <label for="itemname">Item Name</label>
    <input type="text" class="form-control" name="itemnameupdate" id="itemnameupdate" placeholder="Sprite">
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
    <label for="price">Price</label>
    <input type="number" step="0.01" class="form-control" name="updatedprice" id="updatedprice" placeholder="Number only">
  </div>
    

    <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                  <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?></p>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update Item</button>
          </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>
</div>

<!--MODAL FOR REMOVING-->
<div class="container">

    <div id="remove" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Remove Item</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
        <p><div class="container">
    This action cannot be undone
    <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                  <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?></p>
      </div>
      <div class="modal-footer">
          <form action="" id="removeAction" method="post">
         <button type="submit" class="btn btn-danger">Remove Item</button>
          </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</div>
</div>

<!--MODAL FOR REPLENISHING-->
<div class="container">

    <div id="replenish" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Replenish Item</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p><div class="container">

    <form method="post" id="replenishAction" action="">
  <div class="form-group">
    <label for="itemcode">Item Code</label>
    <input type="text" class="form-control" name="replenishItem" id="replenishItem" placeholder="sample123" value='' readonly="readonly">
  </div>
  <div class="form-group">
    <label for="itemname">Item Name</label>
    <input type="text" class="form-control" name="replenishName" id="replenishName" placeholder="Sprite">
  </div>

  <div class="form-group">
        <label for="quantity">Current Quantity</label>
        <input type="number" class="form-control" name="replenishCount" id="replenishCount" readonly="readonly">
    <label for="quantity">Quantity</label>
    <input type="number" step="0.01" class="form-control" name="replenishQty" id="replenishQty" placeholder="Number only">
  </div>
    

    <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                  <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?></p>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-success">Replenish Item</button>
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
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>

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
            {"data": "Category"},
            {"data": "Quantity"},
            {"data": "Price"},
            {"data": "Username"}
        ],
        "columnDefs": [
           
            {
                "render": function () {
                    {
                    return '<button class="btn btn-primary" id="btnEdit" data-toggle="modal" data-target="#update">Edit</button> <button class="btn btn-warning" data-toggle="modal" data-target="#replenish" id="btnReplenish">Replenish</button> <button class="btn btn-danger" data-toggle="modal" data-target="#remove" id="btnRemove">Remove</button>';
                    }
                },
                "targets": 6
            },
            {
                "render": function (data, type, row) {
                    {
                    return 'Php '+data;
                    }
                },
                "targets": 4
            }
        ],
        "order" : [[1, "asc"]],
        
        buttons: [
            {
                text: 'Add Item',
                action: function ( e, dt, node, config ) {
            alert("HELLO");
                }
            }
        ]
        
        } );
        
        $('#samples tbody').on('click', '[id*=btnEdit]', function () {
            var data = table.row($(this).parents('tr')).data();
            var id = data["Code"];
            var name = data["Name"];
            var price = data["Price"];
            document.getElementById("itemcodeupdate").value = id;
            document.getElementById("itemnameupdate").value = name;
            document.getElementById("updatedprice").value = price;
            document.getElementById("updateAction").action = "<?=base_url()?>/updateItem?id="+id;
        });
        
        $('#samples tbody').on('click', '[id*=btnRemove]', function () {
            var data = table.row($(this).parents('tr')).data();
            var id = data["Code"];
            document.getElementById("removeAction").action = "<?=base_url()?>/removeItem?id="+id;
        });

        $('#samples tbody').on('click', '[id*=btnReplenish]', function () {
          var data = table.row($(this).parents('tr')).data();
            var id = data["Code"];
            var name = data["Name"];
            var qty = data["Quantity"];
            document.getElementById("replenishItem").value = id;
            document.getElementById("replenishName").value = name;
            document.getElementById("replenishCount").value = qty;
            document.getElementById("replenishAction").action = "<?=base_url()?>/replenishItem?id="+id;
        });
    });
</script>

<?= $this->endSection() ?>
