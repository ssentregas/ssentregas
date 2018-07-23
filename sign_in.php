<?php include('layout/header.html'); ?>
    <script type="text/javascript" src="assets/js/sign_in.js"></script>

    <!-- ========  // END HEADER ======== -->

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
                        <h1 class="main-title__primary">Área do Cliente.</h1>
                    </div>

                    <article>

                        <div class="panel-grid row m-b-0">
                            <div class="col-md-4 panel-grid-cell">

                                <!-- ============================
                                  ADDRESS
                                 ============================ -->

                                <div class="textwidget">                      

                                        <form id="form_senha" style="display:none" data-redirect="none">

                                            <h5>Enviar senha para e-mail</h5>   

                                            <div class="row">
                                                <div class="c-form-group">
                                                    <input type="text" name="email" size="40" class="form-text" required="required" placeholder="E-mail">
                                                </div>
                                                <a href="#" class="pull-right click_senha">Lembrei da minha senha</a>
                                            </div>
                                            <br/>
                                            <input type="submit" value="Enviar" class="form-submit btn btn-primary">
                                        </form>

                                        <form id="login" data-redirect="none">
                                            
                                            <h5>Já sou cliente.</h5>   

                                            <div class="row">
                                                <div class="c-form-group">
                                                    <input type="text" name="email" size="40" class="form-text" required="required" placeholder="E-mail">
                                                </div>
                                                <div class="c-form-group">
                                                    <input type="password" name="senha" size="40" class="form-text form-email" required="required" placeholder="Senha">
                                                </div>
                                                <a href="#" class="pull-right click_senha">Esqueci minha senha</a>
                                            </div>
											<br/>
                                            <input type="submit" value="Entrar" class="form-submit btn btn-primary">
											
                                        </form>
                                          									
								</div>

									
                            </div>
									

                            <div class="col-md-8 panel-grid-cell">

                                <!-- ============================
                                  CONTACT FORM
                                 ============================ -->

                                <div class="textwidget">

                                    <h5>Preencha o formulário abaixo e seja nosso cliente.</h5>                         

									<div role="form" lang="en-US" dir="ltr">

                                        <form id="add_cliente" data-redirect="none">

                                            <div class="row">
																											
                                                <div class="col-xs-12  col-sm-12">
												
                                                    <div class="c-form-group">
                                                        <input type="text" name="nome" size="40" class="form-text" required="required" placeholder="Seu Nome">
                                                    </div>
                                                    <div class="c-form-group">
                                                        <input type="email" name="email" size="40" class="form-text form-email" required="required" placeholder="E-mail">
                                                    </div>												
                                                    <div class="c-form-group">
                                                        <input type="text" name="celular" size="40" class="form-text" placeholder="Celular">
                                                    </div>                                              
                                                    <div class="c-form-group">
                                                        <input type="password" id="senha" name="senha" size="40" class="form-text" required="required" placeholder="Senha">
                                                    </div>
                                                    <div class="c-form-group">
                                                        <input type="password" id="confirm_senha" size="40" class="form-text" required="required" placeholder="Repetir senha">
                                                    </div>
	

                                                    <input type="submit" value="cadastre-se Já" id="js-appointment-btn" class="form-submit btn btn-primary">
                                                </div>

                                                <!-- // end .js-contact-result -->

                                            </div>

                                            <div class="m-t" id="js-appointment-result" data-success-msg="Thank you for making an appointment. We will get back to you soon." data-error-msg="Oops! Couldn't make an appointment. Try calling us directly.">

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

