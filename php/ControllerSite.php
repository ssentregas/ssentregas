<?php

require 'ControllerMail.php';
/**
* 
*/
class ControllerSite{

	public function contato($dados) {

		$email = new ControllerMail;

		$dados_email = array(
			'from'     => array('faleconosco@ssentregas.com.br', 'Site'),
			'assunto'  => 'Contato do Site: '.$dados['subject'],
			'mensagem' => $dados['message'].'<br><br>Nome: '.$dados['name'].'<br>E-mail: '.$dados['email'],
			'to'	   => array('faleconosco@ssentregas.com.br', "SSEntregas")
		);
		
		$_SESSION['contato'] = strtotime('now');

		return $email->send($dados_email);
	}

	public function orcamento($dados) {

		$email = new ControllerMail;
		$ponto = array('Origem','Destino','Ponto Extra');

		$mensagem = '';

		foreach ($dados['pontos'] as $key => $value) {
			
			$ds_ponto = isset($ponto[$value['ordem']]) ? $ponto[$value['ordem']] : $ponto[2];

			$mensagem .= '>Endereço de '.$ds_ponto.': '.$value['origem'];
			$mensagem .= '<br>Complemento: '.$value['complemento'];
			$mensagem .= '<br><brTarefa: '.$value['observacao'];
		}

		$mensagem .= $dados['descricao'];
		$mensagem .= '<br><br>Valor cobrado: R$ '.$dados['valor'];
		$mensagem .= '<br><br>Nome do contato: '.$dados['nome'];
		$mensagem .= '<br>E-mail: '.$dados['email'].' / Telefone: '.$dados['telefone'];

		$dados_email = array(
			'from'     => array('faleconosco@ssentregas.com.br', 'Site'),
			'assunto'  => 'Orçamento pelo Site',
			'mensagem' => $mensagem,
			'to'	   => array('faleconosco@ssentregas.com.br', "SSEntregas")
		);

		return $email->send($dados_email);
	}

	public function add($dados){
        $controllerCliente = new ControllerCliente();

        $dados_cliente = array(
          'nome'  => $dados['nome'],
          'email'  => $dados['email'],
          'celular'  => $dados['celular'],
          'senha'  =>   $dados['senha']
        );

        return $controllerCliente->add($dados_cliente);

    }
}

$t = new ControllerSite;

switch ($_GET['action']) {
	case 'contato':
		echo $t->contato($_POST);
		break;
	case 'orcamento':
		echo $t->orcamento($_POST);
		break;
    case 'add':
        echo $t->add($_POST);
        break;
}