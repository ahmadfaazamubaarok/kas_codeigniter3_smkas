<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Kas</title>
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="icon" href="<?= base_url() ?>assets/icon/saldo.png" type="image/png">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <div class="d-flex align-items-center justify-content-center mb-4">
                  <img src="<?= base_url() ?>assets/icon/saldo.png" class="img-fluid" style="width: 100px;">
                  <div class="d-flex d-flex flex-column justify-content-center mx-3">
                    <p class="fs-6 mb-1">Login</p>
                    <h3 class="mb-0">Sistem Kas</h3>
                    <span>Berbasis Website</span>
                  </div>
                </div>
                <form action="" method="POST">
                  <div class="input-group mb-3 ">
                    <span class="input-group-text"><i class="ti ti-user"></i></span>
                    <div class="form-floating">
                      <input type="text" class="form-control" id="floatingUsername" placeholder="Username" name="username">
                      <label for="floatingUsername">Username</label>
                    </div>
                  </div>
                  <div class="input-group mb-3 ">
                    <span class="input-group-text"><i class="ti ti-key"></i></span>
                    <div class="form-floating">
                      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                      <label for="floatingPassword">Password</label>
                    </div>
                  </div>
                  <?php if ($this->session->flashdata('salah')): ?>
                    <div class="alert alert-danger border-0">
                      Username atau password tidak tepat!
                    </div>
                  <?php endif ?>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>