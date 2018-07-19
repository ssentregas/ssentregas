<?php include('layout/header.html'); ?>

    <script src="assets/js/jquery.geocomplete.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLCCzFgc_7tERqPJsIDDL7MghDMcdViy8&libraries=places&sensor=false"></script>
    <!-- Form Validation -->
    <script src="assets/js/validate.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){

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


            $('.add_coleta,.add_entrega,.add_extra').click(function(){

                
                if($('.id_origem_cliente_edit').val() == ''){
                    alert('Digite um endereço do trajeto');
                    return false;
                }

                var tipo = '';
                if($('#id_tipo_acao_origem_edit').is(':visible')){
                    tipo = $('#id_tipo_acao_origem_edit').val();
                }

                var acao = '';
                if($('#id_tipo_acao_origem_edit:visible').val())
                    acao = $('#id_tipo_acao_origem_edit').val();

                attr = 'data-origem="'+$('.id_origem_cliente_edit:visible').val()+'"  ';
                attr += 'data-complemento="'+$('#complemento').val()+'" ';
                attr += 'data-tipo="'+tipo+'" ';
                attr += 'data-tarefa="'+$('#tarefa').val()+'" ';
                attr += 'data-obs="'+$('#observacao_edit').val()+'" ';
                attr += 'data-acao="'+acao+'" ';
                attr += 'data-ordem="'+$('#trajetos_table tbody tr').length+'" ';
                attr += 'data-distancia="" ';
                attr += 'data-tempo=""';


                $('#trajetos_table tbody').append('<tr '+attr+' ><td>'+$('.id_origem_cliente_edit:visible').val()+'</td>'+$(this).attr('data-trajeto')+'<td><i class="icon-remove">Excluir</i></td></tr>');

                $('#form-trajeto input, #form-trajeto select, #form-trajeto textarea').val('');

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
                                    <div style="width:100%;max-width:100%">

                                        <div class="input-group">
                                            
                                            <input style="" name="id_origem_cliente_edit" data-editor="true" data-editor-class="TextEdit" data-field-name="id_origem_cliente_edit" data-required-error-message="Trajeto é exigido." data-validation="required" data-legacy-field-name="id_origem_cliente_edit" data-pgui-legacy-validate="true" class="id_origem_cliente_edit form-control" value="" type="text" placeholder="Digite o endereço do trajeto" autocomplete="off">
                                            <br/>
                                            <span class="input-group-addon">
                                                <span data-trajeto="Coleta" class="add_coleta btn btn-primary">Adicionar Coleta</span>
                                                <span data-trajeto="Entrega" class="add_entrega btn btn-primary">Adicionar Entrega</span>
                                                <span data-trajeto="Ponto Extra" class="add_extra btn btn-primary">Adicionar Trajeto Extra</span>
                                            </span>

                                        </div><!-- /input-group -->
                                    </div>


                                </form>

                                <table id="trajetos_table" class="table text-center table-striped">
                                    <thead>
                                        <tr>
                                            <th>Trajeto</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                </table>

                                <h4>Valor da Ordem de Serviço: R$ <span id="valor_roteiro"></span></h4>

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
