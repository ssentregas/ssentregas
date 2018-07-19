<?php
header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

define('SYS_DEBUG', false);
require_once __DIR__ . '/vendor/autoload.php';

$mail = new \PHPMailer\PHPMailer\PHPMailer(true); // Passing `true` enables exceptions

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
    if (\PagSeguro\Helpers\Xhr::hasPost()) {

        $response = \PagSeguro\Services\Transactions\Notification::check(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        if (!$response) {
            throw new \Exception();
        }

        $sender = $response->getSender();
        $address = $response->getShipping()->getAddress();

        // identificar documento do comprador
        $document = null;
        if (count($response->getSender()->getDocuments()) > 0) {
            $document = $response->getSender()->getDocuments()[0];
        }

        //Server settings
        $mail->SMTPDebug = ( SYS_DEBUG ? 2 : 0 );// debug 2 | no debug 0
        $mail->isSMTP();  // Set mailer to use SMTP
        $mail->Host = 'ssentregas.com.br';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'teste@ssentregas.com.br'; // SMTP username
        $mail->Password = 'SS@entregas2018'; // SMTP password
        //$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587; // TCP port to connect to

        // Recipients
        $mail->setFrom('teste@ssentregas.com.br', 'SS Entregas');
        $mail->isHTML(true);
        $mail->CharSet = 'utf8';
        $mail->addAddress('teste@ssentregas.com.br', 'SS Entregas ( Vendas )');
        $mail->Subject = 'Novo Pagamento - PagSeguro';
        $mail->Body = (
            '<div style="width: 100%; margin: auto;background-color: #f9f9f9;">'.
            '<div style="width: 700px; margin: auto;color: #3f3f3f;padding:20px;font-size: 14px !important;">'.
            '<h2>Novo Pagamento</h2>'.
            'Segue abaixo informações a respeito do novo pagamento:<br/>'.
            'Obs.: Dados completos estão disponíveis na seção "Transações" via plataforma do PagSeguro.'.
            '<br/><br/>'.
            '<table style="font-size: 11px !important;margin: auto;text-align: left !important;">'.
            '<thead><tr>'.
            '<th style="padding: 5px; border: 1px solid #cecece;width: 100px;">Comprador(a)</th>'.
            '<th style="padding: 5px; border: 1px solid #cecece;width: 100px;">CPF / CNPJ / RG</th>'.
            '<th style="padding: 5px; border: 1px solid #cecece;">E-Mail</th>'.
            '<th style="padding: 5px; border: 1px solid #cecece;">Fone</th>'.
            '<th style="padding: 5px; border: 1px solid #cecece;">Valor Líquido</th>'.
            '<th style="padding: 5px; border: 1px solid #cecece;">Valor Bruto</th>'.
            '</tr></thead><tbody><tr>'.
            '<td style="padding: 5px; border: 1px solid #cecece;">'. ( $sender->getName() ? $sender->getName() : 'Não Informado...' ) .'</td>'.
            '<td style="padding: 5px; border: 1px solid #cecece;">'. ( is_object($document) ? ( $document->getIdentifier() !== NULL ? $document->getIdentifier() : 'Não Informado...' ) : 'Não Informado...' ) .'</td>'.
            '<td style="padding: 5px; border: 1px solid #cecece;">'. ( $sender->getEmail() ) .'</td>'.
            '<td style="padding: 5px; border: 1px solid #cecece;">('. $sender->getPhone()->getAreaCode() .') '. $sender->getPhone()->getNumber() .'</td>'.
            '<td style="padding: 5px; border: 1px solid #cecece;">R$ '. $response->getNetAmount() .'</td>'.
            '<td style="padding: 5px; border: 1px solid #cecece;">R$ '. $response->getGrossAmount() .'</td>'.
            '</tr><tr>'.
            '<td colspan="6" style="padding: 5px; border: 1px solid #cecece;">'.
            '<b>Endereço:</b>'.
            ' Rua '. $address->getStreet() .', N° '. $address->getNumber() .', '. $address->getDistrict() .', '.
            $address->getCity() .', '. $address->getState() .', CEP - '. $address->getPostalCode() .
            '</td></tr></tbody></table>'.
            '<br/>'.
            '<div style="width: 100%;margin-top: 20px;text-align: center; color: #696969;font-size: 11px;">© SS Entregas - Vendas</div>'.
            '</div></div>'
        );
        $mail->AltBody = 'Alerta de novos pagamentos realizados na plataforma.';

        if ($mail->send()) {
            http_response_code(200);
            exit;
        } else {
            throw new \InvalidArgumentException($_POST);
        }
    } else {
        throw new \InvalidArgumentException($_POST);
    }

} catch (Exception $e) {
    http_response_code(500);
    exit;
}