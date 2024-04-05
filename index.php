<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Intranet Concreto">
    <meta name="keywords" content="appconcreto,intranet concreto,">

    <title>CONCRETO - MAPA</title>
    <!-- FAVICON-->
    <link rel="icon" href="./img/favicon.png" sizes="32x32">

    <!-- CORE CSS-->
    <link href="./libs/materialize.css" type="text/css" rel="stylesheet">
    <link href="./libs/style.css" type="text/css" rel="stylesheet">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="./libs/jquery-3.5.1.min.js"></script>
    <script src="./libs/jquery.mask.min.js"></script>

    <!-- CUSTOM-->
    <link rel="stylesheet" type="text/css" href="./style.css">

<body style="background-color:#f3f3f3;">

    <!-- CONTEÚDO -->
    <section id="content" style="background-color:#f3f3f3;">
        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card-image" style="display: flex; align-items: center; justify-content: space-between; margin: 11px; ">
                    <div style="display: flex; align-items: center;">
                        <img src="./img/icon-predio.png" style="width: 40px;">
                        <span class="card-title" style="color: black; font-weight: bold; padding: 10px; margin-left: 10px; margin-right: 8px">
                            <!-- Utiliza classes de responsividade do Materialize para alterar o elemento -->
                            <h4 class="hide-on-small-only">MAPA DE DISPONIBILIDADE</h4>
                            <p class="hide-on-med-and-up">MAPA DE DISPONIBILIDADE</p>
                        </span>
                    </div>
                    <div style="flex: 1;"></div> <!-- Espaço flexível -->
                    <select class="browser-default" id="selectTorre" style="width: auto; margin-right:10px">
                    </select>
                </div>
                <div class="col s12 m12 l2">
                    <div class="card disponivel card-hover custom-card">
                        <div class="card-content" style="padding: 10px" ;>
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3 class="white-text" id="qtdDisponivel">--</h3>
                                    <h6 class="white-text op-5 light-blue-text">DISPONÍVEIS</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m12 l2">
                    <div class="card vendido card-hover custom-card">
                        <div class="card-content" style="padding: 10px" ;>
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3 class="white-text" id="qtdIndisponivel">--</h3>
                                    <h6 class="white-text op-5 light-blue-text">INDISPONÍVEIS</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- ============================================================== -->
                <!-- MAPA -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card" style="background-color: #e5e5e5;">
                            <div class="card-content">
                                <table id="tabela-disponibilidade"></table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        </div>
    </section>

    <div id="usuario" data-user="<?php echo $usuario; ?>"></div>

    <!-- LOADING  -->
    <div id="loading" style="position: fixed; width: 100%; height: 100%; top: 0; left: 0; display: flex; align-items: center; justify-content: center; background-color: rgba(255, 255, 255, 0.5);">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-green-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- RODAPE E CHAMADAS JS -->

    <script type="text/javascript" src="./libs/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="./libs/materialize.min.js"></script>


</body>

</html>

<!-- CUSTOM JS -->
<script src="./script.js"></script>