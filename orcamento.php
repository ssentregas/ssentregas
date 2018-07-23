<?php include('layout/header.html'); ?>

    <script src="assets/js/jquery.geocomplete.js"></script>
<!-- AIzaSyCLCCzFgc_7tERqPJsIDDL7MghDMcdViy8-->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0fuLnMKGSsFjngKaQbDg2I2t9HxBcH2s&libraries=places&sensor=false"></script>
    <!-- Form Validation -->
    <script src="assets/js/validate.js"></script>

    <style>
        #preloader {
            position: fixed;
            left: 0;
            top: 0;
            z-index: 999;
            width: 100%;
            height: 100%;
            overflow: visible;
            background: #333 url('//cdnjs.cloudflare.com/ajax/libs/file-uploader/3.7.0/processing.gif') no-repeat center center;
        }

    </style>

    <script type="text/javascript">

        var base = '', valorRoteiro = '', distancias='', tempo='', distanciaTotal='', pagamento='';

        $(document).ready(function(){

            $('#forma-pagamento').on('change', function() {
                // alert( this.value );

                if(this.value == 'dinheiro'){
                    $('#form-troco').show();
                }else{
                    $('#form-troco').hide();
                }
            });

            $('#troco').on('change', function() {
                // alert( this.value );

                if(this.value == 'sim'){
                    $('#valor-troco').show();
                }else{
                    $('#valor-troco').hide();
                }
            });

        	$('#finalizar').click(function(){
        		$(this).hide();
        		$('#formulario').show();
        	});

        	$('#enviar').click(function(){

                if($('#nome').val() == ''){
                    alert('Digite o nome');
                    $('#nome').focus();
                    return false;
                }

                if($('#email').val() == ''){
                    alert('Digite o email');
                    $('#email').focus();
                    return false;
                }

                if($('#telefone').val() == ''){
                    alert('Digite o telefone');
                    $('#telefone').focus();
                    return false;
                }

				var pontos = [];
        		$.each($('#trajetos_table tbody tr'),function(i,v){
					pontos.push({
						origem:$(this).attr('data-origem'),
						complemento:$(this).attr('data-complemento'),
						'observacao':$(this).attr('data-obs'),
						'ordem': $(this).attr('data-ordem')
					});
        		});

        		/*recuperando informações de pagamento*/
                pagamento += '<b>Forma pagamento:</b> ' + $('#forma-pagamento').val() + '<br><b>Pagamento feito:</b> ' + $('#pagamento-feito').val();
                if($('#forma-pagamento').val() == 'dinheiro'){
                    pagamento += '<br><b>Troco para:</b> R$ ' + $("#valor-troco").val();
                }

                alert(pagamento);

        		$.ajax({
        			url: 'php/ControllerCliente.php?action=addCotacao',
        			data: {
        				valor: valorRoteiro,
                        base: base,
                        distancias: distancias,
                        distancia_total: distanciaTotal,
                        tempo: tempo,
        				descricao: $('#descricao').val(),
        				nome: $('#nome').val(),
        				email: $('#email').val(),
        				celular: $('#telefone').val(),
        				pontos: pontos,
                        pagamento: pagamento
        			},
        			'type': 'POST',
        			success: function(e){

        			    //alert(e);

        				if(e == '1'){
        					alert('Sua cotação foi enviada com sucesso. Estaremos entrando em contato em-breve');
        				}else{
        					alert('Desculpe, houve uma falha ao enviar sua cotação. Favor entrar em contato por telefone ou e-mail com um dos nossos atendentes.')
        				}

        				window.location.href = '';
        			}
        		});
        	});

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
                $('h1').text('Faça o cálculo do seu trajeto');
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

                if($('#origem-complemento').val() == ''){
                    alert('Digite um complemento para o ponto de origem');
                    $('#origem-complemento').focus();
                    return false;
                }

                if($('#destino-complemento').val() == ''){
                    alert('Digite um complemento para o ponto de destino');
                    $('#destino-complemento').focus();
                    return false;
                }

                if($('#origem-fazer').val() == ''){
                    alert('Digite fazer o que? Falar com quem? na origem');
                    $('#origem-fazer').focus();
                    return false;
                }

                if($('#destino-fazer').val() == ''){
                    alert('Digite fazer o que? Falar com quem? no destino');
                    $('#destino-fazer').focus();
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

                        $('#trajetos_table tbody').append('<tr '+attr+' >'+$td+'</tr>');
                    }
                    
                });

                $('h1').text('O cálculo do seu trajeto');
                $('#result,#form-roteiro').toggle();

                calculaPontos();

                setTimeout(function(){
                    $('#preloader').fadeOut();
                    // $('.preloader_img').delay(150).fadeOut('slow');
                }, 4100);
            });

            calculaPontos = function(){

                var origem = '';

                var trajetos = [];
                
                if($('#trajetos_table tbody tr').length < 2){
                    return false;
                }

                $.each($('#trajetos_table tbody tr'),function(index,value){
                    trajetos.push({
                        'ordem':$(this).attr('data-ordem'),
                        origem:$(this).attr('data-origem')
                    });
                });

                for(var item in trajetos){
                    console.log(trajetos[item,item]);
                }

                var tipoTransporte = '';
                if(document.getElementById("opcao1").checked === true){
                    tipoTransporte = 'moto';
                }else{
                    tipoTransporte = 'carro';
                }

                $.ajax({
                    url: 'php/ControllerCliente.php?action=calcPontos',
                    data: {trajetos: trajetos, transporte: tipoTransporte},
                    type: 'POST',
                    success: function(e){
                        var e = $.parseJSON(e);

                        // alert(e);

                        /*$.each(e['trajetos'],function(index,value){
                            $('#trajetos_table tr[data-ordem="'+index+'"]').attr('data-tempo',value['duration']['value']);
                            $('#trajetos_table tr[data-ordem="'+index+'"]').attr('data-distancia',value['distance']['value']);
                        });

                        alert($('#distancia_retorno').val(e['retorno']['distance']['value']));
                        alert($('#duracao_retorno').val(e['retorno']['duration']['value']));*/
                        base = e['base'];
                        valorRoteiro = e['valor_total'];
                        distancias = e['distancias'];
                        distanciaTotal = e['distancia_total'];
                        tempo = e['tempo'];
                        $('#distancia_total').text(e['total_distancia']+' Km');
                        // $('#tempo_total').text(e['total_tempo']);
                        $('#valor_roteiro').text(e['valor_total']);
                        $('#tempo').text(e['tempo']);
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

                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="radio" name="tipo_transporte" id="opcao1" checked> <i class="fa fa-motorcycle" style="font-size:24px"></i> Chamar motoboy
                                                <br><p style="font-size: 11px;">Para entregas de até 15kg e dimensões de até 30x30cm</p>
                                            </div>
                                            <div class="col-md-6">
                                            <input type="radio" name="tipo_transporte" id="opcao2"> <i class="fa fa-bus" style="font-size:24px"></i> Chamar Utilitário
                                            </div>
                                        </div><br>

                                        <label>Ponto de origem</label>

                                        <div class="row">
	                                        <div class="col-md-8">
		                                        <div class="input-group">
		                                            
		                                            <input style="margin-bottom: 5px" name="id_origem_cliente_edit" data-editor="true" data-editor-class="TextEdit" data-field-name="id_origem_cliente_edit" data-required-error-message="Trajeto é exigido." data-trajeto="Origem"  data-legacy-field-name="id_origem_cliente_edit" id="origem" data-pgui-legacy-validate="true" class="id_origem_cliente_edit form-control" value="" type="text" placeholder="Digite o endereço de origem" autocomplete="off">

		                                        </div><!-- /input-group -->
	                                        </div>
	                                        <div class="col-md-4">
	                                        	<input type="text" id="origem-complemento" placeholder="Exemplo: Bloco 1 Ap. 201" class="form-control complemento" />
	                                        </div>
                                        </div>

                                        <div class="input-group">
                                            <input type="text" id="origem-fazer" class="form-control observacao" placeholder="Fazer o que ? Falar com quem ?"/>
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
	                                        	<input type="text" id="destino-complemento" placeholder="Exemplo: Bloco 1 Ap. 201" class="form-control complemento" />
	                                        </div>
                                        </div>
                                        <div class="input-group">
                                            <input type="text" id="destino-fazer" class="form-control observacao" placeholder="Fazer o que ? Falar com quem ?"/>
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
                                    <span id="cotacao" class="btn btn-primary">Ver valor</span>
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
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                    </table>

                                    <div id="preloader"></div>

                                    <h4>Valor da ordem de serviço: <span id="valor_roteiro"></span></h4>
                                    <h4>Distância aproximada: <span id="distancia_total"></span></h4>
                                    <h4>Previsão duração: <span id="tempo"></span></h4>
                                    <br/>
                                	<span id="finalizar" class="btn btn-primary">Solicite seu serviço agora</span>
                                    <span id="voltar" class="btn btn-danger">Corrigir trajeto</span>

                                    <div style="display: none" id="formulario">
                                    	<div class="row">
	                                    	<div class="col-md-4">
	                                    		<input type="text" name="nome" id="nome" size="40" class="form-text" required="required" placeholder="Seu nome" aria-required="true">
	                                    	</div>
	                                    	<div class="col-md-4">
	                                    		<input type="text" name="email" id="email" size="40" class="form-text" required="required" placeholder="Seu e-mail" aria-required="true">
	                                    	</div>
	                                    	<div class="col-md-4">
	                                    		<input type="text" name="telefone" id="telefone" size="11" class="form-text" required="required" placeholder="Seu telefone" aria-required="true">
	                                    	</div>
	                                    	<div class="col-md-12">
	                                    		<textarea name="descricao" id="descricao" cols="40" rows="2" class="form-textarea" placeholder="Alguma observação?"></textarea>
	                                    	</div>
                                    	</div>
                                        <div class="row">
                                            <h4>Informações de pagamento:</h4>
                                            <div class="col-md-3">
                                                <label>Forma de Pagamento:</label>
                                                <select id="forma-pagamento">
                                                    <option value="cartao" selected>Cartao</option>
                                                    <option value="dinheiro">Dinheiro</option>
                                                    <option value="faturado">Faturado</option>
                                                    <option value="pagseguro">PagSeguro</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <label>Pagamento feito na:</label>
                                                <select id="pagamento-feito">
                                                    <option value="origem" selected>A. Origem</option>
                                                    <option value="destino">B. Destino</option>
                                                </select>
                                            </div>
                                            <div style="display: none" id="form-troco" class="row">
                                                <div class="col-md-4">
                                                    <label>Precisa de troco para?</label>
                                                    <select id="troco">
                                                        <option value="nao" selected>Não</option>
                                                        <option value="sim">Sim</option>
                                                    </select>
                                                    <input style="display: none" type="text" id="valor-troco" name="valor-troco" placeholder="Exemplo: 50" class="form-control complemento" />
                                                </div>
                                            </div>
                                        </div><br>

                                    	<span id="enviar" class="btn btn-primary">Finalizar pedido</span>
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
