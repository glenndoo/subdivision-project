<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<div class="container">
  <div class="row">
    <div class="col-12">
      <h1>Logged in as <i><?= session()->get('login') ?></i></h1>
    </div>
  </div>

</div>

<table id="records" class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Status</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
</table>

     <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
    $(function () {
        var table = $('#records').DataTable
        ({
            "ajax": {
            "url" : "http://whai.intelektbusiness.com/dashboard/loginRec",
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
