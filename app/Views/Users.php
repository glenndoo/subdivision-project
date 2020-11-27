<?= $this->extend('Layouts/main') ?>

<?= $this->section('content') ?>
<br/>
<div class="container animate__animated animate__fadeIn">
<div class="row">
  <div class="col-sm-12">
    <div class="card col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 mt-5 pt-3 pb-3 bg-white">
      <h5 class="card-header">Login</h5>
      <div class="card-body">
        <?php if (session()->get('success')) : ?>
          <div class="alert alert-success" role='alert'>
            <?= session()->get('success') ?>
              <?php endif; ?>
          </div>
        
        <form class="" action="/" method="post">
          <div class="form-group row">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" name="username" id='username' value="<?= set_value('username') ?>" class="form-control">
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" name="password" id='password' value="" class="form-control">
            </div>
          </div>
          <div class="row">
             <?php if(isset($validation)) : ?>
              <div class="col-sm-9">
                <div class="alert-danger  form-control" role='alert'>
                    <?= $validation->listErrors() ?>
                </div>
              </div>
            <?php endif; ?>
            <div class="col-sm-3 ml-auto">
              <button type="submit" class="form-control btn btn-primary">Login</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
  
</div>

<?= $this->endSection() ?>
