<?php

include("./config/conn.php");

$Conn = new SQLServer();
$Conn->CRM();
$Conn->conectar();
$Conn->conectarBanco();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Intranet Concreto">
    <meta name="keywords" content="appconcreto,intranet concreto,">

    <title>CONCRETO</title>
    <!-- Favicons-->
    <link rel="icon" href="./img/favicon.png" sizes="32x32">

    <!-- CORE CSS-->
    <link href="./libs/materialize.css" type="text/css" rel="stylesheet">
    <link href="./libs/style.css" type="text/css" rel="stylesheet">

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="../js/novo/vendors/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="../js/novo/jquery/jquery-3.5.1.min.js"></script>
    <script src="../js/novo/jquery.mask.min.js"></script>

    <!-- CUSTOM-->
    <link rel="stylesheet" type="text/css" href="./mapa/style.css">

<body style="background-color:#f3f3f3;">

    <!-- MENU SUPERIOR -->
    <?php include("./mapa/header.php"); ?>

    <!-- MENU LATERAL -->
    <?php $isSales ? include("../menuSales.php") : include("../menu2.php"); ?>

    <!-- CONTEÚDO -->
    <section id="content" style="background-color:#f3f3f3;">
        <div class="row">
            <div class="col s12 m12 l12">

                <div class="card-image" style="display: flex; align-items: center; justify-content: space-between; margin: 11px; ">
                    <div style="display: flex; align-items: center;">
                        <img src="../imagens/icon-predio.png" style="width: 40px;">
                        <span class="card-title" style="color: black; font-weight: bold; padding: 10px; margin-left: 10px; margin-right: 8px">
                            <h4> MAPA DE DISPONIBILIDADE <h4>
                        </span>
                    </div>
                    <div style="flex: 1;"></div> <!-- Espaço flexível -->
                    <select class="browser-default" id="selectEmpreendimento">
                    </select> &nbsp; &nbsp;
                    <select class="browser-default" id="selectTorre" style="width: auto;">
                    </select>
                    <div class="">
                        &nbsp; &nbsp;
                        <a href="#" onclick="carregarMapa()" class="material-icons background-square mt-5 link-style">
                            <i class="material-icons" style=" margin-top: 3px;">search</i>
                        </a>
                    </div>


                </div>
                <div class="col s2">
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
                <div class="col s2">
                    <div class="card reservado card-hover custom-card">
                        <div class="card-content" style="padding: 10px" ;>
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3 class="white-text m-b-5" id="qtdReservado">--</h3>
                                    <h6 class="white-text op-5">RESERVADOS</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s2">
                    <div class="card vendido card-hover custom-card">
                        <div class="card-content" style="padding: 10px" ;>
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3 class="white-text m-b-5" id="qtdVendido">--</h3>
                                    <h6 class="white-text op-5">VENDIDOS</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s2">
                    <div class="card alugado card-hover custom-card">
                        <div class="card-content" style="padding: 10px" ;>
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3 class="white-text m-b-5" id="qtdAlugado">--</h3>
                                    <h6 class="white-text op-5">ALUGADOS</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s2">
                    <div class="card reservacomercial card-hover custom-card">
                        <div class="card-content" style="padding: 10px" ;>
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3 class="white-text m-b-5" id="qtdComercial">--</h3>
                                    <h6 class="white-text op-5">RESERVAS COMERCIAIS</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s2">
                    <div class="card permuta card-hover custom-card">
                        <div class="card-content" style="padding: 10px" ;>
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h3 class="white-text m-b-5" id="qtdPermuta">--</h3>
                                    <h6 class="white-text op-5">PERMUTA</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- ============================================================== -->
                <!-- MAPA -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col s12">
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
    <?php include("../footer2.php"); ?>

    <!-- CUSTOM JS -->
    <script src="./script.js"></script>