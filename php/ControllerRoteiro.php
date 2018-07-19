<?php
require 'ControllerBd.php';

class ControllerRoteiro extends ControllerBd
{	

	function __construct()
	{
		parent::__construct();
	}


	public function getRoteiros() {

		$stmt = $this->conn->prepare("SELECT roteiros.* FROM roteiros INNER JOIN ordem_serv ON roteiros.id_ordem_serv = ordem_serv.id_ordem_serv WHERE ordem_serv.id_cliente = :id_cliente");		
		$stmt->bindParam(':id_cliente', $_SESSION['id_cliente']);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	public function find($table) {

		$limit = $table['limit'];
		$skip = $table['skip'];

		$sql = "SELECT 
		st_ordem_serv_item,
		DATE_FORMAT(dt_agendado,'%d/%m/%Y') as dt_agendado,
		ds_tarefa,
		origem.cp_completo as id_origem_cliente, 
		destino.cp_completo as id_destino_cliente
		FROM roteiros 
		INNER JOIN local_cliente as origem ON origem.id_local_cliente = roteiros.id_origem_cliente 
		INNER JOIN local_cliente as destino ON destino.id_local_cliente = roteiros.id_destino_cliente 
		INNER JOIN ordem_serv ON ordem_serv.id_ordem_serv = roteiros.id_ordem_serv 
		WHERE id_cliente = :id_cliente 
		LIMIT $limit OFFSET $skip";
	// 

		$stmt = $this->conn->prepare($sql);	
		$stmt->bindParam(':id_cliente', $_SESSION['id_cliente']);	
		
		$stmt->execute();

		return $stmt->fetchAll();
	}

}

$t = new ControllerRoteiro();

switch ($_GET['action']) {
	case 'getRoteiros':
		echo json_encode($t->find($_GET));
		break;
}