<?php
include_once "PagSeguroLibrary/PagSeguroLibrary.php";

/**
 * Class with a main method to illustrate the usage of the domain class PagSeguroPaymentRequest
 */
class CreatePaymentRequestLightbox
{
    public $vlr_credito;
    public $id;
    public $nome;
    public $email;
    public $ddd;
    public $numero;

	public function main()
	{
		// Instantiate a new payment request
		$paymentRequest = new PagSeguroPaymentRequest();
		
		// Set the currency
		$paymentRequest->setCurrency("BRL");

		// Add an item for this payment request					
		$paymentRequest->addItem('0001', 'Créditos - SSEntregas', 1, $this->vlr_credito);

		// Set a reference code for this payment request, it is useful to identify this payment
		// in future notifications.
		$paymentRequest->setReference('SBMCPE_'.$this->id);

		// Set shipping information for this payment request
		
		$sedexCode = PagSeguroShippingType::getCodeByType('NOT_SPECIFIED');

		// Set your customer information.
		$paymentRequest->setSender(
			$this->nome,
			$this->email,
			$this->ddd,
			$this->numero
		);

		// Set the url used by PagSeguro to redirect user after checkout process ends
		$paymentRequest->setRedirectUrl("http://www.ssentregas.com.br/area_cliente.php");	
		
		try 
		{
			/*
			 * #### Credentials #####
			 * Replace the parameters below with your credentials (e-mail and token)
			 * You can also get your credentials from a config file. See an example:
			 * $credentials = PagSeguroConfig::getAccountCredentials();
			 */
			$credentials = new PagSeguroAccountCredentials("vendas@ssentregas.com.br","0FC37C7DDC114CFB95DF30F7DD9E909A");
			// Register this payment request in PagSeguro to obtain the checkout code
			$onlyCheckoutCode = true;
			$code = $paymentRequest->register($credentials, $onlyCheckoutCode);

		} 	
		catch (PagSeguroServiceException $e) 
		{ 
			die($e->getMessage());
		}
        return $code;
	}
}