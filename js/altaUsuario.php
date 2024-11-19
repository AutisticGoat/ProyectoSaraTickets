
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>cla</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <header>
            <!-- header inner -->
            <div class="header">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                           <div class="center-desk">
                              <div class="logo">
                                 <a href="index.html"><img src="" alt="" /></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark ">
                           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                           <span class="navbar-toggler-icon"></span>
                           </button>
                           <div class="collapse navbar-collapse" id="navbarsExample04">
                              <ul class="navbar-nav mr-auto">
                                 <li class="nav-item active">
                                    <a class="nav-link" href="index.html">Inicio</a>
                                 </li>
                                 <li class="nav-item">
                                   <a class="nav-link" href="FrmUsuario.html">Usuarios</a> 
                                 </li>
                                 <li class="nav-item">
                                    <a class="nav-link" href="tablas.html">Tablas</a> 
                                 </li>
                                 <li class="nav-item d_none">
                                    <a class="nav-link" href="inutil.php">Cerrar Sesion</a>
                                 </li>
                              </ul>
                           </div>
                        </nav>
                     </div>
                  </div>
               </div>
            </div>
         </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      <section class="banner_main">
         <div id="banner1" class="carousel slide" data-ride="carousel">
            
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <div class="container">
                     <div class="carousel-caption">
                        <div class="row">
                           <div class="col-md-6">
                              <div class="text-bg">
                                 <span></span>
                                 <h1>Usuarios</h1>
                                 <p>Aqui puedes dar de alta a los usuarios</p>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="text_img">
                                 <figure><img src="" alt=""/></figure>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               
            <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
            </a>
            <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </a>
         </div>
      </section>
      <!-- end banner -->

      <!--  contact -->
      <div class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Usuario A Dar De Alta</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <form id="request" class="main_form" method="post">
                     <div class="row">
                        <div class="col-md-12 ">
                           <input class="contactus" placeholder="Usuario" type="text" name="nombreUsuario"> 
                        </div>
                        <div class="col-md-12 ">
                            <input class="contactus" placeholder="Area" type="text" name="areaUsuario"> 
                         </div>
                        <div class="col-md-12">
                           <input class="contactus" placeholder="Contraseña" type="password" name="contraUsuario"> 
                        </div>
                        <div class="col-md-12">
                           <button class="send_btn">Subir</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
      <!-- end customer -->

      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
   </body>
</html>

<?php

require_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombreUsuario = $_POST['nombreUsuario'];
    $areaUsuario = $_POST['areaUsuario'];
    $contraseñaUsuario = $_POST['contraUsuario'];

    $queryAS = $conn->prepare("INSERT INTO usuario (Nombre,Area,Contraseña) VALUES (?,?,?)");
    $queryAS->bind_param("sss",$nombreUsuario,$areaUsuario,$contraseñaUsuario);
    if($queryAS->execute())
    {
        echo'<script>window.alert("Usuario registrado correctamente")</script>';
    }
    else
    {
        echo'<script>window.alert("Error: '.htmlspecialchars($conn->error).'")</script>';
    }
    


}

?>