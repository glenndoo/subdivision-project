<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<div class='container'>
  <div class='row'>
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white form-wrapper">
      <div class="container">
        <h3>Profile</h3>
        <hr>
        <?php if (session()->get('success')) : ?>
          <div class="alert alert-success" role='alert'>
            <?= session()->get('success') ?>
          </div>
        <?php endif; ?>
        <form class="" action="/Users/profile" method="post">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class='form-control' name="firstname" value="<?= $fname ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class='form-control' name="lastname" value="<?= $lname ?>">
              </div>
          </div>
          <div class="col-12">
            <div class='form-group'>
            <label for="username">Username</label>
            <input type="text" class='form-control' name="username" value="<?= $lgn ?>">
          </div>
        </div>

          <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                  <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </div>
        </form>
      </div>
      </div>
    </div>
  </div>
<?= $this->endSection() ?>
