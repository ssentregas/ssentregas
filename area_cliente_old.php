<?php

session_start();

if(!isset($_SESSION['id_cliente'])){
    header('location: sign_in.php');
}

include('layout/header.html');

?>
    <script src="assets/js/jquery.mask.min.js"></script>

    <script src="assets/js/validate.js"></script>

    <script src="assets/js/orcamento_logado.js"></script>

    <script src="assets/js/form_cliente.js"></script>
    
    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>


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
                        <h3 class="main-title__secondary"></h3>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6>SALDO ATUAL: R$ 200,00</h6>
                            </div>
                            <div align="right" class="col-md-6">
                                R$ 
                                <input style="width: 70px;display: inline;vertical-align: baseline; margin-bottom: 10px" type="text" placeholder="0" class="form-control" id="vlr_credito" /> ,00
                                <a href="#" style="margin-left: 10px;" id="btn_creditos" class="btn-sm btn-primary">Comprar créditos!</a>
                            </div>
                        </div>
                    </div>

                    <div>

                            <div class="panel-grid row">
                                <div class="panel-group" id="accordion-e1">
                                
                                
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseOne">
                                                    Cadastro
                                                    <span class="fa fa-plus"></span>
                                                    </a>
                                                    </h4>
                                        </div>
                                        
                                        <div id="collapseOne" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="col-md-12 panel-grid-cell">
                                                <br>
                                                    <div role="form" lang="en-US" dir="ltr">
                                                        <form id="cliente" novalidate="novalidate" data-redirect="none">
                                                            <div class="row">
                                                                <div class="col-xs-12  col-sm-6">
                                                                    <div class="c-form-group">
                                                                        <input type="text" name="nome" size="40" class="form-text" required="required" placeholder="Nome ou Razão Social">
                                                                    </div>
                                                                    <div class="c-form-group">
                                                                        <input type="email" name="email" size="40" class="form-text form-email" required="required" placeholder="E-mail">
                                                                    </div>
                                                                </div>                      
                                                                <div class="col-xs-12  col-sm-6">
                                                                    <div class="c-form-group">
                                                                        <input type="text" name="celular" size="40" class="form-text" placeholder="Celular" required="required">
                                                                    </div>
                                                                    <div class="c-form-group">
                                                                        <input type="text" name="contato" size="40" class="form-text" placeholder="Nome de contato">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12  col-sm-12">
                                                                    <div class="c-form-group">
                                                                        <input type="text" name="endereco" size="120" class="form-text form-email" placeholder="Endereço">
                                                                    </div>                                          
                                                                    <div class="c-form-group">
                                                                        <input type="text" name="documento" size="120" class="form-text" placeholder="CPF/RG ou CNPJ/IE">
                                                                    </div>

                                                                    <input type="submit" value="Salvar" id="js-cliente-btn" class="form-submit btn btn-primary">
                                                                    
                                                                </div>

                                                                <div class="m-t" id="js-cliente-result" data-success-msg="Informações atualizadas com sucesso!" data-error-msg="Ops! houve um problema ao salvar seus dados, se o problema persistir entre em contato pelo nosso e-mail (faleconosco@ssentregas.com.br)."></div>
                                                            </div>
                                                            <br>
                                                        </form>
                                                    </div>
                                                </div>                      
                                            </div>
                                        </div>
                                        
                                    </div>
									
									
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseTwo">
                                                    Solicitar serviço
                                                    <span class="fa fa-plus"></span>
                                                    </a>
                                                    </h4>
                                        </div>

                                        <div id="collapseTwo" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="col-md-12 panel-grid-cell">
                                                <br>
                                                    <div role="form" lang="en-US" dir="ltr">
                                                        <form id="orcamento" novalidate="novalidate" data-redirect="none">
                                                            <div class="row">
                                                                <div class="col-xs-12  col-sm-6">
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

                                                                    <div style="display: none;">
                                                                        <input type="text" name="nome" value="" />
                                                                        <input type="text" name="telefone" value="" />
                                                                        <input type="text" name="email" value="" />
                                                                    </div>
                                                                    
                                                                    <input type="submit" value="Solicitar" id="js-orcamento-btn" class="form-submit btn btn-primary">
                                                                    
                                                                </div>

                                                                <div class="m-t" id="js-orcamento-result" data-success-msg="Obrigado por entrar em contato, responderemos em breve!" data-error-msg="Ops! houve um problema ao enviar sua mensagem, caso o problema persita entre em contato pelo nosso e-mail (faleconosco@ssentregas.com.br)."></div>
                                                            </div>
                                                            <br>
                                                        </form>
                                                    </div>
                                                </div>                      
                                            </div>
                                        </div>                                      
                                        
                                    </div>									
                                    

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseThree">
                                                    Roteiros
                                                <span class="fa fa-plus"></span>
                                                </a>
                                                </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <div style="padding: 25px">

                                                    <table id="historico-table" class="table_pop sticky-thead">
                                                        <thead>
                                                            <th>DATA</th>
                                                            <th>ORIGEM</th>
                                                            <th>DESTINO</th>
                                                            <th>DESCRIÇÃO</th>
                                                            <th>STATUS</th>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                    <div class="btns_table" style="text-align:center;">
                                                        <button id="prev_historico">Anterior</button>
                                                        <button id="next_historico">Próximo</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                      
                                    
                                								
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseFour">
                                                    Conta Corrente
                                                <span class="fa fa-plus"></span>
                                                </a>
                                                </h4>
                                        </div>
                                        <div id="collapseFour" class="panel-collapse collapse">
                                            <div class="panel-body">

                                                <div style="padding: 25px">

                                                    <table id="ordemserv-table" class="table_pop sticky-thead">
                                                        <thead>
                                                            <th>DATA</th>
                                                            <th>TARIFA</th>
                                                            <th>FORMA PAGAMENTO</th>
                                                            <th>VALOR DA OS</th>
                                                            <th>ST. DA OS</th>
                                                            <th>ST. PAGAMENTO</th>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
                                                    <div class="btns_table" style="text-align:center;">
                                                        <button id="prev_ordemserv">Anterior</button>
                                                        <button id="next_ordemserv">Próximo</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>              
        
                                </div>
                            </div>  

                            
                            

                            <a href="sign_in.php" class="form-submit btn btn-primary">Sair</a>
                    </div>

                </div>
                <!-- // end .content-container -->

            </div>

            <!-- // end div[role=main] -->

            <div class="col-xs-12  col-md-3  col-md-pull-9">

                <!-- ============================
                  SIDEBAR
                 ============================ -->

                <div class="sidebar">
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
    
    <script>
        $(document).ready(function () {

            $('#vlr_credito').mask('0.000', {reverse: true});


            $('#btn_creditos').click(function(e){

                e.preventDefault();

                valor = $('#vlr_credito').val();
                valor = valor.replace('.','');

                if(valor == '' || parseInt(valor) < 10 || parseInt(valor) > 2000) {
                    alert('Valor mínimo da recarga é de 10 reais e o máximo 2000 reais');
                    return false;
                }

                $.ajax({
                    url: 'php/ControllerCreditos.php?action=add',
                    type: "POST",
                    data: {vlr_credito: valor},
                    success: function(html){
                        PagSeguroLightbox(html);
                    }
                });
            });
            

            $('#historico-table').tablePopulator({
                fetch_url: "php/ControllerRoteiro.php?action=getRoteiros",
                previous_button_selector: "#prev_historico",
                next_button_selector: "#next_historico",
                pagination_limit: 2,
                search_field_selector: "#search-input q",
                row_mapper: function (json_element, row_element) {
                    row_element[0] = json_element.dt_agendado   
                    row_element[1] = json_element.id_origem_cliente
                    row_element[2] = json_element.id_destino_cliente
                    row_element[3] = json_element.ds_tarefa
                    row_element[4] = json_element.st_ordem_serv_item
                }
            });

            $('#ordemserv-table').tablePopulator({
                fetch_url: "php/ControllerOrdemServico.php?action=getOrdemServ",
                previous_button_selector: "#prev_ordemserv",
                next_button_selector: "#next_ordemserv",
                pagination_limit: 2,
                search_field_selector: "#search-input q",
                row_mapper: function (json_element, row_element) {
                    row_element[0] = json_element.dt_inicio   
                    row_element[1] = json_element.id_tarifa
                    row_element[2] = json_element.id_forma_pagto
                    row_element[3] = json_element.vlr_os_previsto
                    row_element[4] = json_element.st_ordem_serv
                    row_element[5] = json_element.st_pagamento
                }
            });


        });




    </script>

<?php include('layout/footer.html'); ?>
