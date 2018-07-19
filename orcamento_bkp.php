<?php include('layout/header.html'); ?>

    <!-- Form Validation -->
    <script src="assets/js/jquery.mask.min.js"></script>

    <!-- Form Validation -->
    <script src="assets/js/validate.js"></script>

    <script src="assets/js/orcamento.js"></script>

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
                        <h1 class="main-title__primary">Veja quanto sai sua entrega.</h1>
                    </div>

                    <article>

                        <div class="panel-grid row m-b-0">
                            <div class="col-md-4 panel-grid-cell">

                                <!-- ============================
                                  ADDRESS
                                 ============================ -->

                                <div class="textwidget">
                                    <h5>Ligue ou preencha o formulário ao lado.</h5>
                                    <p>21 3860-4302
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

                                        <form id="appointmentform" novalidate="novalidate" data-redirect="none">

                                            <div class="row">
                                                <div class="col-xs-12  col-sm-6">
                                                    <div class="c-form-group">
                                                        <input type="text" name="nome" size="40" class="form-text" required="required" placeholder="Seu Nome">
                                                    </div>
                                                    <div class="c-form-group">
                                                        <input type="email" name="email" size="40" class="form-text form-email" required="required" placeholder="E-mail">
                                                    </div>
                                                </div>
																			
                                                <div class="col-xs-12  col-sm-6">
                                                    <div class="c-form-group">
                                                        <input type="text" name="telefone" size="40" class="form-text" required="required" placeholder="Telefone">
                                                    </div>
                                                    <div class="c-form-group">
                                                        <input type="date" name="data" size="40" class="form-text" required="required">
                                                    </div>
                                                </div>												

                                                <div class="col-xs-12  col-sm-12">
                                                    <div class="c-form-group">
                                                        <input type="text" name="retirada" size="120" class="form-text form-email" required="required" placeholder="Local de retirada">
													</div>											
                                                    <div class="c-form-group">
                                                        <input type="text" name="entrega" size="120" class="form-text" required="required" placeholder="Local de entrega">
                                                    </div>
                                                    <div class="c-form-group">
                                                        <textarea name="descricao" cols="40" rows="20" class="form-textarea" required="required" placeholder="Descrição do serviço"></textarea>
                                                    </div>

                                                    <input type="submit" value="Solicite Já" id="js-appointment-btn" class="form-submit btn btn-primary">
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
				
                <!-- ============================
                  LATEST POSTS
                 ============================ -->

                <div class="latest-posts">
                    <div class="row">
					
                        <div class="col-xs-12 col-md-4">
                            <div class="latest-post">
                                <a class="latest-post__thumbnail" href="services.php"><img width="270" height="190" src="assets/images/image-36-270x190.jpg" class="attachment-latest-posts size-latest-posts wp-post-image" alt="MentalPress 21"></a>
                                <div class="latest-post__categories">
                                    <ul class="post-categories">
                                        <li><a href="category/teenage/" rel="category tag">PONTO a PONTO</a></li>
                                    </ul>
                                </div>
                                <h4 class="latest-post__title"><a href="blog-single.php">Entregas com origem e destino</a></h4>
                                <p class="latest-post__excerpt"> Podendo ser uma ou várias, o entregador segue o roteiro que for determinado …</p>
                            </div>
                        </div>
						
                        <div class="col-xs-12 col-md-4">
                            <div class="latest-post">
                                <a class="latest-post__thumbnail" href="blog-single.php"><img width="270" height="190" src="assets/images/image-45-270x190.jpg" class="attachment-latest-posts size-latest-posts wp-post-image" alt="MentalPress 13"></a>
                                <div class="latest-post__categories">
                                    <ul class="post-categories">
                                        <li><a href="category/self-improvement/" rel="category tag">DIÁRIA</a></li>
                                        <li><a href="category/therapy/" rel="category tag">POR HORA</a></li>
                                    </ul>
                                </div>
                                <h4 class="latest-post__title"><a href="blog-single.php">Contrato por período</a></h4>
                                <p class="latest-post__excerpt"> Tenha um entregador por um período determinado, realizando as tarefas comandadas por você …</p>
                            </div>
                        </div>
						
                        <div class="col-xs-12 col-md-4">
                            <div class="latest-post">
                                <a class="latest-post__thumbnail" href="blog-single.php"><img width="270" height="190" src="assets/images/image-57-270x190.jpg" class="attachment-latest-posts size-latest-posts wp-post-image" alt="MentalPress 1"></a>
                                <div class="latest-post__categories">
                                    <ul class="post-categories">
                                        <li><a href="category/children-therapy/" rel="category tag">MALA DIRETA</a></li>
                                    </ul>
                                </div>
                                <h4 class="latest-post__title"><a href="blog-single.php">Lista de endereços</a></h4>
                                <p class="latest-post__excerpt"> Faça uma lista de entrega e nos levamos suas encomendas. Realizamos as entrega e você acompanha tudo pelo site …</p>
                            </div>
                        </div>
						
                    </div>
                </div>
            </div>

            <!-- // end div[role=main] -->

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