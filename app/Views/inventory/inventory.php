<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<script>
function solve() {
  //  var txtFirstNumberValue = document.getElementById('quantity').value;
  //  var txtSecondNumberValue = document.getElementById('price').value;
  //  var result = Number(txtFirstNumberValue) * Number(txtSecondNumberValue);
  //  if (!isNaN(result)) {
  //      document.getElementById('total').value = result;
  //  }
  document.getElementById('sellingPrice').value = document.getElementById('unitPrice').value * 1.15;
}

function check() {
  //  var txtFirstNumberValue = document.getElementById('quantity').value;
  //  var txtSecondNumberValue = document.getElementById('price').value;
  //  var result = Number(txtFirstNumberValue) * Number(txtSecondNumberValue);
  //  if (!isNaN(result)) {
  //      document.getElementById('total').value = result;
  //  }
  document.getElementById('updateSell').value = document.getElementById('updateUnit').value * 1.15;
} 
</script>
<!--this alert-->
<?php if(session()->get('success')) : ?>
	<!--<div class="alert alert-success" role="alert">
		Item saved!
	</div>-->
    <div style="width: 40%; right:0rem;"class="myAlert-top alert alert-success fixed-bottom">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Item saved!</strong>
    </div>
	<?php elseif (session()->get('remove')): ?>
  <!--
	<div class="alert alert-danger" role="alert">
		Item removed!
	</div>-->
    <div style="width: 40%; right:0rem;"class="myAlert-top alert alert-dark fixed-bottom">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Item removed!</strong>
    </div>
<?php else : ?>
<?php endif; ?>



<!--end alert-->
<br/>
<div class="container-fluid">
  <div class="row">
		<div class="col-sm-12">  
			<table id="samples" class="table bg-light">
			  	<thead class="thead-dark">
				    <tr>
						<th>Item Code</th>
						<th>Item Name</th>
						<th>Category</th>
						<th>Quantity</th>
						<th>Selling Price</th>
						<th>Unit Price</th>
						<th>Added By</th>
						<th>
							<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Add Item</button>
							<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myMember">Add New Member</button>
				      	</th>
				    </tr>
			  	</thead>
			</table>
		</div>
	</div>
</div>


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
	    	<label for="itemCode">Item Code</label>
	    	<input type="text" class="form-control" name="itemcode"id="itemcode" placeholder="Use Barcode Scanner">
	  	</div>
	    <div class="form-group">
	    	<label for="itemname">Item Name</label>
	    	<input type="text" class="form-control" name="itemname"id="itemname" placeholder="Sprite">
	  	</div>
	    <div class="form-group">
	    	<label for="quantity">Quantity</label>
	    	<input type="number" step="0.01" class="form-control" name="quantity" id="quantity" placeholder="Number only">
	  	</div>
		<div class="form-group">
			<label for="price">Unit Price</label>
			<input type="number" step="0.01" class="form-control" name="unitPrice" id="unitPrice" placeholder="Number only" onkeyup="solve()">
		</div>
		<div class="form-group">
			<label for="price">Selling Price</label>
			<input type="number" step="0.01" class="form-control" name="sellingPrice" id="sellingPrice" placeholder="Number only">
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
    <input type="text" class="form-control" name="itemcodeupdate" id="itemcodeupdate" placeholder="sample123">
  </div>
    <div class="form-group">
    <label for="itemname">Item Name</label>
    <input type="text" class="form-control" name="itemnameupdate" id="itemnameupdate" placeholder="Sprite">
  </div>
  <div class="form-group">
    <label for="price">Unit Price</label>
    <input type="number" step="0.01" class="form-control" name="updateUnit" id="updateUnit" placeholder="Number only" onkeyup="check()">
  </div>
  <div class="form-group">
    <label for="price">Selling Price</label>
    <input type="number" step="0.01" class="form-control" name="updateSell" id="updateSell" placeholder="Number only">
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
		<p>
		<div class="container">
		This action cannot be undone
			<?php if(isset($validation)) : ?>
		    <div class="col-12">
		      	<div class="alert-danger" role='alert'>
		        <?= $validation->listErrors() ?>
		      	</div>
		    </div>
		  	<?php endif; ?>
		</p>
		</div>
      	<div class="modal-footer">
          	<form action="" id="removeAction" method="post">
         		<button type="submit" class="btn btn-danger">Remove Item</button>
          	</form>
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">
        		Close
        	</button>
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
    <input type="text" class="form-control" name="replenishName" id="replenishName" placeholder="Sprite" readonly="readonly">
  </div>

  <div class="form-group">
        <label for="quantity">Current Quantity</label>
        <input type="number" class="form-control" name="replenishCount" step="0.01" id="replenishCount" readonly="readonly">
    <label for="quantity">Quantity</label>
    <input type="number" step="0.01" class="form-control" name="replenishQty" id="replenishQty" value="0" placeholder="Number only">
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

<!--MODAL FOR ADD NEW MEMBER-->
<div class="container">
    <div id="myMember" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Add New Member</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <p><div class="container">

    <form method="post" action="<?= base_url() ?>/addMember">
    <div class="form-group">
    <label for="itemCode">Last Name</label>
    <input type="text" class="form-control" name="memLast"id="itemcode" placeholder="Last Name">
  </div>
    <div class="form-group">
    <label for="itemname">First Name</label>
    <input type="text" class="form-control" name="memFirst"id="itemname" placeholder="First Name">
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
          <button type="submit" class="btn btn-success">Add New Member</button>
          </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
            {"data" : "id"},
            {"data": "Name"},
            {"data": "Category"},
            {"data": "Quantity"},
            {"data": "Price"},
            {"data": "Old"},
            {"data": "Username"}
        ],
        "columnDefs": [
           
            {
                "render": function () {
                    {
                    return '<button class="btn btn-primary" id="btnEdit" data-toggle="modal" data-target="#update">Edit</button> <button class="btn btn-warning" data-toggle="modal" data-target="#replenish" id="btnReplenish">Replenish</button> <button class="btn btn-danger" data-toggle="modal" data-target="#remove" id="btnRemove">Remove</button>';
                    }
                },
                "targets": 7
            },
            {
                "render": function (data, type, row) {
                    {
                    return 'Php '+data;
                    }
                },
                "targets": 4
            },
            {
                "render": function (data, type, row) {
                    {
                    return 'Php '+data;
                    }
                },
                "targets": 5
            }
        ],
        "order" : [[1, "asc"]],
        

        
        } );
        
        $('#samples tbody').on('click', '[id*=btnEdit]', function () {
            var data = table.row($(this).parents('tr')).data();
            var id = data["id"];
            var name = data["Name"];
            var price = data["Old"];
            var sell = data['Price'];
            document.getElementById("itemcodeupdate").value = id;
            document.getElementById("itemnameupdate").value = name;
            document.getElementById("updateUnit").value = price;
            document.getElementById("updateSell").value = sell;
            document.getElementById("updateAction").action = "<?=base_url()?>/updateItem?id="+id;
        });
        
        $('#samples tbody').on('click', '[id*=btnRemove]', function () {
            var data = table.row($(this).parents('tr')).data();
            var id = data["id"];
            document.getElementById("removeAction").action = "<?=base_url()?>/removeItem?id="+id;
        });

        $('#samples tbody').on('click', '[id*=btnReplenish]', function () {
          var data = table.row($(this).parents('tr')).data();
            var id = data["id"];
            var name = data["Name"];
            var qty = data["Quantity"];
            document.getElementById("replenishItem").value = id;
            document.getElementById("replenishName").value = name;
            document.getElementById("replenishCount").value = qty;
            document.getElementById("replenishAction").action = "<?=base_url()?>/replenishItem?id="+id;
        });
    });

          (function() {
          var textField = document.getElementById('itemcode');
          var updateField = document.getElementById('itemcodeupdate');

          if(textField||updateField) {
              textField.addEventListener('keydown', function(mozEvent) {
                  var event = window.event || mozEvent;
                  if(event.keyCode === 13) {
                      event.preventDefault();
                  }
              });
              updateField.addEventListener('keydown', function(mozEvent) {
                  var event = window.event || mozEvent;
                  if(event.keyCode === 13) {
                      event.preventDefault();
                  }
              });
          }
      })

();
</script>

<?= $this->endSection() ?>
