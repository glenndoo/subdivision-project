<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
      <script data-ad-client="ca-pub-6628274123122849" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>      
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>  
  <script src="https://cdn.datatables.net/plug-ins/1.10.21/api/sum().js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
  </head>
  <body>
      <?php
        $uri = service('uri');
       ?>
      <?php if(session()->get('isLoggedIn') && session()->get('access') == 1) : ?>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/Dashboard">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?= ($uri->getSegment(1) == 'Dashboard' ? 'active' : null) ?> ">
          <a class="nav-link" href="/Dashboard">Dashboard
                <span class="sr-only">(current)</span>
              </a>
        </li>
        <li class="nav-item <?= ($uri->getSegment(1) == 'inventory' ? 'active' : null) ?> ">
          <a class="nav-link" href="/inventory">Inventory</a>
        </li>
        <li class="nav-item <?= ($uri->getSegment(1) == 'inventorySummary' ? 'active' : null) ?> ">
          <a class="nav-link" href="/inventorySummary">Inventory Summary</a>
        </li>
        <li class="nav-item <?= ($uri->getSegment(1) == 'sales' ? 'active' : null) ?> ">
          <a class="nav-link" href="/sales">Sales</a>
        </li>
        <!--
        <li class="nav-item">
          <a class="nav-link" href="/logout">Logout</a>
        </li>
        -->
        <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><b><i><?= session()->get('login') ?></i></b><span class="caret"></span></a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="/logout"><center>Logout</center></a></li>
              </ul>
            </li>
      </ul>
    </div>
  </div>
</nav>
      <?php elseif(session()->get('isLoggedIn') && session()->get('access') == 2) : ?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="/Dashboard">Home</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item <?= ($uri->getSegment(1) == 'Dashboard' ? 'active' : null) ?> ">
                <a class="nav-link" href="/Dashboard">Dashboard
                      <span class="sr-only">(current)</span>
                    </a>
              </li>
              <li class="nav-item <?= ($uri->getSegment(1) == 'clerk' ? 'active' : null) ?> ">
                <a class="nav-link" href="/clerk">Purchase</a>
              </li>
              <li class="nav-item <?= ($uri->getSegment(1) == 'clerkView' ? 'active' : null) ?> ">
                <a class="nav-link" href="/clerkView">Sales</a>
              </li>
              <li class="nav-item <?= ($uri->getSegment(1) == 'memberCredit' ? 'active' : null) ?> ">
                <a class="nav-link" href="/memberCredit">Credits</a>
              </li>
              <!--
              <li class="nav-item">
                <a class="nav-link" href="/logout">Logout</a>
              </li>
              -->
              <li class="nav-item dropdown" >
                    <a href="#" class="nav-link dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="logged in as <?= session()->get('login') ?>"><b><i><?= session()->get('login') ?></i></b><span class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <li><a href="/register"><center>new account</center></a></li>
                      <li><a href="/logout"><center>Logout</center></a></li>
                    </ul>
                  </li>
            </ul>
          </div>
        </div>
      </nav>
    <?php else :?>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
          <a class="navbar-brand" href="/">Home</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          </div>
    </nav>
    <?php endif; ?>
    
<?= $this->renderSection('content') ?>

<footer class="page-footer font-small blue pt-4">

  <hr/>
<!-- Footer Links -->
  <div class="container-fluid text-center text-md-left">

  <!-- Grid row -->
    <div class="row">

    <!-- Grid column -->
      <div class="col-md-6 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase"></h5>
        <p></p>

      </div>
    <!-- Grid column -->
    </div>

  <!-- Footer Links -->

    <!-- Copyright -->
    <center>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm">&copy; 
            Glenn Marlo Dumaguing 2020<br/>
          </div>
        </div>
      </div>
    </center>
    <!-- Copyright -->
  </div>
</footer>
<!-- Footer -->
</body>
<!--css for blue search nav do not add/edit-->
<style type="text/css">
  .container {
  max-width: 960px;
}
.navbar-survival101 {
  background-color:#2B6DAD;
}
/* .navbar-survival101 .navbar-brand {
  margin-right: 2.15rem;
  padding: 3px 0 0 0;
  line-height: 36px;
} */

.navbar-survival101 .navbar-brand img {
  vertical-align: baseline;
}

.navbar-expand-lg .navbar-nav .nav-link {
  color: #fff;
}

.search-box {
  position: relative;
  height: 34px;
}
.search-box input {
  border: 0;
  border-radius: 3px !important;
  padding-right: 28px;
  font-size: 15px;
}

.search-box .input-group-btn {
  position: absolute;
  right: 0;
  top: 0;
  z-index: 999;
}

.search-box .input-group-btn button {
  background-color: transparent;
  border: 0;
  padding: 4px 8px;
  color: rgba(0,0,0,.4);
  font-size: 20px;
}

.search-box .input-group-btn button:hover,
.search-box .input-group-btn button:active,
.search-box .input-group-btn button:focus {
  color: rgba(0,0,0,.4);
}

@media (min-width: 992px) {
  .navbar-expand-lg .navbar-nav .nav-link {
    padding-right: .7rem;
    padding-left: .7rem;
  }
  
  .search-box {
    width: 300px !important;
  }
}

.caroulsel {
  width: 100%;
  overflow: hidden;
  padding: 5px 0 5px 5px;
}

.caroulsel-wrap {
  white-space: nowrap;
  font-size: 0;
}

.caroulsel-wrap a {
  display: inline-block;
  width: 134px;
  height: 92px;
  background-color: silver;
  border: #ccc 1px solid;
  margin-right: 5px;
}
.excel-btn{
  position: absolute;
}
</style>
</html>
