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
  </head>
  <body>
      <?php
        $uri = service('uri');
       ?>
      <?php if(session()->get('isLoggedIn') && session()->get('access') == 1) : ?>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
          <div class="container">
          <a class="navbar-brand" href="/Dashboard">Home</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        <ul class="navbar-nav">
          <li class="nav-item <?= ($uri->getSegment(1) == 'Dashboard' ? 'active' : null) ?> ">
            <a class="nav-link"  href="/Dashboard/">Dashboard</a>
          </li>
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
          <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/logout">Logout</a>
            </li>
          </ul>

        </ul>
                </div>
    </nav>
      <?php elseif(session()->get('isLoggedIn') && session()->get('access') == 2) : ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
          <div class="container">
          <a class="navbar-brand" href="/Dashboard">Home</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        <ul class="navbar-nav">
          <li class="nav-item <?= ($uri->getSegment(1) == 'Dashboard' ? 'active' : null) ?> ">
            <a class="nav-link"  href="/Dashboard">Dashboard</a>
          </li>
          </li>
          <li class="nav-item <?= ($uri->getSegment(1) == 'clerk' ? 'active' : null) ?> ">
            <a class="nav-link"  href="/clerk">Purchase</a>
          </li>
          <li class="nav-item <?= ($uri->getSegment(1) == 'clerkView' ? 'active' : null) ?> ">
            <a class="nav-link" href="/clerkView">Sales</a>
          </li>
          <li class="nav-item <?= ($uri->getSegment(1) == 'memberCredit' ? 'active' : null) ?> ">
            <a class="nav-link" href="/memberCredit">Credits</a>
          </li>
          <ul class="navbar-nav my-2 my-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="/logout">Logout</a>
            </li>
          </ul>

        </ul>
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

      <hr>
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

      
  <!-- Footer Links -->

  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">&copy; Glenn Marlo Dumaguing 2020
  </div>
  <!-- Copyright -->

<!-- Footer -->
  </body>
</html>
