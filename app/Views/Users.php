<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>

<div class='container'>
  <div class='row'>
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white form-wrapper">
      <div class="container">
        <h3>Login</h3>
        <hr>
        <?php if (session()->get('success')) : ?>
          <div class="alert alert-success" role='alert'>
            <?= session()->get('success') ?>
              <?php endif; ?>
          </div>
        
        <form class="" action="/" method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id='username' value="<?= set_value('username') ?>">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id='password' value="">
          </div>
          <?php if(isset($validation)) : ?>
            <div class="col-12">
              <div class="alert-danger" role='alert'>
                  <?= $validation->listErrors() ?>
              </div>
            </div>
          <?php endif; ?>
          <div class="row">
            <div class="col-12 col-sm-4">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>
