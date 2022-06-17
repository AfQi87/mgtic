<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <style>
    @page {
      margin: 0cm 0cm 0cm 0cm;
    }

    body {
      margin-top: 4cm;
      margin-left: 2cm;
      margin-right: 2cm;
      margin-bottom: 2cm;
    }

    header {
      position: fixed;
      top: 0.5cm;
      left: 2cm;
      right: 2cm;
      height: 3cm;
    }
  </style>
</head>

<body style="font-size: 12px; font-family: Arial, Helvetica, sans-serif;">
  <header>
    <div>
      <table class="table" style="border: rgb(197, 194, 194) 1px solid" align="center">
        <tbody>
          <tr>
            <td rowspan="3" style="border: rgb(197, 194, 194) 1px solid">
              <img src="../public/actas/logo.png" alt="" width="120" height="80">
            </td>
            <td class="text-center" rowspan="3" style="border:  1px solid">
              @if($asistentes != 0)
              <b>Maestría en Gestión de Tecnologías de la Información y del Conocimiento</b><br>
              <b>Departamento de Sistemas</b><br>
              <b>Universidad de Nariño</b>
              @else
              <b>Departamento de Sistemas</b><br>
              <b>Maestría en Gestión de Tecnologías de la Información y del Conocimiento</b><br>
              <b>Maestría en Ingeniería de Sistemas y Computación </b><br>
              <b>Universidad de Nariño</b>
              @endif
            </td>
            <td style="border: rgb(197, 194, 194) 1px solid"></td>
          </tr>
          <tr>
            <td style="border: rgb(197, 194, 194) 1px solid;width: 100px;" class="pagina" id="pagina"></td>
          </tr>
          <tr>
            <td style="border: rgb(197, 194, 194) 1px solid;text-align: center;">Versión: 1</td>
          </tr>
        </tbody>
      </table>
    </div>
  </header>

  <!-- Acta -->

  <div>
    <table class="table" style="border: black 1px solid" align="center">
      <tbody>
        <tr>
          <td colspan="8" class="text-center"><b>Acta No. {{ $acta->id }}</b></td>
        </tr>
        <tr>
          <td style="border: black 1px solid" class="text-center">Tipo de reunión: </td>
          <td style="border: black 1px solid" class="text-center">Ordinaria: </td>
          <td style="border: black 1px solid; width:90px" class="text-center">
            @if($acta->tipo == 1)
            X
            @endif
          </td>
          <td style="border: black 1px solid" class="text-center">Extraordinaria: </td>
          <td style="border: black 1px solid" class="text-center">
            @if($acta->tipo == 2)
            X
            @endif
          </td>
          <td style="border: black 1px solid" class="text-center">Urgente: </td>
          <td style="border: black 1px solid" colspan="2" class="text-center">
            @if($acta->tipo == 3)
            X
            @endif
          </td>
        </tr>
        <tr>
          <td style="border: black 1px solid" class="text-center">Proceso</td>
          <td colspan="3" style="border: black 1px solid" class="text-center">{{$acta->proceso}}</td>
          <td rowspan="2" style="border: black 1px solid" class="text-center">Fecha</td>
          <td style="border: black 1px solid" class="text-center">Dia</td>
          <td style="border: black 1px solid" class="text-center">Mes</td>
          <td style="border: black 1px solid" class="text-center">Año</td>
        </tr>
        <tr>
          <td style="border: black 1px solid" class="text-center">Lugar</td>
          <td colspan="3" style="border: black 1px solid" class="text-center">{{$acta->lugar}}</td>
          <td style="border: black 1px solid" class="text-center">{{$fecha->day}}</td>
          <td style="border: black 1px solid" class="text-center">{{$fecha->month}}</td>
          <td style="border: black 1px solid" class="text-center">{{$fecha->year}}</td>
        </tr>
        <tr>
          <td style="border: black 1px solid" class="text-center">Hora de inicio:</td>
          <td colspan="3" style="border: black 1px solid" class="text-center">{{$horaIni}}</td>
          <td style="border: black 1px solid" class="text-center">Hora finalización:</td>
          <td colspan="3" style="border: black 1px solid" class="text-center">{{$horaFin}}</td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Asistentes -->

  <div class="mt-3">
    <table class="table" style="border: black 1px solid" align="center">
      <thead>
        <th colspan="4" class="text-center">Asistentes</th>
      </thead>
      <tbody>
        <tr>
          <th style="border: black 1px solid" class="text-center">No.</th>
          <th style="border: black 1px solid" class="text-center">Nombre</th>
          <th style="border: black 1px solid" class="text-center">Cargo</th>
          <th style="border: black 1px solid" class="text-center">Dependencia</th>
        </tr>
        @foreach($listaAsistentes as $key => $asistente)
        <tr>
          <td style="border: black 1px solid; width:50px;" align="center">{{ $key + 1 }}</td>
          <td style="border: black 1px solid; width:270px; padding-left:10px">{{ $asistente->participantes->personas->nom_persona }}</td>
          <td style="border: black 1px solid" align="center">{{ $asistente->participantes->cargos->desc_cargo }}</td>
          <td style="border: black 1px solid; width:150px;" align="center">{{ $asistentes != 0 ? 'Comité Curricular MGTIC' : 'Comité Curricular Maestrías Departamento de Sistemas'}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Orden del dia -->

  <div class="mt-3">
    <table class="table" style="border: black 1px solid" align="center">
      <thead>
        <th colspan="3" class="text-center">Orden del día</th>
      </thead>
      <tbody>
        <tr>
          <th style="border: black 1px solid" class="text-center">No.</th>
          <th style="border: black 1px solid" class="text-center">Tematica</th>
          <th style="border: black 1px solid" class="text-center">Responsabole</th>
        </tr>
        @foreach($programaciones as $key => $programacion)
        <tr>
          <td style="border: black 1px solid; width:50px;" align="center">{{ $key + 1 }}</td>
          <td style="border: black 1px solid; width:400px; padding-left:10px">{{ $programacion->tematica }}</td>
          <td style="border: black 1px solid" align="center">{{ $asistentes != 0 ? 'Comité Curricular MGTIC' : 'Comité Curricular Maestrías Departamento de Sistemas'}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Conclusiones -->

  <div class="mt-3">
    <table class="table" style="border: black 1px solid" align="center">
      <tbody>
        <tr>
          <th style="border: black 1px solid" class="text-center">No.</th>
          <th style="border: black 1px solid" class="text-center">Conclusión</th>
        </tr>
        @foreach($conclusiones as $key => $conclusion)
        <tr>
          <td style="border: black 1px solid; width:50px;" align="center">{{ $key + 1 }}</td>
          <td style="border: black 1px solid; padding-left:10px">{{ $conclusion->conclusion }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Tareas-->

  <div class="mt-3">
    <table class="table" style="border: black 1px solid" align="center">
      <thead>
        <th colspan="3" class="text-center">Tareas</th>
      </thead>
      <tbody>
        <tr>
          <th style="border: black 1px solid" class="text-center">No.</th>
          <th style="border: black 1px solid" class="text-center">Tarea</th>
          <th style="border: black 1px solid" class="text-center">Responsabole</th>
        </tr>
        @foreach($tareas as $key => $tarea)
        <tr>
          <td style="border: black 1px solid; width:50px;" align="center">{{ $key + 1 }}</td>
          <td style="border: black 1px solid; width:400px; padding-left:10px">{{ $tarea->tarea }}</td>
          <td style="border: black 1px solid" align="center">{{ $tarea->asistentes->cargos->desc_cargo }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- Firmas -->

  <div class="mt-3">
    <label for="" class="mb-4">En constancia de lo expuesto, se firma la presente acta el 23 de Diciembre de
      2021.</label>
    <table class="table" style="border: black 1px solid" align="center">
      <tbody>
        <tr>
          <td style="height: 200px;width: 50%; border: black 1px solid;">
            <div style="border-top: 1px solid #000;margin-top: 40%; height: 60px;" class="text-center">
              <b>LUIS OBEYMAR ESTRADA</b><br>
              UDENAR – Presidente Comité Curricular <br>
              MGTIC
            </div>
          </td>
          <td style="height: 200px;width: 50%; border: black 1px solid">
            <div style="border-top: 1px solid #000;margin-top: 40%; height: 60px;" class="text-center">
              <b>RICARDO TIMARAN PEREIRA</b><br>
              UDENAR – Coordinador MGTIC
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script type="text/php">
    if ( isset($pdf) ) {
          $pdf->page_script('
              $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
              $pdf->text(474, 45, "Pagina: $PAGE_NUM de $PAGE_COUNT", $font, 9);
          ');
      }
  </script>
</body>

</html>