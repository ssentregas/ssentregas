<?php
require 'ControllerBd.php';

class ControllerOrdemServico extends ControllerBd
{	

	function __construct()
	{
		parent::__construct();
	}


	public function getOrdemServ() {

		$stmt = $this->conn->prepare("SELECT * FROM ordem_serv WHERE id_cliente = :id_cliente");		
		$stmt->bindParam(':id_cliente', $_SESSION['id_cliente']);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function find($table) {

		$limit = $table['limit'];
		$skip = $table['skip'];

		$sql = "SELECT 
		st_ordem_serv,
		st_pagamento,
		DATE_FORMAT(dt_inicio,'%d/%m/%Y') as dt_inicio,
		tarifa.nm_tarifa as id_tarifa, 
		forma_pagto.descricao as id_forma_pagto
		FROM ordem_serv 
		INNER JOIN tarifa as tarifa ON tarifa.id_tarifa = ordem_serv.id_tarifa 
		INNER JOIN forma_pagto as forma_pagto ON forma_pagto.id_forma_pagto = ordem_serv.id_forma_pagto 
		WHERE 
		id_cliente = :id_cliente 
		LIMIT $limit OFFSET $skip";

		$stmt = $this->conn->prepare($sql);		
		$stmt->bindParam(':id_cliente', $_SESSION['id_cliente']);
		$stmt->execute();

		return $stmt->fetchAll();
	}

}

$t = new ControllerOrdemServico();

switch ($_GET['action']) {
	case 'getOrdemServ':
		echo json_encode($t->find($_GET));
		break;
}