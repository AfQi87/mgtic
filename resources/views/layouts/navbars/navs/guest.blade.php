<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <div style="background-color: rgb(255, 255, 255);padding: 5px">
        <img src="actas/logo.png" alt="" width="80">
      </div>
      <div class="row">
        <div class="col-sm-5">
          <img src="actas/logo_udenar.png" alt="" width="100" style="margin-left: 50px">
        </div>
        <div class="col-sm-7 mt-2">
          <span>Universidad de Nariño <br>
            Facultad de Ingeniería <br>
            DEPARTAMENTO DE SISTEMAS </span>
        </div>
      </div>
    </div>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
        <li class="nav-item ">
          <a href="{{ route('profile.edit') }}" class="nav-link">
            <i class="material-icons">face</i> {{ __('Profile') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
  
</nav>
<!-- End Navbar -->