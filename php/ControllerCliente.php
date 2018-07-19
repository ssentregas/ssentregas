<?php
require 'ControllerBd.php';
require 'ControllerMail.php';

/**
* 
*/
class ControllerCliente extends ControllerBd
{	

	function __construct()
	{
		parent::__construct();
	}

	public function getPerfil() {

		$stmt = $this->conn->prepare("SELECT * FROM cliente WHERE id_cliente = :id_cliente");		
		$stmt->bindParam(':id_cliente', $_SESSION['id_cliente']);
		$stmt->execute();

		return $stmt->fetch();
	}

	public function find() {

		$result = $this->conn->query("SELECT * FROM cliente LIMIT 1");
		print_r($result->fetchAll());
	}


	/*INICIO CALCULO VALOR A PAGAR PELOS TRAJETOS*/

    public function calcPontos($dados){
        $dist_pontos_real = 0;
        $dist_pontos_aux = 0;
        $dist_base = 0;
        $dist_base_coleta = 0;
        $dist_entrega_base = 0;
        $total_km = 0;
        $total_pagar = 0;
        $base = '';
        $trajetos = array();
        $total_tempo = 0;
        $valor_adicional = 0;

        foreach ($dados['trajetos'] as $key => $value) {
            array_push($trajetos, $value['origem']);
        }

        /*Calcula distância entre os pontos do trajeto*/
        for ($i = 0; $i < count($trajetos) - 1; $i++) {
            $aux = $this->consultaGoogle($trajetos[$i], $trajetos[$i + 1]);

            /*verifica se é inferior a 12 km caso sim arredonda para 12km quilometragem minima para cada ponto*/
            if($aux['distance']['value'] < 12){
                $dist_pontos_aux += 12;
            }else{
                $dist_pontos_aux += $aux['distance']['value'];
            }

            $dist_pontos_real += $aux['distance']['value'];
            $total_tempo += $aux['duration']['value'];
        }

        /*calculando distrancias entre base e pontos iniciais e finais*/
        $base_barra_pontoinicial = $this->consultaGoogle('Av. das Américas, 2300 - Barra da Tijuca, Rio de Janeiro - RJ, 22640-101, Brasil', $trajetos[0]);
        $base_barra_pontofinal = $this->consultaGoogle('Av. das Américas, 2300 - Barra da Tijuca, Rio de Janeiro - RJ, 22640-101, Brasil', $trajetos[count($trajetos) - 1]);

        $base_saocristovao_pontoinicial = $this->consultaGoogle('R. do Bonfim, 363 - São Cristóvão, Rio de Janeiro - RJ, 20930-450, Brasil', $trajetos[0]);
        $base_saocristovao_pontofinal = $this->consultaGoogle('R. do Bonfim, 363 - São Cristóvão, Rio de Janeiro - RJ, 20930-450, Brasil', $trajetos[count($trajetos) - 1]);

        if ($base_saocristovao_pontoinicial['distance']['value'] > 20.000) {
            $dist_base += $base_barra_pontoinicial['distance']['value'];
            $total_tempo += $base_barra_pontoinicial['duration']['value'];
            $dist_base += $base_barra_pontofinal['distance']['value'];
            $dist_base_coleta = $base_barra_pontoinicial['distance']['value'];
            $dist_entrega_base = $base_barra_pontofinal['distance']['value'];
            $base = 'Barra';
        } else {
            if ($base_barra_pontoinicial['distance']['value'] < $base_saocristovao_pontoinicial['distance']['value']) {
                $dist_base += $base_barra_pontoinicial['distance']['value'];
                $total_tempo += $base_barra_pontoinicial['duration']['value'];
                $dist_base += $base_barra_pontofinal['distance']['value'];
                $dist_base_coleta = $base_barra_pontoinicial['distance']['value'];
                $dist_entrega_base = $base_barra_pontofinal['distance']['value'];
                $base = 'Barra';
            } else {
                $dist_base += $base_saocristovao_pontoinicial['distance']['value'];
                $total_tempo += $base_saocristovao_pontoinicial['duration']['value'];
                $dist_base += $base_saocristovao_pontofinal['distance']['value'];
                $dist_base_coleta = $base_saocristovao_pontoinicial['distance']['value'];
                $dist_entrega_base = $base_saocristovao_pontofinal['distance']['value'];
                $base = 'São Cristovão';
            }
        }

        $total_km = $dist_pontos_aux + $dist_base;

        /*calculando valor da km moto*/
        if($dados['transporte'] == 'moto') {

            $stmt = $this->conn->prepare("SELECT valor_km, valor_ponto_extra FROM tarifa WHERE tipo_transporte = :tipo_transporte AND perimetro_inicial = :perimetro_inicial AND perimetro_final = :perimetro_final LIMIT 1");
            $tipo_transporte = 'moto';
            $tarifa = '';
            $perimetro_inicial = 0;
            $perimetro_final = 0;

            if ($total_km <= 120.000) {
                $perimetro_inicial = 0;
                $perimetro_final = 120000;
                $stmt->bindParam(':tipo_transporte',$tipo_transporte);
                $stmt->bindParam(':perimetro_inicial',$perimetro_inicial);
                $stmt->bindParam(':perimetro_final',$perimetro_final);
                $stmt->execute();
                $tarifa = $stmt->fetch();
                $total_pagar = $total_km * $tarifa['valor_km'];
            } else if ($total_km > 120.000 and $total_km <= 200.000) {
                $perimetro_inicial = 120000;
                $perimetro_final = 200000;
                $stmt->bindParam(':tipo_transporte',$tipo_transporte);
                $stmt->bindParam(':perimetro_inicial',$perimetro_inicial);
                $stmt->bindParam(':perimetro_final',$perimetro_final);
                $stmt->execute();
                $tarifa = $stmt->fetch();
                $total_pagar = $total_km * $tarifa['valor_km'];
            } else if ($total_km > 200.000) {
                $perimetro_inicial = 200000;
                $perimetro_final = 0;
                $stmt->bindParam(':tipo_transporte',$tipo_transporte);
                $stmt->bindParam(':perimetro_inicial',$perimetro_inicial);
                $stmt->bindParam(':perimetro_final',$perimetro_final);
                $stmt->execute();
                $tarifa = $stmt->fetch();
                $total_pagar = $total_km * $tarifa['valor_km'];
            }

            /*calculando taxa para pontos adicionais*/
            if (count($trajetos) > 2) {
                $pontos_extra = count($trajetos) - 2;
                $valor_adicional = $pontos_extra * $tarifa['valor_ponto_extra'];
                $total_pagar += $valor_adicional;
            }

            /*adicionando duas casas decimais*/
            $total_pagar = number_format($total_pagar, 2, '.', ',');

            if ($total_pagar < 30.00) {
                $total_pagar = 30.00;
            }

        }else{
            $stmt = $this->conn->prepare("SELECT valor_km, valor_ponto_extra FROM tarifa WHERE tipo_transporte = :tipo_transporte AND perimetro_inicial = :perimetro_inicial AND perimetro_final = :perimetro_final LIMIT 1");
            $tipo_transporte = 'carro';
            $tarifa = '';
            $perimetro_inicial = 0;
            $perimetro_final = 0;

            if ($total_km <= 120.000) {
                $perimetro_inicial = 0;
                $perimetro_final = 120000;
                $stmt->bindParam(':tipo_transporte',$tipo_transporte);
                $stmt->bindParam(':perimetro_inicial',$perimetro_inicial);
                $stmt->bindParam(':perimetro_final',$perimetro_final);
                $stmt->execute();
                $tarifa = $stmt->fetch();
                $total_pagar = $total_km * $tarifa['valor_km'];
            } else if ($total_km > 120.000 and $total_km <= 200.000) {
                $perimetro_inicial = 120000;
                $perimetro_final = 200000;
                $stmt->bindParam(':tipo_transporte',$tipo_transporte);
                $stmt->bindParam(':perimetro_inicial',$perimetro_inicial);
                $stmt->bindParam(':perimetro_final',$perimetro_final);
                $stmt->execute();
                $tarifa = $stmt->fetch();
                $total_pagar = $total_km * $tarifa['valor_km'];
            } else if ($total_km > 200.000) {
                $perimetro_inicial = 200000;
                $perimetro_final = 0;
                $stmt->bindParam(':tipo_transporte',$tipo_transporte);
                $stmt->bindParam(':perimetro_inicial',$perimetro_inicial);
                $stmt->bindParam(':perimetro_final',$perimetro_final);
                $stmt->execute();
                $tarifa = $stmt->fetch();
                $total_pagar = $total_km * $tarifa['valor_km'];
            }

            /*calculando taxa para pontos adicionais*/
            if (count($trajetos) > 2) {
                $pontos_extra = count($trajetos) - 2;
                $valor_adicional = $pontos_extra * $tarifa['valor_ponto_extra'];
                $total_pagar += $valor_adicional;
            }

            /*adicionando duas casas decimais*/
            $total_pagar = number_format($total_pagar, 2, '.', ',');

            if ($total_pagar < 90.00) {
                $total_pagar = 90.00;
            }
        }

        /*motando o array de resposta com os dados*/
        $distancia_total = str_replace(".", ",", $total_km);
        $distancia_base = str_replace(".", ",", $dist_base);
        $distancia_pontos = str_replace(".", ",", $dist_pontos_real);


        //calculando tempo total
        $minutos = ceil($total_tempo/60);
        $tempo  = floor($minutos/60).':'.$minutos%60;

        $return = array(
            'base' => $base,
            'distancias' => '<b>Total:</b> '. $distancia_total . ' km<br><b>Base:</b> '. $base. '<br><b>Base -> Coleta:</b> '. $dist_base_coleta . ' km<br><b>Coleta -> Entrega:</b> '. $dist_pontos_real .' km<br><b>Entrega -> Base:</b> '. $dist_entrega_base .' km',
            'tempo' => $tempo,
            'distancia_total' => $distancia_total,
            'total_distancia' => $distancia_pontos,
            'valor_total' => number_format(floor($total_pagar), 2, ',', '.') . ' R$'
        );

        echo json_encode($return);

        //return $total_pagar . 'base barra:' . $base_barra . 'base saocristovao:' . $base_saocristovao . ' distancia ponto:' . $dist_pontos . ' distancia_base:'. $dist_base . ' distancia_total:' . $total_km;

    }

    public function consultaGoogle($origem,$destino){

        $cp_result=urlencode($origem).'&destinations='.urlencode($destino);

        $url='https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$cp_result.'&key=AIzaSyC0fuLnMKGSsFjngKaQbDg2I2t9HxBcH2s';


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);


        if($data === FALSE) {
            die(curl_error($curl));
        }
        else {
            $r = json_decode($data);

            $ret = array();
            $e = $r->rows[0]->elements[0];

            $ret['distance'] = array('text'=>$e->distance->text,'value'=>($e->distance->value/1000));

            $duration = $e->duration->value/2;
            $ret['duration'] = array('text'=>$e->duration->text,'value'=>$e->duration->value+$duration);

            return $ret;
        }
    }

    /*FIM CALCULO VALOR A PAGAR PELOS TRAJETOS*/

	public function addCotacao($dados){

        //salvando contato do cliente
	    /*$dados_cliente = array(
            'nome'  => $dados['nome'],
            'email'  => $dados['email'],
            'celular'  => $dados['celular'],
        );

        $this->addCliente($dados_cliente);*/

        //salvando pontos e calculando valor e distância
        $ponto = array('Origem','Destino','Ponto Extra');

        $mensagem = '';

        foreach ($dados['pontos'] as $key => $value) {

            $ds_ponto = isset($ponto[$value['ordem']]) ? $ponto[$value['ordem']] : $ponto[2];

            $mensagem .= '<b>'.$ds_ponto.'</b>: '.$value['origem'];
            $mensagem .= '<br><b>Complemento:</b> '.$value['complemento'];
            $mensagem .= '<br><b>Tarefa:</b> '.$value['observacao'];
            $mensagem .= '<br><br>';
        }

        $sql = "INSERT INTO entrega(nome, telefone, email, valor, trajeto, base, distancias, distancia_total, tempo, observacao, date_created, last_updated, status_entrega, version) VALUES (:nome, :telefone, :email, :valor, :trajeto, :base, :distancias, :distancia_total, :tempo, :observacao, :date_created, :last_updated, :status_entrega, 1)";
        $stmt = $this->conn->prepare($sql);

        $data = date('Y-m-d H:i:s');

//        $contato =  '<b>Nome:</b> '.$dados['nome'] . '<br><b>Email:</b> ' .$dados['email'] . '<br><b>Telefone:</b> '.$dados['celular'];

        $status_entrega = 'PEDIDO';

        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':telefone', $dados['celular']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':valor', $dados['valor']);
        $stmt->bindParam(':trajeto', $mensagem);
        $stmt->bindParam(':base', $dados['base']);
        $stmt->bindParam(':distancias', $dados['distancias']);
        $stmt->bindParam(':distancia_total', $dados['distancia_total']);
        $stmt->bindParam(':tempo', $dados['tempo']);
        $stmt->bindParam(':observacao', $dados['descricao']);
        $stmt->bindParam(':date_created', $data);
        $stmt->bindParam(':last_updated', $data);
        $stmt->bindParam(':status_entrega', $status_entrega);

        return $stmt->execute();

        /*$mensagem .= $dados['descricao'];
        $mensagem .= '<br><br>Valor cobrado: R$ '.$dados['valor'];
        $mensagem .= '<br><br>Nome do contato: '.$dados['nome'];
        $mensagem .= '<br>E-mail: '.$dados['email'].' / Telefone: '.$dados['telefone'];*/

    }

	public function add($dados) {

		$validaEmail = $this->validateEmail($dados['email']);

		if(!$this->validateObrigatorios($dados) || !empty($validaEmail))
			return 'Esse e-mail já esta em uso.';

		$sql = "INSERT INTO cliente(nm_cliente, email, celular, senha, st_ativo, dt_inclusao) VALUES (:nm_cliente, :email, :celular, :senha, 1, :dt_inclusao)";
		$stmt = $this->conn->prepare($sql);

		$data = date('Y-m-d H:i:s');
		
		$senha = md5($dados['senha']);
		$celular = isset($dados['celular']) ? $dados['celular'] : '';

		$stmt->bindParam(':nm_cliente', $dados['nome']);
		$stmt->bindParam(':email', $dados['email']);
		$stmt->bindParam(':celular', $celular);
		$stmt->bindParam(':senha', $senha);
		$stmt->bindParam(':dt_inclusao', $data);
		 
		$stmt->execute();

		return json_encode($this->login($dados));
	}

	public function update($dados) {

		$validaEmail = $this->validateEmail($dados['email']);

		if(!empty($validaEmail) && $validaEmail[0]['id_cliente'] != $_SESSION['id_cliente'])
			return 3;

		$sql = "UPDATE cliente SET nm_cliente=:nm_cliente, email=:email, celular=:celular, telefone=:telefone, endereco=:endereco, cpf_cnpj=:cpf_cnpj WHERE id_cliente = :id_cliente";

		$stmt = $this->conn->prepare($sql);

		$celular  = isset($dados['celular']) ? $dados['celular'] : '';
		$telefone = isset($dados['telefone']) ? $dados['telefone'] : '';
		$cpf_cnpj = isset($dados['documento']) ? $dados['documento'] : '';
		$endereco = isset($dados['endereco']) ? $dados['endereco'] : '';

		$stmt->bindParam(':nm_cliente', $dados['nome']);
		$stmt->bindParam(':email', $dados['email']);
		$stmt->bindParam(':celular', $celular);
		$stmt->bindParam(':telefone', $telefone);
		$stmt->bindParam(':endereco', $endereco);
		$stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
		$stmt->bindParam(':id_cliente', $_SESSION['id_cliente']);
		 
		return $stmt->execute();
	}

	public function alterarSenha($dados) {

		$validaEmail = $this->validateEmail($dados['email']);

		if(empty($validaEmail))
			return 'Esse e-mail é inválido';

		$senha = rand(111111, 999999);

		$dados['senha'] = md5($senha);

		$sql = "UPDATE cliente SET senha = :senha WHERE email = :email";
		$stmt = $this->conn->prepare($sql);

		$stmt->bindParam(':email', $dados['email']);
		$stmt->bindParam(':senha', $dados['senha']);

		$stmt->execute();

		$dados['senha'] = $senha;

		$email = new ControllerMail;

		$dados_email = array(
			'from'     => array('suporte@ssentregas.com.br', 'Suporte'),
			'assunto'  => 'SSEntregas - Sua senha foi alterada',
			'mensagem' => 'Sua senha foi alterada para: '.$dados['senha'],
			'to'	   => array($dados['email'], "")
		);

		return $email->send($dados_email);
	}

	public function validateObrigatorios($dados) {

		$obrigatorios = array('email','nome','celular','senha');
		
		foreach ($obrigatorios as $obrigatorio) {

			$validado = false;

			foreach ($dados as $key => $value) {
				if($key == $obrigatorio && trim($value) != '') {
					$validado = true;
					break;
				}
			}

			if(!$validado)
				return false;
		}
		
		return true;
	}

	public function validateEmail($email) {

		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			return false;

		$stmt = $this->conn->prepare("SELECT * FROM cliente WHERE email = :email LIMIT 1");
		$stmt->bindParam(':email',$email);

		$stmt->execute();
		

		return $stmt->fetchAll();
	}

	public function login($dados) {
		
		$dados['senha'] = md5($dados['senha']);

		$stmt = $this->conn->prepare("SELECT id_cliente FROM cliente WHERE email = :email AND senha = :senha LIMIT 1");
		$stmt->bindParam(':email',$dados['email']);
		$stmt->bindParam(':senha',$dados['senha']);
		$stmt->execute();

		$id = $stmt->fetch();

		if(!empty($id)) {
			$_SESSION['id_cliente'] = $id['id_cliente'];
			return true;
		}

		return false;
		
	}

}

$t = new ControllerCliente();

switch ($_GET['action']) {
	case 'add':
		echo $t->add($_POST);
		break;
    case 'addCotacao':
        echo $t->addCotacao($_POST);
        break;
    case 'calcPontos':
        echo $t->calcPontos($_POST);
        break;
	case 'update':
		echo $t->update($_POST);
		break;
	case 'find':
		echo json_encode($t->find());
		break;
	case 'login':
		echo json_encode($t->login($_POST));
		break;
	case 'esqueci_senha':
		echo json_encode($t->alterarSenha($_POST));
		break;
	case 'getPerfil':
		echo json_encode($t->getPerfil());
		break;
}