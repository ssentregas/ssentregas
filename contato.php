<?php include('layout/header.html'); ?>

    <!-- Google MAP -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" src="assets/js/google-map.js"></script>


    <!-- Form Validation -->
    <script src="assets/js/validate.js"></script>

    <!-- Contact form -->
    <script src="assets/js/contact_form.js"></script>
    <!-- ============================
      CONTAINER
     ============================ -->

    <div class="container">
        <div class="row">
            <div class="col-xs-12  col-md-9 col-md-push-3" role="main">

                <!-- ============================
                  CONTENT
                 ============================ -->

                <div class="content-container">

                    <div class="main-title">
                        <h1 class="main-title__primary">Dados para Contato</h1>
                        <h3 class="main-title__secondary">Estamos aguardando seu contato.</h3>
                    </div>

                    <article>

                        <!-- ============================
                          GOOGLE MAP
                         ============================ -->

                        <div class="panel-grid row">
                            <div class="col-md-12 panel-grid-cell">

                                <div class="map" id="map_canvas" data-latitude="-22.8989634" data-longitude="-43.2264952" data-pin-img="assets/images/pin.png">
                                </div>						
								
                            </div>
                        </div>

                        <div class="panel-grid row m-b-0">
                            <div class="col-md-4 panel-grid-cell">

                                <!-- ============================
                                  ADDRESS
                                 ============================ -->

                                <div class="textwidget">
                                    <h5>SS Entregas.</h5>

                                    <p>21 3860-7655
                                    <br>21 4108-2900
                                    <br><a href="mailto:faleconosco@ssentregas.com.br">faleconosco@ssentregas.com.br</a></p>
                                </div>								
								
								
                            </div>

                            <div class="col-md-8 panel-grid-cell">

                                <!-- ============================
                                  CONTACT FORM
                                 ============================ -->

                                <div class="textwidget">
                                    <div role="form" lang="en-US" dir="ltr">

                                        <form id="phpcontactform" novalidate="novalidate" data-redirect="none">

                                            <div class="row">
                                                <div class="col-xs-12  col-sm-6">
                                                    <div class="c-form-group">
                                                        <input type="text" name="name" size="40" class="form-text" required="required" placeholder="Seu nome">
                                                    </div>
                                                    <div class="c-form-group">
                                                        <input type="email" name="email" size="40" class="form-text form-email" required="required" placeholder="E-mail">
                                                    </div>
                                                    <div class="c-form-group">
                                                        <input type="text" name="subject" size="40" class="form-text" required="required" placeholder="Assunto">
                                                    </div>
                                                </div>
                                                <div class="col-xs-12  col-sm-6">
                                                    <div class="c-form-group">
                                                        <textarea name="message" cols="40" rows="10" class="form-textarea" placeholder="Mensagem"></textarea>
                                                    </div>

                                                    <input type="submit" value="ENVIE SUA MENSAGEM" id="js-contact-btn" class="form-submit btn btn-primary">
                                                </div>

                                                <!-- // end .js-contact-result -->

                                            </div>

                                            <div class="m-t" id="js-contact-result" data-success-msg="Obrigado por entrar em contato, responderemos em breve!" data-error-msg="Ops! houve um problema ao enviar sua mensagem, caso o problema persita entre em contato pelo nosso e-mail (faleconosco@ssentregas.com.br).">

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>

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
                    <?php include('layout/menu.php'); ?>

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
