<?php
require 'ControllerBd.php';

if(!isset($_SESSION['id_cliente'])) {
	echo '3';
	exit();
}

require 'CreatePaymentRequestLightbox.php';

class ControllerCreditos extends ControllerBd
{
	public $vlr_credito;
	public $id;

	function __construct()
	{
		parent::__construct();
	}

	public function add() {

		$sql = "INSERT INTO credito(id_cliente, vlr_credito, st_credito, dt_inclusao) VALUES (:id_cliente, :vlr_credito, 'Aguardando', :dt_inclusao)";
		$stmt = $this->conn->prepare($sql);

		$data = date('Y-m-d H:i:s');

		$stmt->bindParam(':id_cliente', $_SESSION['id_cliente']);
		$stmt->bindParam(':vlr_credito', $this->vlr_credito);
		$stmt->bindParam(':dt_inclusao', $data);
	 	
	 	$return = $stmt->execute();

	 	if($return)
	 		$this->id = $this->conn->lastInsertId();	
	 	
	 	return $return;
	}

	public function getPerfil() {

		$stmt = $this->conn->prepare("SELECT * FROM cliente WHERE id_cliente = :id_cliente");		
		$stmt->bindParam(':id_cliente', $_SESSION['id_cliente']);
		$stmt->execute();

		return $stmt->fetch();
	}
}

$t = new ControllerCreditos();
$t->vlr_credito = $_POST['vlr_credito'];

switch ($_GET['action']) {
	case 'add':
		
		if($t->add()) {

			
			$cls = new CreatePaymentRequestLightbox();
			$cls->vlr_credito = number_format($t->vlr_credito,2);
			$cls->id = $t->id;
			
			$cliente = $t->getPerfil();

			$vowels    = array("-", "(", ")", "/", ".", " ");
			$cp_numero = str_replace($vowels, "", $cliente['celular']);

			$cls->nome = $cliente['nm_cliente'];
			$cls->email = $cliente['email'];
			$cls->ddd=substr($cp_numero,0,2);
			$cls->numero=substr($cp_numero,2);

			echo $cls->main();
		}
	break;
}

