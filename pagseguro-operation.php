<?php
// definir base url
$protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
$domain = $protocol . $_SERVER['HTTP_HOST'] . '/';
define('BASE_URL', $domain);
define('SYS_DEBUG', false);

/***
 * Verificar se string é um CPF válido.
 *
 * @param $string
 * @return bool
 */
function is_CPF($string) {
    if ((strlen($string) == 14)) {
        $cpf = str_replace('.', '', $string);
        $cpf = str_replace('-', '', $cpf);
        $cpf = str_replace('_', '', $cpf);
        return strlen($cpf) == 11;
    }
    return false;
}

// validações de POST data
$validation_person_data = ( !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['cpf']) );
$validation_address_data = ( !empty($_POST['street']) && !empty($_POST['number']) && !empty($_POST['district']) && !empty($_POST['zip_code']) && !empty($_POST['city']) && !empty($_POST['state']) );

// valor informado via Form
$quantity = 0.00;

// alert error
$script_js = '<script type="text/javascript">alert("Informações importantes não foram preenchidas, tente novamente.");window.history.back();</script>';

// validação básica de dados
if ( !empty($_POST['quantity']) && $validation_person_data && $validation_address_data && is_CPF($_POST['cpf'])) {
    $quantity = (float) trim(str_replace('R$', '', $_POST['quantity']));
    if ($quantity <= 0.00) {
        echo $script_js;
        exit;
    }
} else {
    echo $script_js;
    exit;
}

require_once __DIR__ . "/vendor/autoload.php";

// init PagSeguro
\PagSeguro\Library::initialize();
\PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
\PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

// config environment
\PagSeguro\Configuration\Configure::setEnvironment( SYS_DEBUG ? 'sandbox' : 'production' );
\PagSeguro\Configuration\Configure::setCharset('UTF-8');// UTF-8 or ISO-8859-1
\PagSeguro\Configuration\Configure::setLog(SYS_DEBUG, __DIR__ . '/logs-pagseguro.log');
// config account credentials
\PagSeguro\Configuration\Configure::setAccountCredentials(
    'vendas@ssentregas.com.br',
    'A7C89AFA9AB34084A173FFD5F02191FF'
);

try {
    $sessionCode = \PagSeguro\Services\Session::create(
        \PagSeguro\Configuration\Configure::getAccountCredentials()
    );
} catch (Exception $e) {
    die($e->getMessage());
}

// Criar novo pagamento
$payment = new \PagSeguro\Domains\Requests\Payment();
$payment->addItems()->withParameters(
    '0001',
    'Pacote de Créditos SS Entregas',
    1,
    $quantity
);
$payment->setCurrency("BRL");
$payment->setReference("SSENTREGASPROD01");

// redirecionamentos
$payment->setRedirectUrl(BASE_URL . 'pagseguro-thanks.php');
$payment->setNotificationUrl(BASE_URL . 'pagseguro-notifications.php');

// Set your customer information.
$payment->setSender()->setName($_POST['name']);
$payment->setSender()->setEmail($_POST['email']);
$payment->setSender()->setPhone()->withParameters(
    ((int) str_replace(')', '', str_replace('(', '', explode(' ', $_POST['phone'])[0]))),
    ((int) explode(' ', $_POST['phone'])[1])
);
$payment->setSender()->setDocument()->withParameters('CPF', str_replace('-', '', str_replace('.', '', $_POST['cpf'])));

$payment->setShipping()->setAddress()->withParameters(
    $_POST['street'],
    $_POST['number'],
    $_POST['district'],
    $_POST['zip_code'],
    $_POST['city'],
    $_POST['state'],
    'BRA'
);
$payment->setShipping()->setCost()->withParameters(0.00);
$payment->setShipping()->setType()->withParameters(\PagSeguro\Enum\Shipping\Type::NOT_SPECIFIED);

// Add a group and/or payment methods name
$payment->acceptPaymentMethod()->groups(
    \PagSeguro\Enum\PaymentMethod\Group::CREDIT_CARD,
    \PagSeguro\Enum\PaymentMethod\Group::BALANCE
);
$payment->acceptPaymentMethod()->name(\PagSeguro\Enum\PaymentMethod\Name::DEBITO_ITAU);
// Remove a group and/or payment methods name
$payment->excludePaymentMethod()->group(\PagSeguro\Enum\PaymentMethod\Group::BOLETO);

try {

    $result = $payment->register(
        \PagSeguro\Configuration\Configure::getAccountCredentials()
    );

    // redirecionar para URL de pagamento
    if ($result) {
        echo '<script>window.location.replace("'. $result .'");</script>';
    }

} catch (Exception $e) {
    die($e->getMessage());
}