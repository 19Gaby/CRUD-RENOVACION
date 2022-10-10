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
    <link rel="stylesheet" href="assets/css/color_boton.css">

<!--

TemplateMo 551 Stand Blog

https://templatemo.com/tm-551-stand-blog

-->
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->
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
              <h1 class="fw-bold mb-5">¡Bienvenido profesor!</h1>
              <h2>Por favor ingresa tu matricula y equipo(s) para renovar</h2>
              <h6>Recuerda que tienes derecho a 2 renovaciones por dia.</h6>
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <br>
              {{-- <form action="{{route('busqueda')}}" method="POST">
                @csrf --}}
                <div class="row">
                  <div class="col-md-8 mb-4">
                    <div class="form-outline">
                      {{-- <input autocomplete="off" class="form-control" name="matricula" type="text" id="matricula" placeholder="Matricula" required=""/> --}}
                      <input class="form-control" name="matricula" type="text" id="matricula" placeholder="Matricula" required=""/>
                    </div>
                  </div>
                  <div class="col-md-4 mb-4">
                    <div class="form-outline">
                      <button type="submit" class="btn btn-primary btn-block mb-4" id="form-matricula">
                        Buscar
                      </button>
                    </div>
                  </div>
                </div>
              {{-- </form> --}}
              @if(Session::has('bloqueo'))
                  <h3 style="color: crimson">{{Session::get('bloqueo')}}</h3>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>

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

    <!-- Additional Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/owl.js"></script>
    <script src="assets/js/slick.js"></script>
    <script src="assets/js/isotope.js"></script>
    <script src="assets/js/accordions.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script language = "text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0;
    function clearField(t){
    if(! cleared[t.id]){
        cleared[t.id] = 1;
        t.value='';
        t.style.color='#fff';
        }
    }
    </script>
    <script>
    //Validar campos nulos
    $('#form-matricula').click(function () {
      if ($('#matricula').val() == "") {
        console.log("Entro en la Alerta");
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'El campo matricula es obligatorio',
        });
        return false;
      }else{
        $.ajax({
          url: "{{ route('busqueda') }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            matricula: $('#matricula').val()
        },success:function(data){
          console.log(data);
            var data = JSON.parse(data);
            if(data == "False"){
              Swal.fire({
                icon: 'error',
                type: 'error',
                title: 'Oops...',
                text: 'La matricula no fue encontrada',
              }).then((result) => {
                if (result.value) {
                  document.getElementById("form-submit").disabled = false;
                }
              })
            }
            else if(data == "True"){
              var matricula=$('#matricula').val();
              window.location.href="equipos/"+matricula;
            }
        }
      });
      }
    });


    </script>
  </body>
</html>
