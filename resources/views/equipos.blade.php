<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Renovacion</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS -->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-stand-blog.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/colores_boton.css">
<!--

TemplateMo 551 Stand Blog

https://templatemo.com/tm-551-stand-blog

-->
</head>

<body>
    <header class="" style="height:80px; background-color: #fff;">
      <nav class="navbar navbar-expand-lg" style="padding: 10px 0px;">
        <div class="container">
          <a class="navbar-brand" href="" > <img src="assets/images/site1.jpg" alt="">
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href=""></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <section class="text-center">
      <div class="card mx-4 mx-md-5 shadow-5-strong" style="
            margin-top: -100px;
            background: hsla(0, 0%, 100%, 0.8);
            backdrop-filter: blur(30px);
            ">
        <div class="card-body py-5 px-md-5">

          <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
              <!-- Equipos -->
              <h2>Duración de renovacion</h2>
              <br>Por favor elija las horas que quiera que dure su renovacion</br>
     
                <input class="form-check-input" value="{{$matri}}" type="hidden" name="matricula" id="matricula">
                @foreach ($data as $x)
                  <input class="form-check-input" value="{{$x->id}}" type="hidden" name="books_id" id="books_id">
                @endforeach
                @foreach ($opor as $oportunidad)
                  @if($oportunidad->oportunidad==0)
                    <div class="form-check">
                      <input class="form-check-input" value="180" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                      <label class="form-check-label" for="flexRadioDefault2">3 horas</label>
                    </div>
                  @elseif($oportunidad->oportunidad==1)
                    <div class="form-check">
                      <input class="form-check-input" value="120" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                      <label class="form-check-label" for="flexRadioDefault1">2 horas</label>
                    </div>
                  @else
                    <h3 style="color: crimson">Oportunidades excedidas</h3>
                  @endif
                @endforeach
                <br>
                <!-- Boton de Renovación -->

                <button type="submit"  class="btn btn-success mb-4" onclick="ver()" id="ver_equipos"  style="padding: 1.000rem 0.75rem; " >Ver equipos</button>
                <button type="submit" class="btn btn-danger mb-4" onclick="regresar()" id="regresar" style="padding: 1.000rem 0.75rem;">Cancelar</button>
                
                {{-- Verificar que solo renueve 15 min antes de la hora establecida --}}
                @foreach ($tiempo as $i)
                  @foreach ($tiempo2 as $j)
                    @if($i->tiempo==1 and $j->tiempo==1)
                    <button type="submit" class="btn btn-primary mb-4" id="insertdata" style="padding: 1.000rem 0.75rem;">Renovar</button>
                    @else
                    <button type="submit" class="btn btn-primary mb-4" disabled style="padding: 1.000rem 4.75rem;">Renovar</button>
                      @if($j->tiempo==0)
                        <h3 style="color: crimson">El tiempo de renovación ha expirado</h3>
                        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                          Swal.fire({
                            icon: 'error',
                            type: 'error',
                            title: 'Lo siento',
                            text: 'El tiempo de renovación ha expirado',
                          }).then(function(){
                            $.ajax({
                              url: "{{ route('sancion') }}",
                              type: "POST",
                              data: {
                                _token: "{{ csrf_token() }}",
                                matricula: $('#matricula').val(),
                                id_equipo: $('#books_id').val()
                              },success:function(data){
                                console.log(data);
                              },error:function(data){
                                console.log(data);
                              }
                            });
                          });
                        </script>
                      @endif
                    @endif
                  @endforeach
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="modalAgregar" aria-hidden="" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel">Tus equipos son:</h5>
            <span style="cursor: pointer" class="material-symbols-outlined" data-dismiss="modal">close</span>
          </div>
          <div class="modal-body">
            <div >
              <div class="form-outline"> 
                <table class="table table-striped table-bordered" >
                  <thead>
                    <tr>
                      <th>Equipos</th>
                      <th>Hora de solicitud</th>
                      <th>Hora de entrega</th>
                      <th>Acciones</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                    <tr>
                      <td>{{$item->title}}</td>
                      <td>{{$item->date_borrow}}</td>
                      <td>{{$item->hora_entregar}}</td>
                      <td> <button onclick="eliminar({{$item->title}})" type="button"
                        class="btn btn-danger btn-sm btn-icon-text"><i class='bx bxs-message-alt-x'></i></button> </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-md-4 mb-4">
              <div class="form-outline">
                <button type="submit" class="btn btn-primary btn-block mb-4" id="form-equipo" data-dismiss="modal">Aceptar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Termina Modal -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text">
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    require_once "connection/Connection.php"

    class Acciones {

      $db = new Connection(){
        $query = "SELECT *FROM clientes";
        $resultado = $db->query($query);
        $datos = array();
        if($resultado->num_rows) {
        while($row = $resultado->fetch_assoc()) {
          $datos[] = [
              'id' => $row['id']
              
          ];
        }
        }
public static function insert(){h
  $db = new conection();
  $query = "INSERT INTO"
  VALUES('".$nombre."'");
}
        
      }
    }
    <script>
          $( document ).ready(function() {
          $('#modalAgregar').modal('toggle')
        });
      function ver(){
        $( document ).ready(function() {
          $('#modalAgregar').modal('toggle')
        });
      }

      function regresar(){
        window.location.href="{{route('index')}}";
      }

      function eliminar(title){
        Swal.fire({
                title: "Eliminar equipo",
                text: "¿Seguro de eliminar equipo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar",
                allowOutsideClick: false,
                closeOnClickOutside: false
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('equipo.eliminar') }}";
                    $.ajax({
                        type: 'get',
                        url: url + '/' + id,
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            //console.log(data);
                            if (data.estatus == 'ok') {
                                Swal.fire({
                                    title: "Equipo eliminado",
                                    text: "Se elimino con exito",
                                    icon: 'success',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ok',
                                    allowOutsideClick: false,
                                    closeOnClickOutside: false
                                }).then((result) => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: "Eliminar equipo",
                                    text: "No se elimino",
                                    icon: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: "Aceptar",
                                    allowOutsideClick: false,
                                    closeOnClickOutside: false
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        },
                        error: function(response) {
                            crearAlertas('Error!', "Error al eliminar el equipo", 'error');
                        }
                    });
                }
            })
      } 
    </script>
    
    <script>
      $('#insertdata').click(function () {
        console.log('Envia los datos');
        if($('input[name=flexRadioDefault]:checked').length) {
            var radiobutton = $('input[name=flexRadioDefault]:checked').val();
            $.ajax({
          url: "{{ route('renovar') }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            matricula: $('#matricula').val(),
            // intervalo: $('input[name=flexRadioDefault]:checked').val()
            intervalo: radiobutton
          },success:function(data){
            Swal.fire({
                icon: 'success',
                type: 'success',
                title: 'Listo',
                text: 'Renovación exitosa',
              }).then(function(){
                window.location.href="{{route('index')}}";
              });
          },
          error:function(data){
            Swal.fire(
              'Oops...',
              'Algo salio mal',
              'error'
            )
          }
        })
        }else{
          Swal.fire(
              'Oops...',
              'Porfavor selecciona una hora',
              'error'
            )
        }
        
      })
    </script>