<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<div class='container'>
  <div class='row'>
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white form-wrapper">
      <div class="container card">
        <h3>Register new account</h3>
        <hr>
        <form class="" action="/Users/register" method="post">
          <div class="row">
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" class='form-control' name="firstname" value="<?= set_value('firstname') ?>">
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class='form-control' name="lastname" value="<?= set_value('lastname') ?>">
              </div>
          </div>
          <div class="col-12">
            <div class='form-group'>
            <label for="username">Username</label>
            <input type="text" class='form-control' name="username" value="<?= set_value('username') ?>">
          </div>
        </div>
      </div>
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class='form-group'>
              <label for="password">Password</label>
              <input type="password" class='form-control' name="password" value="">
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class='form-group'>
              <label for="passwordcon">Confirm Password</label>
              <input type="password" class='form-control' name="passwordcon" value="">
            </div>
          </div>
          <div class="col-12 col-sm-12">
            <div class='form-group'>
              <label for="passwordcon">Access Level</label>
              <input type="number" class='form-control' name="access" value="">
            </div>
          </div>
          </div>
          <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                  <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                  <button type="submit" class="btn btn-primary">Register</button>
              </div>
            </div>
          <div class="col-sm-12 text-right">
              <a href='/'>Already have an account</a>
          </div>
          </div>
            
        </form>
      </div>
      </div>
    </div>
  </div>
  </div>

<?= $this->endSection() ?>
