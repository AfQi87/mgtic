<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <img src="actas/logo.png" alt="" width="150">
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