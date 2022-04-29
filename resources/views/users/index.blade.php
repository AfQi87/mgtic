<<!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/material-dashboard-laravel" />


    <!--  Social tags      -->
    <meta name="keywords" content="creative tim, html dashboard, laravel, html css dashboard laravel, web dashboard, bootstrap 4 dashboard laravel, bootstrap 4, css3 dashboard, bootstrap 4 admin laravel, material ui dashboard bootstrap 4 laravel, frontend, responsive bootstrap 4 dashboard, material design, material laravel bootstrap 4 dashboard">
    <meta name="description" content="Material Dashboard Laravel is a Free Material Bootstrap Admin Preset for Laravel with a fresh, new design inspired by Google's Material Design.">


    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="Material Dashboard Laravel by Creative Tim">
    <meta itemprop="description" content="Material Dashboard Laravel is a Free Material Bootstrap Admin Preset for Laravel with a fresh, new design inspired by Google's Material Design.">

    <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/154/opt_md_laravel_thumbnail.jpg">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@creativetim">
    <meta name="twitter:title" content="Material Dashboard Laravel by Creative Tim">

    <meta name="twitter:description" content="Material Dashboard Laravel is a Free Material Bootstrap Admin Preset for Laravel with a fresh, new design inspired by Google's Material Design.">
    <meta name="twitter:creator" content="@creativetim">
    <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/154/opt_md_laravel_thumbnail.jpg">


    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="Material Dashboard Laravel by Creative Tim" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://material-dashboard-laravel.creative-tim.com/" />
    <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/154/opt_md_laravel_thumbnail.jpg" />
    <meta property="og:description" content="Material Dashboard Laravel is a Free Material Bootstrap Admin Preset for Laravel with a fresh, new design inspired by Google's Material Design." />
    <meta property="og:site_name" content="Creative Tim" />

    <title>{{ __('MGTIC') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="actas/logo.png">
    <link rel="icon" type="image/png" href="actas/logo.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <!-- CSS Files -->
    <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.3" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <!-- <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" /> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  </head>

  <body class="clickup-chrome-ext_installed">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
    <div class="wrapper ">
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
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">
                <i class="material-icons">dashboard</i>
                <p>{{ __('Dashboard') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
                <p>{{ __('Usuarios') }}
                  <b class="caret"></b>
                </p>
              </a>
              <div class="collapse show" id="laravelExample">
                <ul class="nav">
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                      <span class="sidebar-mini"> PU </span>
                      <span class="sidebar-normal">{{ __('User profile') }} </span>
                    </a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="{{ route('user.index') }}">
                      <span class="sidebar-mini"> LU </span>
                      <span class="sidebar-normal"> {{ __('User Management') }} </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{ route('table') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Table List') }}</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('actas') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Actas') }}</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{ route('docentes') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Docentes') }}</p>
              </a>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link" href="{{ route('egresadosIndex') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Egresados') }}</p>
              </a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{ route('cortesIndex') }}">
                <i class="material-icons">content_paste</i>
                <p>{{ __('Cortes') }}</p>
              </a>
            </li> --}}
          </ul>
        </div>
      </div>
      <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <a class="navbar-brand" href="#">
                <img src="/actas/logo.png" alt="" width="80">
              </a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">

              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
              <span class="navbar-toggler-icon icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end">

              <ul class="navbar-nav">
                <div>{{ Auth::user()->name }}</div>
                <li class="nav-item dropdown">
                  <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="material-icons">person</i>
                    <p class="d-lg-none d-md-block">
                      Account
                    </p>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesión</a>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>

        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title ">Usuarios</h4>
                    <p class="card-category"> Usuarios registrados </p>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12 text-right">
                        <button type="button" id="btnreguser" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ModalUsuario">
                          Registrar
                        </button>
                      </div>
                    </div>
                    <!-- Modal Registro-->
                    <div class="modal fade" id="ModalUsuario" tabindex="-1" aria-labelledby="ModalUsuarioLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="container">

                              <div class="row">
                                <div class="col-md-12">
                                  <form id="formreguser" class="form-horizontal">
                                    @csrf
                                    <div class="card ">
                                      <div class="card-header card-header-primary">
                                        <h4 class="card-title">Agregar Usuario</h4>
                                      </div>
                                      <div class="card-body ">
                                        <div class="row">
                                          <div class="col-sm-8">
                                            <div class="mb-3">
                                              <label for="name" class="form-label">Nombre</label>
                                              <input type="text" class="form-control" id="name" name="name" value="user1">
                                            </div>
                                            <div class="mb-3">
                                              <label for="email" class="form-label">correo</label>
                                              <input type="email" class="form-control" id="email" name="email" value="user1@gmail.com" aria-describedby="correoHelp">
                                              <div id="correoHelp" class="form-text">El correo no puede estar repetido</div>
                                            </div>
                                            <div class="mb-3">
                                              <label for="telefono" class="form-label">Teléfono</label>
                                              <input type="number" class="form-control" id="telefono" name="telefono" value="111111">
                                            </div>
                                            <div class="mb-3">
                                              <label for="password" class="form-label">Contraseña</label>
                                              <input type="password" class="form-control" id="password" name="password">
                                            </div>
                                            <div class="row">
                                              <div class="col-sm-6">
                                                <div class="mb-3">
                                                  <label class="form-label" for="cargo_id">Cargo</label>
                                                  <select class="form-select" id="cargo_id" name="cargo_id" required>
                                                    <option value="">Selecione un cargo</option>
                                                  </select>
                                                </div>
                                              </div>
                                              <div class="col-sm-6">
                                                <div class="mb-3">
                                                  <label class="form-label" for="rol_id">Rol</label>
                                                  <select class="form-select" id="rol_id" name="rol_id" required>
                                                    <option value="">Selecione un rol</option>
                                                  </select>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-sm-4">
                                            <div class="rounded img-responsive" style="max-width: 300px">
                                              <img id="imagenSeleccionada" src="avatar/avatar.png"  style="max-width: 300px">
                                            </div>
                                            <div class="mb-3" >
                                              <label for="foto" class="form-label">Imagen</label>
                                              <input type="file" class="form-control" id="foto" name="foto">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Actualizar Usuario  -->
                    <div class="modal fade" id="ModalUsuarioAct" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="container">

                              <div class="row">
                                <div class="col-md-12">
                                  <form id="formActUsuario" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card ">
                                      <div class="card-header card-header-primary">
                                        <h4 class="card-title">Agregar Usuario</h4>
                                      </div>
                                      <div class="card-body ">
                                        <div class="row">
                                          <div class="col-sm-8">
                                            <div class="mb-3">
                                              <label for="id_user_d" class="form-label">ID</label>
                                              <input type="hidden" class="form-control" id="id_user" name="id_user">
                                              <input type="text" class="form-control" id="id_user_d" name="id_user_d" disabled>
                                            </div>
                                            <div class="mb-3">
                                              <label for="name" class="form-label">Nombre</label>
                                              <input type="text" class="form-control" id="name_act" name="name_act" value="user1">
                                            </div>
                                            <div class="mb-3">
                                              <label for="telefono_act" class="form-label">Teléfono</label>
                                              <input type="number" class="form-control" id="telefono_act" name="telefono_act" value="111111">
                                            </div>
                                            <div class="mb-3">
                                              <label class="form-label" for="cargo_id_act">Cargo</label>
                                              <select class="form-select" id="cargo_id_act" name="cargo_id_act" required>
                                                <option value="">Selecione un cargo</option>
                                              </select>
                                            </div>
                                            <div class="mb-3">
                                              <label class="form-label" for="rol_id_act">Rol</label>
                                              <select class="form-select" id="rol_id_act" name="rol_id_act" required>
                                                <option value="">Selecione un rol</option>
                                              </select>
                                            </div>
                                          </div>
                                          <div class="col-sm-4">
                                            <div class="mb-3 fotoact" id="fotoact">
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table class="table" id="datatable_user">
                        <thead class="text-primary text-center">
                          <tr>
                            <th>{{ __('id')}}</th>
                            <th>{{ __('Name')}}</th>
                            <th>{{ __('Email')}}</th>
                            <th>{{ __('Phone')}}</th>
                            <th>{{ __('Image')}}</th>
                            <th>{{ __('Cargo')}}</th>
                            <th>{{ __('Rol')}}</th>
                            <th>{{ __('Estado')}}</th>
                            <th>{{ __('Actions')}}</th>
                          </tr>
                        </thead>
                        <tfoot class="text-primary text-center">
                          <tr>
                            <th>{{ __('id')}}</th>
                            <th>{{ __('Name')}}</th>
                            <th>{{ __('Email')}}</th>
                            <th>{{ __('Phone')}}</th>
                            <th>{{ __('Image')}}</th>
                            <th>{{ __('Cargo')}}</th>
                            <th>{{ __('Rol')}}</th>
                            <th>{{ __('Estado')}}</th>
                            <th>{{ __('Actions')}}</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer style="position: absolute;bottom: 65px;width: 100%;height: 40px;">
      <section class="">
        <!-- Footer -->
        <footer class="text-center text-white" style="background: linear-gradient(to right, #30b6d3, #5ca139, #f78c41);">
          <!-- Grid container -->
          <div class="container p-4 pb-0">
            <!-- Section: CTA -->
            <section class="">
              <p class="d-flex justify-content-center align-items-center">
                <span class="me-3">MGTIC - Universidad de Nariño</span>
              </p>
            </section>
            <!-- Section: CTA -->
          </div>
          <!-- Grid container -->

          <!-- Copyright -->
          <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-white" href="https://www.udenar.edu.co/">Universidad de Nariño</a>
          </div>
          <!-- Copyright -->
        </footer>
        <!-- Footer -->
      </section>
    </footer>


    <!--   Core JS Files   -->
    <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
    <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
    <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('material') }}/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="{{ asset('material') }}/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'"></script>
    <!-- Chartist JS -->
    <script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('material') }}/demo/demo.js"></script>
    <script src="{{ asset('material') }}/js/settings.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script><!-- Google Tag Manager -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="{{ url('/js/usuarios.js')}}"></script>
    <script type="text/javascript" src="{{ url('/js/funciones.js')}}"></script>
    <script type="text/javascript" src="{{ url('/js/cortes.js')}}"></script>

    @stack('js')
  </body>

  </html>