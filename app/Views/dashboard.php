<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<!--
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <h1>Logged in as <i><?= session()->get('login') ?></i></h1>
    </div>
  </div>
</div>
-->
<h5>Login Summary</h5>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
       <table id="records" class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">Status</th>
          <th scope="col">Time</th>
        </tr>
      </thead>
    </table>
    </div>
  </div>
</div>


     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(function () {
        var table = $('#records').DataTable
        ({
            "ajax": {
            "url" : "<?=base_url()?>/dashboard/loginRec",
            "dataSrc" : ""
        },"responsive": true,
            "sPaginationType": "full_numbers",
        "columns": [
            {"data": "Status"},
            {"data": "Date"}
        ],
        "order": [[ 1, "desc" ]]
    });
    });
</script>
<?= $this->endSection() ?>
