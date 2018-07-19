<?php include('layout/header.html'); ?>

<style>
    form#form-pagseguro {
        display: block;
        color: #111111 !important;
        padding: 0px !important;
        margin: 0px;
        width: 100%;
    }
    form#form-pagseguro label {
        display: inline-block !important;
        width: 120px;
        text-align: right;
        color: #111111 !important;
        font-size: 13px !important;
    }
    form#form-pagseguro input, form#form-pagseguro select {
        display: inline-block !important;
        padding: 4px;
        width: 50%;
        font-size: 13px !important;
        color: #111111 !important;
        border-radius: 5px;
        border: 1px solid #cecece;
    }
    form#form-pagseguro hr {
        display: block;
        padding: 0px;
        margin: 3px 0px 3px 0px;
        width: 100%;
        border: none;
        border-top: 1px solid #f5f5f5;
    }
    form#form-pagseguro button {
        background-color: #96ca2d;
        border: 1px solid #96ca2d;
        font-family: "Montserrat", Helvetica, Arial, sans-serif;
        font-size: 12px;
        transition: all 150ms ease-out;
        padding: 0 20px;
        border-radius: 2px;
        height: 40px;
        line-height: 40px;
        margin-bottom: 10px;
        text-align: center;
        width: auto;
        margin-left: 120px;
        cursor: pointer;
        color: #FFFFFF;
        margin-top: 20px;
    }
    form#form-pagseguro button:hover {
        background-color: #80a821;
        border: 1px solid #80a821;
    }
    form#form-pagseguro #cpf, form#form-pagseguro #cep , form#form-pagseguro #phone {
        width: 130px;
    }
    form#form-pagseguro #number {
        width: 80px;
    }
</style>
<!-- Contact form -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="assets/js/jquery.maskMoney.min.js"></script>
<script type="text/javascript">

    // Limpa valores do formulário de cep.
    function clearAddressInputs() {
        $("#street").val("");
        $("#district").val("");
        $("#city").val("");
        $("#state").val("");
    }

    function getAddressByCEP() {
        var cep = $("#cep").val();

        // validar CEP.
        if (cep != "" && (cep.substr(cep.length - 1) !== '_')) {
            // Consulta o webservice viacep.com.br/
            $.ajax({
                type: 'GET',
                url: 'https://viacep.com.br/ws/'+ cep +'/json',
                success: function (result) {
                    if (!("erro" in result)) {
                        // preencher campos
                        $("#street").val(result.logradouro);
                        $("#district").val(result.bairro);
                        $("#city").val(result.localidade);
                        $("#state").val(result.uf);
                    }
                },
                error: function () { }
            });
        }
    }

    $(document).ready(function () {
        $("#cpf").mask("999.999.999-99");
        $("#cep").mask("99999-999");
        $("#phone").mask("(99) 999999999");
        $(".money").maskMoney({ prefix: 'R$ ' });
    });

</script>

<div class="container">
    <div class="row">
        <div class="col-xs-12  col-md-9 col-md-push-3" role="main">
            <div class="content-container">
                <div class="main-title" style="margin-bottom: 3px !important;">
                    <h1 class="main-title__primary">Adquirir Créditos</h1>
                    <h3 class="main-title__secondary">Sua compra protegida pelos serviços do PagSeguro.</h3>
                </div>
                <article>

                    <div class="panel-grid row m-b-0">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                            <div class="textwidget">
                                <div role="form" lang="en-US" dir="ltr">
                                    <form id="form-pagseguro" method="post" action="pagseguro-operation.php">

                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                                <h4 style="color: #3d3d3d;margin-top: 20px;">
                                                    Dados Pessoais
                                                </h4>
                                                <hr/>

                                                <label for="name">Nome Completo</label>
                                                <input id="name" name="name" placeholder="Nome Completo" required />
                                                <hr/>
                                                <label for="email">E-Mail</label>
                                                <input id="email" type="email" name="email" placeholder="E-Mail" required />
                                                <hr/>
                                                <label for="phone">Fone</label>
                                                <input id="phone" name="phone" placeholder="Fone" required />
                                                <hr/>
                                                <label for="cpf">CPF</label>
                                                <input id="cpf" name="cpf" placeholder="CPF" required />
                                                <!-- valor teste by: https://www.geradordecpf.org/ -->
                                                <hr/>

                                                <h4 style="color: #3d3d3d;margin-top: 20px;">
                                                    Endereço
                                                </h4>
                                                <hr/>

                                                <label for="cep">CEP</label>
                                                <input type="text" class="cep" id="cep" name="zip_code" placeholder="CEP" onkeyup="getAddressByCEP()" required />
                                                <hr/>
                                                <label for="number">Número</label>
                                                <input type="text" id="number" name="number" placeholder="Número" required />
                                                <hr/>
                                                <label for="street">Rua</label>
                                                <input type="text" id="street" name="street" placeholder="Rua" required />
                                                <hr/>
                                                <label for="district">Bairro</label>
                                                <input type="text" id="district" name="district" placeholder="Bairro" required />
                                                <hr/>
                                                <label for="city">Cidade</label>
                                                <input type="text" id="city" name="city" placeholder="Cidade" required />
                                                <hr/>
                                                <label for="state">Estado</label>
                                                <select id="state" name="state" required >
                                                    <option value="">Selecione...</option>
                                                    <option value="AC">Acre</option>
                                                    <option value="AL">Alagoas</option>
                                                    <option value="AP">Amapá</option>
                                                    <option value="AM">Amazonas</option>
                                                    <option value="BA">Bahia</option>
                                                    <option value="CE">Ceará</option>
                                                    <option value="DF">Distrito Federal</option>
                                                    <option value="ES">Espírito Santo</option>
                                                    <option value="GO">Goiás</option>
                                                    <option value="MA">Maranhão</option>
                                                    <option value="MT">Mato Grosso</option>
                                                    <option value="MS">Mato Grosso do Sul</option>
                                                    <option value="MG">Minas Gerais</option>
                                                    <option value="PR">Paraná</option>
                                                    <option value="PB">Paraíba</option>
                                                    <option value="PA">Pará</option>
                                                    <option value="PE">Pernambuco</option>
                                                    <option value="PI">Piauí</option>
                                                    <option value="RJ">Rio de Janeiro</option>
                                                    <option value="RN">Rio Grande do Norte</option>
                                                    <option value="RS">Rio Grande do Sul</option>
                                                    <option value="RO">Rondônia</option>
                                                    <option value="RR">Roraima</option>
                                                    <option value="SC">Santa Catarina</option>
                                                    <option value="SE">Sergipe</option>
                                                    <option value="SP">São Paulo</option>
                                                    <option value="TO">Tocantins</option>
                                                </select>
                                                <hr/>

                                                <h4 style="color: #3d3d3d;margin-top: 20px;">
                                                    Quantia(R$)
                                                </h4>
                                                <hr/>
                                                <label for="quantity">Valor</label>
                                                <input type="text" id="quantity" name="quantity" class="money" placeholder="Ex.: R$ 50.00" required />
                                                <hr/>

                                                <button type="submit">CONFIRMAR</button>

                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </article>
            </div> <!-- // end .content-container -->
        </div>
        <div class="col-xs-12  col-md-3  col-md-pull-9">

            <div class="sidebar">
                <?php include('layout/menu.php'); ?>

                <div class="widget  widget-about-us">
                    <div id="carousel-people-pw_about_us-2" class="carousel slide" data-ride="carousel"
                         data-interval="false">
                        <div class="carousel-inner" role="listbox">
                            <div class="item active"><a href="about.php" class="about-us__tag">CONTA CORRENTE SS
                                    Entregas</a><img class="about-us__image" src="assets/images/image-51.jpg"
                                                     alt="About us image">
                                <h5 class="about-us__name">Abra uma conta corrente e facilite sua vida</h5>
                                <p class="about-us__description">Abra uma conta corrente com a SS Entregas, é rápido de
                                    abrir, fácil de controlar e seguro.</p>
                                <p class="about-us__description">Cadastre-se como cliente da SS Entregas e coloque
                                    créditos através de boleta ou cartão de crédito, assim você pode fazer sua
                                    solicitação de entrega online, de forma rápida e independente.</p>
                                <a href="about.php" class="read-more  about-us__link">Saiba mais</a></div>
                        </div>
                    </div>
                </div>
                <div class="widget  widget-skype">
                    <a class="skype-button" href="skype:ssentregasbarra"> <i class="fa  fa-skype"></i>
                        <p class="skype-button__title">Ligue pelo Skype</p>
                    </a>
                </div>

            </div> <!-- ========  // END SIDEBAR ======== -->
        </div>
    </div> <!-- // end .row -->
</div> <!-- // end .container -->

<?php include('layout/footer.html'); ?>
