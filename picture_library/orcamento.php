<?php include('layout/header.html'); ?>

    <script src="assets/js/jquery.geocomplete.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLCCzFgc_7tERqPJsIDDL7MghDMcdViy8&libraries=places&sensor=false"></script>
    <!-- Form Validation -->
    <script src="assets/js/validate.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#add_extra').click(function(){
                $element = $('#modelo').clone();
                $element.attr('id','');
                $('#itens').append($element.show());
                $("input.id_origem_cliente_edit").geocomplete();
            });

            $("input.id_origem_cliente_edit").geocomplete()
              .bind("geocode:result", function(event, result){
                //$.log("Result: " + result.formatted_address);
              })
              .bind("geocode:error", function(event, status){
                //$.log("ERROR: " + status);
              })
              .bind("geocode:multiple", function(event, results){
                //$.log("Multiple: " + results.length + " results found");
            });


            $(document).on('click','.icon-remove',function(){
                $(this).parents('tr').remove();
                
                if($('.icon-remove').length > 0){
                    calculaPontos();    
                }
                else{
                    $('#valor_roteiro').text('0,00');
                }
                
            });


            $('#voltar').click(function(){
                $('#result,#form-roteiro').toggle();
            });

            $('#cotacao').click(function(){

                if($('#origem').val() == ''){
                    alert('Digite um endereço para o ponto de origem');
                    $('#origem').focus();
                    return false;
                }

                if($('#destino').val() == ''){
                    alert('Digite um endereço para o ponto de destino');
                    $('#destino').focus();
                    return false;
                }
                
                $('#trajetos_table tbody').html('');

                $.each($('.id_origem_cliente_edit'),function(){

                    var observacao  = $(this).parents('.item_trajeto').find('.observacao').val();
                    var complemento = $(this).parents('.item_trajeto').find('.complemento').val();

                    attr = 'data-origem="'+$(this).val()+'"  ';
                    attr += 'data-complemento="'+complemento+'" ';
                    attr += 'data-obs="'+observacao+'" ';
                    attr += 'data-ordem="'+$('#trajetos_table tbody tr').length+'" ';
                    attr += 'data-distancia="" ';
                    attr += 'data-tempo=""';

                    if($(this).val() != ''){
                    	
                    	$td  = '<td>'+$(this).attr('data-trajeto')+'</td>';
                    	$td += '<td>'+$(this).val()+'</td>';
                    	$td += '<td>'+complemento+'</td>';
                    	$td += '<td>'+observacao+'</td>';
                    	$td += '<td><span class="icon-remove">Excluir</span></td>';

                        $('#trajetos_table tbody').append('<tr '+attr+' >'+$td+'</tr>');
                    }
                    
                });

                $('#result,#form-roteiro').toggle();

                calculaPontos();
            });

            calculaPontos = function(){

                var origem = '';

                var trajetos = [];
                
                if($('#trajetos_table tbody tr').length < 2){
                    return false;
                }

                $.each($('#trajetos_table tbody tr'),function(index,value){
                    trajetos.push({index:$(this).attr('data-ordem'),value:$(this).attr('data-origem')});
                });

                $.ajax({
                    url: 'http://104.154.74.30/SSEntregas_Adm/php/Ctrl_OS_LocalCliente.php',
                    data: {trajetos: trajetos},
                    type: 'POST',
                    success: function(e){
                        var e = $.parseJSON(e);
                                                
                        $.each(e['trajetos'],function(index,value){
                            $('#trajetos_table tr[data-ordem="'+index+'"]').attr('data-tempo',value['duration']['value']);
                            $('#trajetos_table tr[data-ordem="'+index+'"]').attr('data-distancia',value['distance']['value']);
                        });

                        $('#distancia_retorno').val(e['retorno']['distance']['value']);
                        $('#duracao_retorno').val(e['retorno']['duration']['value']);

                        $('#distancia_total').text(e['total_distancia']+' KM');
                        //$('#tempo_total').text(e['total_tempo']);
                        $('#valor_roteiro').text(e['valor_total']);
                    }
                });

            }

        });
    </script>

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
                        <h1 class="main-title__primary">Faça o cálculo do seu trajeto</h1>
                    </div>

                    <article>

                        
                        <div id="form-trajeto">

                                <form class="js-pgui-edit-form form-horizontal" id="form-roteiro" action="" novalidate="novalidate">
                                <div id="itens">
                                    <div class="item_trajeto" style="width:100%;max-width:100%">

                                        <label>Ponto de origem</label>

                                        <div class="row">
	                                        <div class="col-md-8">
		                                        <div class="input-group">
		                                            
		                                            <input style="margin-bottom: 5px" name="id_origem_cliente_edit" data-editor="true" data-editor-class="TextEdit" data-field-name="id_origem_cliente_edit" data-required-error-message="Trajeto é exigido." data-trajeto="Origem"  data-legacy-field-name="id_origem_cliente_edit" id="origem" data-pgui-legacy-validate="true" class="id_origem_cliente_edit form-control" value="" type="text" placeholder="Digite o endereço de origem" autocomplete="off">

		                                        </div><!-- /input-group -->
	                                        </div>
	                                        <div class="col-md-4">
	                                        	<input type="text" placeholder="Exemplo: Bloco 1 Ap. 201" class="form-control complemento" />
	                                        </div>
                                        </div>

                                        <div class="input-group">
                                            <input type="text" class="form-control observacao" placeholder="Fazer o que ? Falar com quem ?"/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="item_trajeto" style="width:100%;max-width:100%">
                                        <label>Ponto de destino</label>

                                        <div class="row">
	                                        <div class="col-md-8">
		                                        <div class="input-group">
                                            		<input style="margin-bottom: 5px" name="id_origem_cliente_edit" data-editor="true" data-editor-class="TextEdit" data-field-name="id_origem_cliente_edit" data-required-error-message="Trajeto é exigido." data-trajeto="Destino" data-legacy-field-name="id_origem_cliente_edit" id="destino" data-pgui-legacy-validate="true" class="id_origem_cliente_edit form-control" value="" type="text" placeholder="Digite o endereço do destino" autocomplete="off">
                                        		</div><!-- /input-group -->
                                        	</div>
	                                        <div class="col-md-4">
	                                        	<input type="text" placeholder="Exemplo: Bloco 1 Ap. 201" class="form-control complemento" />
	                                        </div>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" class="form-control observacao" placeholder="Fazer o que ? Falar com quem ?"/>
                                        </div>
                                    </div>
                                    <br/>
                                    <div class="item_trajeto" style="width:100%;max-width:100%">
                                        <label>Utilize esse campo, caso tenha mais um destino extra ou retorno ao ponto de origem</label>
                                        <div class="row">
	                                        <div class="col-md-8">
		                                        <div class="input-group">
                                            
                                            		<input style="margin-bottom: 5px" name="id_origem_cliente_edit" data-editor="true" data-editor-class="TextEdit" data-field-name="id_origem_cliente_edit" data-required-error-message="Trajeto é exigido." data-trajeto="Destino extra" data-legacy-field-name="id_origem_cliente_edit" id="ponto_extra" data-pgui-legacy-validate="true" class="id_origem_cliente_edit form-control" value="" type="text" placeholder="Digite o endereço" autocomplete="off">

                                        		</div><!-- /input-group -->
                                        	</div>
	                                        <div class="col-md-4">
	                                        	<input type="text" placeholder="Exemplo: Bloco 1 Ap. 201" class="form-control complemento" />
	                                        </div>
                                        </div>

                                        <div class="input-group">
                                            <input type="text" class="form-control observacao" placeholder="Fazer o que ? Falar com quem ?"/>
                                        </div>
                                    </div>
                                    <div id="modelo" class="item_trajeto" style="width:100%;max-width:100%;display: none">
                                        <hr/>
                                        <div class="row">
	                                        <div class="col-md-8">
		                                        <div class="input-group">
                                            
                                            		<input style="margin-bottom: 5px" name="id_origem_cliente_edit" data-editor="true" data-editor-class="TextEdit" data-field-name="id_origem_cliente_edit" data-required-error-message="Trajeto é exigido." data-trajeto="Destino extra" data-legacy-field-name="id_origem_cliente_edit" id="ponto_extra" data-pgui-legacy-validate="true" class="id_origem_cliente_edit form-control" value="" type="text" placeholder="Digite o endereço" autocomplete="off">

                                        		</div><!-- /input-group -->
                                        	</div>

	                                        <div class="col-md-4">
	                                        	<input type="text" placeholder="Exemplo: Bloco 1 Ap. 201" class="form-control complemento" />
	                                        </div>
                                        </div>

                                        <div class="input-group">
                                            <input type="text" class="form-control observacao" placeholder="Fazer o que ? Falar com quem ?"/>
                                        </div>
                                    </div>
                                    </div>
                                    <br/>
                                    <span id="cotacao" class="btn btn-primary">Faça uma cotação</span>
                                    <span id="add_extra" class="btn btn-danger">+ Adicionar mais um destino extra</span>
                                </form>

                                <div id="result" style="display: none">
                                    
                                    <table id="trajetos_table" class="table text-center table-striped">
                                        <thead>
                                            <tr>
                                            	<th></th>
                                                <th>Trajeto</th>
                                                <th>Complemento</th>
                                                <th>Tarefa</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                    </table>

                                    <h4>Valor da Ordem de Serviço: R$ <span id="valor_roteiro"></span></h4>
                                    <span id="finalizar" class="btn btn-primary">Finalizar cotação</span>
                                    <span id="voltar" class="btn btn-danger">Corrigir trajeto</span>
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
