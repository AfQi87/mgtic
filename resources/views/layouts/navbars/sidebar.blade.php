<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <p class="simple-text logo-normal">Admin</p>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <p>{{ __('Usuarios') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('Lista Usuarios') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
          <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'actas' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('actas') }}">
          <i class="material-icons">content_paste</i>
          <p>{{ __('Actas') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'docentes' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('docentes') }}">
          <i class="material-icons">content_paste</i>
          <p>{{ __('Docentes') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'egresados' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('egresadosIndex') }}">
          <i class="material-icons">content_paste</i>
          <p>{{ __('Egresados') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'cortes' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('cortesIndex') }}">
          <i class="material-icons">content_paste</i>
          <p>{{ __('Cortes') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>