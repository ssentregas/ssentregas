<?php

session_start();

if(!isset($_SESSION['id_cliente'])){
    header('location: sign_in.php');
}

include('layout/header.html');

?>

<div class="container">
    <div class="row">
        <div class="col-xs-12  col-md-9 col-md-push-3" role="main">

            <!-- ============================
              CONTENT
             ============================ -->

            <div class="content-container">

                <div class="main-title">
                    <h1 class="main-title__primary">Faça o cálculo do seu trajeto</h1>
                </div>

                <article>
                    <?php include('layout/orcamento.php'); ?>
                </article>

            </div>
            <!-- // end .content-container -->

            <!-- ========  // END CONTENT ======== -->


        </div>

        <!-- // end div[role=main] -->

        <div class="col-xs-12  col-md-3  col-md-pull-9">

            <!-- ============================
              SIDEBAR
             ============================ -->

            <div class="sidebar">
                <?php include('layout/menu_orcamento.php'); ?>

                <div class="widget  widget-about-us">
                    <div id="carousel-people-pw_about_us-2" class="carousel slide" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner" role="listbox">
                            <div class="item active"> <a href="about.php" class="about-us__tag">CONTA CORRENTE SS Entregas</a><img class="about-us__image" src="assets/images/image-51.jpg" alt="About us image">
                                <h5 class="about-us__name">Abra uma conta corrente e facilite sua vida</h5>
                                <p class="about-us__description">Abra uma conta corrente com a SS Entregas, é rápido de abrir, fácil de controlar e seguro.</p>
                                <p class="about-us__description">Cadastre-se como cliente da SS Entregas e coloque créditos através de boleta ou cartão de crédito, assim você pode fazer sua solicitação de entrega online, de forma rápida e independente.</p>
                                <a href="about.php" class="read-more  about-us__link">Saiba mais</a></div>
                        </div>
                    </div>
                </div>
                <div class="widget  widget-skype">
                    <a class="skype-button" href="skype:ssentregasbarra"> <i class="fa  fa-skype"></i>
                        <p class="skype-button__title">Ligue pelo Skype</p>
                    </a>
                </div>


            </div>

            <!-- ========  // END SIDEBAR ======== -->
        </div>
    </div>
    <!-- // end .row -->
</div>
<!-- // end .container -->

<?php include('layout/footer.html'); ?>