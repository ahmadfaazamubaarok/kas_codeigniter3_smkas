<!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header" style="background: rgba(255, 255, 255, 0.5); /* Background putih dengan transparansi 50% */
    backdrop-filter: blur(10px); /* Efek blur latar belakang */">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li>
              <span>Periode saat ini : <strong><?= $this->session->userdata('periode')->periode ?></strong></span>
              <i class="text-success ti ti-check"></i>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <span class="fs-3">
                    <?= $this->session->userdata('username') ?>
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <div class="d-flex align-items-center gap-2 dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahNama">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3"><?= $this->session->userdata('username') ?></p>
                    </div>
                    <div class="d-flex align-items-center gap-2 dropdown-item" data-bs-toggle="modal" data-bs-target="#ubahPassword">
                      <i class="ti ti-key fs-6"></i>
                      <p class="mb-0 fs-3" style="cursor: pointer;">Ubah Password</p>
                    </div>
                    <div class="w-100 px-3">
                      <button class="btn btn-outline-danger mt-2 w-100" data-bs-toggle="modal" data-bs-target="#logout">Logout</button>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <!-- Modal -->
      <div class="modal fade" id="ubahPassword" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5>Ubah Password</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="<?= site_url('auth/ubah_password') ?>" method="POST">
                <div class="input-group mb-2">
                  <span class="input-group-text"><i class="ti ti-key"></i></span>
                  <div class="form-floating">
                    <input type="password" name="password_lama" class="form-control" placeholder="Password" required>
                    <label for="floatingInputGroup1">Password lama</label>
                  </div>
                </div>
                <div class="input-group mb-2">
                  <span class="input-group-text"><i class="ti ti-key"></i></span>
                  <div class="form-floating">
                    <input type="password" name="password_baru" class="form-control" placeholder="Password" required>
                    <label for="floatingInputGroup1">Password baru</label>
                  </div>
                </div>
                <div class="input-group mb-2">
                  <span class="input-group-text"><i class="ti ti-key"></i></span>
                  <div class="form-floating">
                    <input type="password" name="konfirmasi_password_baru" class="form-control" placeholder="Password" required>
                    <label for="floatingInputGroup1">Konfirmasi password baru</label>
                  </div>
                </div>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-outline-primary">Ubah Password</button>
                </div>
              </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="ubahNama" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5>Ubah Nama</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="<?= site_url('auth/ubah_username') ?>" method="POST">
                <div class="input-group mb-2">
                  <span class="input-group-text"><i class="ti ti-user"></i></span>
                  <div class="form-floating">
                    <input type="text" name="username" class="form-control" placeholder="Password" required value="<?= $this->session->userdata('username') ?>">
                    <label for="floatingInputGroup1">Nama</label>
                  </div>
                </div>
                <div class="d-flex justify-content-center">
                  <button type="submit" class="btn btn-outline-primary">Ubah Nama</button>
                </div>
              </form>
            </div>
            <div class="modal-footer d-flex justify-content-center">
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="logout" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row text-center mb-3">
                <i class="ti ti-power" style="font-size: 10em;"></i>
              </div>
              <div class="row text-center">
                <p class="mb-0">yakin akan logout?</p>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <a href="<?= site_url('auth/logout') ?>" class="btn btn-outline-danger">Logout</a>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">