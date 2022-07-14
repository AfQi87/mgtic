<!--

=========================================================
* Now UI Kit - v1.3.0
=========================================================

* Product Page: https://www.creative-tim.com/product/now-ui-kit
* Copyright 2019 Creative Tim (http://www.creative-tim.com)
* Licensed under MIT (https://github.com/creativetimofficial/now-ui-kit/blob/master/LICENSE.md)

* Designed by www.invisionapp.com Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/Logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Maestria en Gestión de Tecnologías de la Información y del Conocimiento
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->

  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="./assets/css/mdb.min.css" rel="stylesheet" />
  <link href="./assets/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />
  <link rel="stylesheet" href="./assets/css/application.css" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400&family=Open+Sans:wght@800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body class="index-page sidebar-collapse">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent " color-on-scroll="400">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="{{ route('login') }}" rel="tooltip" title="MGTIC" data-placement="bottom">
          <img class="n-logo" src="./assets/img/Logo.png" alt="" width="60px" height="30px">
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar top-bar"></span>
          <span class="navbar-toggler-bar middle-bar"></span>
          <span class="navbar-toggler-bar bottom-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollPresentation()">
              <i class="fas fa-home fa-2x"></i>
              <p>Presentación</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollProfile()">
              <i class="fas fa-users fa-2x"></i>
              <p>Perfiles</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollCurriculum()">
              <i class="fas fa-book fa-2x"></i>
              <p>Plan de Estudios</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollRequirements()">
              <i class="fas fa-clipboard-list fa-2x"></i>
              <p>Requisitos Admisión</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollRequirementsGrade() ">
              <i class="fas fa-user-graduate fa-2x"></i>
              <p>Requisitos de Grado</p>
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollTeachers()">
              <i class="fas fa-chalkboard-teacher fa-2x"></i>
              <p>Planta Docente</p>
            </a>
          </li>



          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" onclick="scrollToDownload()">
              <i class="fas fa-info-circle fa-2x"></i>
              <p>Contactos</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="wrapper">
    <div class="page-header clear-filter" filter-color="orange">
      <div class="page-header-image" data-parallax="true" style="background-image:url('./assets/img/3.jpg');">
      </div>
      <div class="container">
        <div class="content-center brand">
          <h1>Maestria en Gestión de Tecnologías de la Información y del Conocimiento</h1>
          <h4>Resolución No. 006175 de junio de 2019 del Ministerio de Educación Nacional</h4>
        </div>
      </div>
    </div>

    <!-- Sección Presentación -->
    <div class="main">
      <div class="section section-presentation" id="seccion_azul">
        <div id="seccion_azul">
          <div class="container">
            <br>
            <h1 style="text-align: justify;"> Presentación</h1>
            <!--- Divide el contenedor en filas-->
            <div class="row">

              <div class="col-md-8">
                <!-- Columna 1 Presentación-->
                <div class="row">
                  <div class="col-md-12">
                    <p style="text-align: justify;">
                      El programa de Maestría en Gestión de Tecnologías de la Información y del Conocimiento - MGTIC,
                      adscrita al Departamento de Sistemas de la Universidad de Nariño, está enfocado en la
                      profundización del conocimiento. El programa pretende formar profesionales que sean capaces de
                      analizar, diseñar, desarrollar y evaluar metodologías, estrategias, planes, programas,
                      herramientas de gestión de las Tecnologías de la Información, con fines de producción del
                      conocimiento en cualquier campo del saber, incluyendo el campo educativo o pedagógico.
                      <br>
                      La MGTIC se orientará hacia la formación de profesionales de las áreas de las ingenierías:
                      Sistemas, Civil, Electrónica y afines, pero también en una perspectiva más amplia, estará dirigida
                      a profesionales de Ciencias de la Computación y la Informática, Ciencias Económicas y
                      Administrativas, Educación y afines, que tengan sentido de pertinencia hacia la región y el país.
                    </p>
                  </div>

                  <div class="col-md-4" align="center">
                    <i class="fas fa-graduation-cap fa-5x "></i>
                    <p style="text-align: center; font-size: 0.75rem;">
                      <br> <b> Titulo:</b> <br>
                      Magíster en Gestión de Tecnologías de la Información y del Conocimiento
                    </p>
                  </div>

                  <div class="col-md-4" align="center">
                    <i class="fas fa-calendar-alt fa-5x "></i>
                    <p style="text-align: center; font-size: 0.75rem;">
                      <br> <b> Duración:</b> <br>
                      4 Semestres
                    </p>
                  </div>

                  <div class="col-md-4" align="center">
                    <i class="fas fa-hand-holding-usd fa-5x "></i>
                    <p style="text-align: center; font-size: 0.75rem;">
                      <br> <b> Valor del Semestre:</b> <br>
                      6.5 SMMLV
                    </p>
                  </div>

                  <div class="col-md-4" align="center">
                    <i class="fas fa-book-open fa-5x "></i>
                    <p style="text-align: center; font-size: 0.75rem;">
                      <br><b> Modalidad:</b> <br>
                      Presencial
                    </p>
                  </div>

                  <div class="col-md-4" align="center">
                    <i class="fas fa-clock fa-5x "></i>
                    <p style="text-align: center; font-size: 0.75rem;">
                      <br> <b> Horarios:</b> <br>
                      Viernes 6:00 p.m a 10:00 p.m y Sábados 8:00 a.m. a 12:00 m y 2:00 p.m – 6:00 p.m
                    </p>
                  </div>

                  <div class="col-md-4" align="center">
                    <i class="fas fa-file-invoice-dollar fa-5x "></i>
                    <p style="text-align: center; font-size: 0.75rem;">
                      <br><b> Valor Inscripción:</b> <br>
                      $268.600 COP
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <!-- Columna 2 Imagen-->
                <div style="text-align: center;">
                  <img src="assets/img/21.jpg" id="img_pres">
                  <br><br>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- FIN Sección PRESENTACIÓN  -->

    <!-- Sección Presentación PERFILES -->
    <div class="main">
      <div class="section section-profile" id="#profile-section">
        <!-- Sección Perfiles -->
        <div id="seccion_blanca">
          <div class="container">
            <br>
            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" href="#ex1-tabs-1" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">
                  <h5> Perfil Profesional </h5>
                </a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" href="#ex1-tabs-2" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">
                  <h5> Perfil Ocupacional </h5>
                </a>
              </li>
            </ul>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
              <!-- Perfil Profesional -->
              <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                <div class="clearfix">
                  <div class="col-md-6 float-md-end mb-3 ms-md-3">
                    <img src="assets/img/20.jpg" class="img-fluid" alt="Perfil Profesional">
                  </div>
                  <p style="text-align: justify;">
                    El profesional egresado del programa de Maestría en Gestión de Tecnologías de la Información y del
                    Conocimiento poseerá una formación de alto nivel que le permitirá enfrentar los retos actuales de
                    las necesidades de las poblaciones y los sectores socio-económicos y productivos de la región y el
                    país. Su formación, de carácter multidisciplinaria, le permitirá realizar aportes pertinentes e
                    innovadores en cada área de profundización y en una línea específica de investigación.
                    Por otra parte, como recurso humano altamente capacitado, el egresado aportará al desarrollo de las
                    regiones y a la demanda de personal calificado en cada área de profundización. El egresado del
                    programa también podrá desempeñarse en la comunidad académica como docente e investigador, e
                    incluso, habrá adquirido la formación necesaria en una línea de investigación y contará con las
                    capacidades necesarias para aspirar, si así lo desea, a un programa de formación doctoral nacional o
                    internacional.
                  </p>
                </div>
              </div>

              <!-- Perfil Ocupacional -->
              <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                <div class="clearfix">
                  <div class="col-md-6 float-md-end mb-3 ms-md-3">
                    <img src="assets/img/19.jpeg" class="img-fluid" alt="Perfil Ocupacional">
                  </div>
                  <p style="text-align: justify;">
                    El profesional egresado de la maestría estará en capacidad de: <br>
                  <ul id="listas">
                    <li style="text-align: justify;">
                      <span class="u-custom-font u-font-montserrat">Formular, evaluar, ejecutar y dirigir proyectos de
                        desarrollo tecnológico y/o innovación en distintos campos según su formación.</span>
                    </li>
                    <li style="text-align: justify;">
                      <span class="u-custom-font u-font-montserrat">Diseñar e implementar soluciones basadas en TIC, a
                        problemas en diferentes campos, según su formación.</span>
                    </li>
                    <li style="text-align: justify; ;">
                      <span class="u-custom-font u-font-montserrat">Asesorar en la aplicación de las TIC en diversos
                        campos, afines a su formación, dentro de organizaciones gubernamentales y no
                        gubernamentales.</span>
                    </li>
                    <li style="text-align: justify;">
                      <span class="u-custom-font u-font-montserrat">Dirigir centros de capacitación, productividad o
                        similares, acorde a su formación, orientados al desarrollo tecnológico e innovación de los
                        sectores productivos o de servicios</span>.
                    </li>
                  </ul>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Sección Presentación PERFILES -->

    <!-- Sección Plan de Estudios -->
    <div class="main">
      <div class="section section-curriculum" id="seccion_azul" data-background-color="black">
        <div id="seccion_azul">
          <div class="container">
            <br>
            <h1 style="text-align: center;"> Plan de Estudios</h1>
            <!--- Divide el contenedor en filas-->
            <div class="row">
              <!-- Fila 1: Plan de Estudios -->
              <div class="col-md-3">
                <!-- Semestre 1 -->
                <div class="card">
                  <img src="assets/img/26.jpg" class="card-img-top" alt=" Semestre I" />
                  <div class="card-body" id="seccion_plan">
                    <h5 class="card-title" style="text-align: center; color: black"> <b> Semestre I</b></h5>
                    <ul class="u-align-justify u-custom-font u-font-montserrat u-text u-text-black u-text-3">
                      <li> Sistemas Avanzados de Bases de Datos</li>
                      <li>Arquitecturas de Sistemas de Información</li>
                      <li>Gestión de la Seguridad Informática</li>
                      <li>Gestión del conocimiento</li>
                    </ul>
                  </div>
                </div>

              </div>

              <div class="col-md-3">
                <!-- Semestre 2 -->
                <div class="card">
                  <img src="assets/img/24.jpg" class="card-img-top" alt=" Semestre II" />
                  <div class="card-body" id="seccion_plan">
                    <h5 class="card-title" style="text-align: center; color: black;"> <b> Semestre II</b></h5>
                    <ul class="u-align-justify u-custom-font u-font-montserrat u-text u-text-black u-text-5">
                      <li>Fundamentos de Investigación</li>
                      <li>Inteligencia de Negocios</li>
                      <li>Electiva 1 TI</li>
                      <li>Electiva 1 GC</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <!-- Semestre 3 -->
                <div class="card">
                  <img src="assets/img/22.jpg" class="card-img-top" alt=" Semestre III" />
                  <div class="card-body" id="seccion_plan">
                    <h5 class="card-title" style="text-align: center; color: black"> <b> Semestre III</b></h5>
                    <ul class="u-align-justify u-custom-font u-font-montserrat u-text u-text-black u-text-5">
                      <li> Gestión de proyectos tecnológicos y de innovación</li>
                      <li>Trabajo de grado I</li>
                      <li>Electiva 2 TI</li>
                      <li>Electiva 2 GC</li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="col-md-3">
                <!-- Semestre 4 -->
                <div class="card">
                  <img src="assets/img/25.jpg" class="card-img-top" alt=" Semestre IV" />
                  <div class="card-body" id="seccion_plan">
                    <h5 class="card-title" style="text-align: center; color: black"> <b> Semestre IV</b></h5>
                    <ul class="u-align-justify u-custom-font u-font-montserrat u-text u-text-black u-text-5">
                      <li> Gestión de la Innovación Empresarial</li>
                      <li>Trabajo de grado II</li>
                      <li>Electiva 3 TI</li>
                      <li>Electiva 3 GC</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" align="center"></div>
            </div>
            <div class="row">

              <!--Fila 2: Botones-->
              <div class="col-md-6" align="center">
                <!-- Boton Plan de Estudios -->
                <a class="btn btn-primary btn-block" id="botones" href="assets/files/PlandeEstudios.pdf" target="_blank"> Descargar Plan de Estudios</a>
              </div>

              <div class="col-md-6" align="center">
                <!-- Boton Brochure -->
                <a class="btn btn-primary btn-block" id="botones" href="assets/files/BrochureMGTIC.pdf" target="_blank">
                  Descargar Brochure Programa</a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12" align="center"> <br> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Sección Plan de Estudios -->

    <!-- Sección Requisitos de Admisión -->
    <div class="main">
      <div class="section section-requirements">
        <div id="seccion_blanca">
          <div class="container">
            <br>
            <h1 style="text-align: center;"> Requisitos de Admisión</h1>
            <!--- Divide el contenedor en filas-->
            <div class="row">
              <div class="col-md-6" align="center">
                <img src="assets/img/27.jpg" class="img-fluid">
              </div>
              <div class="col-md-6" align="center">
                <p style="text-align: justify;">
                  Para formalizar el proceso de inscripción se debe entregar en las fechas establecidas, los siguientes
                  documentos:
                <ul id="listas">
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat">Formulario de inscripción debidamente
                      diligenciado</span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat">Comprobante de pago del recibo de inscripción</span>.
                  </li>
                  <li style="text-align: justify; ;">
                    <span class="u-custom-font u-font-montserrat">Fotocopia del Título Profesional (Diploma o Acta de
                      grado), expedidos por Universidad Colombiana reconocida oficialmente</span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat">Fotocopia de la cédula de ciudadanía o pasaporte
                      ampliada al 150%</span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat">Dos (2) fotografías recientes tamaño cédula fondo
                      blanco</span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat">Hoja de vida con los respectivos soportes</span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat"> Certificado de afiliación a seguridad social</span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat">Los aspirantes extranjeros deben presentar la
                      respectiva convalidación de sus estudios y la visa de residente o estudiante expedida por el
                      Ministerio de Relaciones Exteriores
                    </span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat"> Enviar en formato PDF al email: mgtic@udenar.edu.co
                    </span>.
                  </li>
                </ul>

                </p>

              </div>

              <div class="row">
                <div class="col-md-12" align="center"> <br> </div>
                <!--Fila 2: Botones-->
                <div class="col-md-6" align="center">
                  <!-- Boton Pin Vipri -->
                  <a class="btn btn-primary btn-block" id="botones" href="http://ci.udenar.edu.co/pines_vipri/" target="_blank"> Iniciar Proceso de Inscripción </a>
                </div>

                <div class="col-md-6" align="center">
                  <!-- Boton Video Tutorial -->
                  <button class="btn btn-primary btn-block" id="botones" data-toggle="modal" data-target="#myModal">
                    Ver Tutorial de Inscripción
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12" align="center"> <br> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Sección Requisitos de Admisión -->

    <!-- Sección Requisitos de Grado -->
    <div class="main">
      <div class="section section-requirements-grade">
        <div id="seccion_azul">
          <div class="container">
            <br>
            <h1 style="text-align: center;"> Requisitos de Grado</h1>
            <!--- Divide el contenedor en filas-->
            <div class="row">
              <div class="col-md-6" align="center">
                <img src="assets/img/18.jpg" class="img-fluid">
              </div>
              <div class="col-md-6" align="center">
                <p style="text-align: justify;">
                <ul id="listas">
                  <li style="text-align: justify; ;">
                    <span class="u-custom-font u-font-montserrat"> Cumplir y aprobar con el 100% de créditos académicos
                      del programa de posgrado</span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat">La Maestría en Gestión de Tecnologías de la
                      Información y del Conocimiento, es de Profundización,
                      por lo tanto se presenta Trabajo de Grado en las áreas de formación establecidas integrando los
                      temas de los cursos obligatorios y los cursos electivos. Los trabajos de grado serán
                      preferiblemente de carácter individual.</span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat">El plazo máximo para sustentación del trabajo de grado
                      de la maestría es dos años a partir de la culminación del plan de estudios. Superado el plazo
                      establecido, el estudiante egresado perderá definitivamente el derecho a optar al título y así
                      constará en su hoja de vida académica</span>.
                  </li>
                  <li style="text-align: justify;">
                    <span class="u-custom-font u-font-montserrat">Contar un certificado de nivel de inglés B1 acorde a
                      la clasificación establecida por el Marco Común Europeo de Referencia (MCER)</span>.
                  </li>


                </ul>
                </p>
              </div>
              <div class="row">
                <div class="col-md-12" align="center"> <br> <br></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Sección Requisitos de Grado-->

    <!--- Seccion Planta Coordinador-->

    <div class="main">
      <div class="section section-teachers" id="seccion_blanca">
        <!-- Fila 1: Planta Docente -->
        <div class="container">
          <h1 style="text-align: center;"> Planta Docente</h1>
          <div class="row">
            <!-- Fila 1: Coordinador -->
            <div class="col-md-12">
              <div class="carousel slide">
                <div class="carousel-inner" id="seccion_naranja">
                  <div class="row">
                    <div class="col-md-2" align="center"> </div>
                    <div class="col-md-4" align="center">
                      <div class="card">
                        <div>
                          <img src="assets/img/28.jpg" class="img-fluid">
                        </div>
                        <div class="card-body">
                          <a href="https://scienti.minciencias.gov.co/cvlac/visualizador/generarCurriculoCv.do?cod_rh=0000250988" a class="btn btn-primary btn-block" id="botones" target="_blank">Ver CVLAC</a>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-5" align="center">
                      <br>
                      <h3><B> PhD. Ricardo Timarán Pereira</B> </h3>
                      <h5> <b> Coordinador del programa </b> </h5> <BR>
                      <p style="text-align: justify;">
                        Ingeniero de Sistemas y Master Of Science en Ingeniería de la Universidad Politécnica De
                        Donetsk, Especialista en Multimedia Educativa de la Universidad Antonio Nariño y Doctor en
                        Ingeniería de la Universidad del Valle. Coordinador de la Maestría en Gestión TIC y director del
                        Grupo de Investigación GRIAS.
                      </p> <BR>

                      <p style="text-align: justify;">
                        <b> <i class="fas fa-envelope"></i> Correo: ​​ritimar@udenar.edu.co </b> <br>
                        <b> <i class="fas fa-phone"></i> Teléfono: (​​+57) 304 4709512</b>
                      </p>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
        <!--- Seccion Planta Docente-->
        <div class="container">
          <!--- Divide el contenedor en filas-->
          <div class="row" >
            <!-- Fila 1: Planta Docente -->
            <div class="col-md-12">
              <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel">
                <div class="carousel-inner" id="seccion_azul" style="height: 800px">
                  @foreach($docentes as $docente)
                  @if ($docente->ced_persona == '12967500')
                  @else
                  <div class="carousel-item {{ $i == 1 ? ' active' : '' }} " data-mdb-interval="3000">
                    <div class="row">
                      <div class="col-md-2" align="center"> </div>
                      <div class="col-md-4" align="center">
                        <div class="card">
                          <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                            <img src="{{$docente->personas->foto != null || $docente->personas->foto != '' ? 'images/docentes'.$docente->personas->foto : 'avatar/avatar.png' }}" class="img-fluid mt-2" style="height: 500px; width: 400px">
                          </div>
                          <div class="card-body">
                            <a href="{{$docente->cvlac}}" a class="btn btn-primary btn-block" id="botones" target="_blank">Ver CVLAC</a>
                          </div>
                        </div>

                      </div>
                      <div class="col-md-5" align="center">
                        <br>
                        <h3><B> {{$docente->personas->nom_persona}}</B> </h3>
                        <h4> Docente </h4> <BR>
                        <p style="text-align: justify; overflow: auto; height: 400px">
                          {{$docente->descripcion}}
                        </p> <BR>
                        <p style="text-align: justify;">
                          <b> <i class="fas fa-laptop"></i> Áreas de conocimiento: </b> Seguridad de la Información <br>
                          <b> <i class="fas fa-envelope"></i> Correo: </b> {{$docente->personas->email_persona}} <br>
                          <b> <i class="fas fa-phone"></i> Teléfono: {{$docente->personas->tel_persona}} - {{$docente->personas->cel_persona}}</b>
                        </p>
                      </div>
                    </div>
                  </div>
                  @endif
                  <?php
                  $i++;
                  ?>
                  @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleControls" data-mdb-slide="prev">
                  <i class="fas fa-angle-left fa-2x"></i>
                </button>
                <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleControls" data-mdb-slide="next">
                  <i class="fas fa-angle-right fa-2x"></i>
                </button>
              </div>
            </div>

          </div>
        </div>
        <!--- Fin Seccion Planta Docente-->
      </div>
    </div>
    <!--- Fin Seccion Planta Coordinador-->

    <!--- SECCION  Contactos-->
    <div class="main">
      <div class="section section-download">
        <div class="container">
          <!--- Divide el contenedor en filas-->
          <div class="row">
            <!-- Fila 1: Planta Docente -->
            <div class="col-md-12">
              <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel">
                <div class="carousel-inner" id="formulario">
                  <br>
                  <h1 style="text-align: center;"> Contactos</h1>
                  <p> Deja tus datos si requieres más información del programa </p>
                  <form id="enviar">
                    @csrf
                    <div class="row">
                      <!-- Primera Fila-->
                      <div class="col-lg-1"></div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <input type="text" value="" name="nombres" id="nombres" placeholder="Nombres" class="form-control" required />
                        </div>
                      </div>

                      <div class="col-lg-5">
                        <div class="form-group">
                          <input type="text" value="" name="apellidos" id="apellidos" placeholder="Apellidos" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-lg-1"></div>

                      <!-- Fin Primera Fila-->

                      <!-- Segunda Fila-->
                      <div class="col-lg-1"></div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <input type="email" value="" name="correo" id="correo" placeholder="Correo" class="form-control" required />
                        </div>
                      </div>

                      <div class="col-lg-5">
                        <div class="form-group">
                          <input type="text" id="telefono" name="telefono" placeholder="Teléfono" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-lg-1"></div>
                      <!-- Fin Segunda Fila-->

                      <!-- Tercera Fila-->
                      <div class="col-lg-1"></div>
                      <div class="col-lg-5">
                        <div class="form-group">
                          <select id="tipo_doc" name="tipo_doc" class="form-control" required>
                            <option selected> Tipo de Documento</option>
                            <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                            <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                            <option value="NIT">NIT</option>
                            <option value="T.I.">T.I.</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-lg-5">
                        <div class="form-group">
                          <input type="text" value="" name="documento" id="documento" placeholder="Número de Documento" class="form-control" required />
                        </div>
                      </div>
                      <div class="col-lg-1"></div>
                      <!-- Fin Tercera Fila-->

                      <!-- Submit button -->
                      <div class="col-sm-12" align="center">
                        <button type="submit" class="btn btn-primary" id="botones">Enviar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--- Fin seccion  Contactos-->
  </div>
  <!--- Fin seccion WRAPPER-->
  <!-- Footer-->
  <footer class="text-center text-lg-start text-muted" id="pie">
    <!-- Section: Social media -->
    <section id="seccion_naranja" class="d-flex justify-content-center justify-content-lg-between p-2 border-bottom">
      <!-- Left -->
      <div class="me-5 d-none d-lg-block">
        <span>
          <h5> Síguenos en redes sociales </h5>
        </span>
      </div>
      <!-- Left -->

      <!-- Right -->
      <div>
        <a href="https://www.facebook.com/maestria.ticudenar.7" class="me-4 text-reset" target="_blank">
          <i class="fab fa-facebook-f fa-2x"></i>
        </a>
        <a href="https://api.whatsapp.com/send?phone=573105273727" class="me-4 text-reset" target="_blank">
          <i class="fab fa-whatsapp fa-2x"></i>
        </a>
        <a href="https://www.instagram.com/mgtic/" class="me-4 text-reset" target="_blank">
          <i class="fab fa-instagram fa-2x"></i>
        </a>
        <a href="https://www.linkedin.com/in/mgtic-udenar-91b593227/" class="me-4 text-reset" target="_blank">
          <i class="fab fa-linkedin fa-2x"></i>
        </a>

      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section id="pie">
      <div class="container text-center text-md-start mt-4">
        <!-- Grid row -->
        <div class="row mt-3">
          <!-- Grid column -->
          <div class="col-md-3">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold mb-4">
              <div class="col-md-12 float-md-end mb-3 ms-md-3">
                <img src="assets/img/Logo.png" class="img-fluid" alt="MGTIC">
                <p style="text-align: center; text-transform:NONE; color: #0d244b;">
                  Maestría en Gestión de Tecnologías de la Información y del Conocimiento
                </p>
              </div>
            </h6>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-9">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold mb-4">
              Contactos
            </h6>
            <p style="text-align: justify;"><i class="fas fa-home me-3"></i>
              Faculta​d de Ingeniería, Departamento de sistemas,
              Ciudad Universitaria Torobajo, Bloque de Ingeniería, 1er piso. </p>
            <p>
              <i class="fas fa-envelope me-3"></i>
              mgtic@udenar.edu.co
            </p>
            <p><i class="fas fa-phone me-3"></i> (+57) 304 470 9512</p>
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-2" id="pie2">
      © 2022 Copyright:
      <a class="text-reset fw-bold">MGTIC</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->

  <!-- Modal Video -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
            <i class="now-ui-icons ui-1_simple-remove"></i>
          </button>
          <h4 class="title title-up">Proceso de Inscripción </h4>
        </div>
        <div class="modal-body">
          <!-- 16:9 aspect ratio -->
          <div class="embed-responsive embed-responsive-16by9">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/pUL2wxgS-cA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--  End Modal -->

  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="./assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->

  <script src="./assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
  <script src="./assets/js/functions.js" type="text/javascript"></script>
  <script src="./assets/js/mdb.min.js" type="text/javascript"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="./js/correo.js" type="text/javascript"></script>

</body>

</html>