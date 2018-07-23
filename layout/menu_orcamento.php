<nav id="main-navigation" class="main-navigation__container">
	<div class="main-navigation__title"> Escolha uma opção</div>
	<ul id="menu-main-menu" class="main-navigation">
		<?php

		$menu = array(
			array('url'=>'area_cliente.php','texto'=>'Solicitar Serviço'),
			array('url'=>'area_cliente.php','texto'=>'Ordens de Serviço'),
			array('url'=>'acompanhar_pedido.php','texto'=>'Roteiros'),
            array('url'=>'acompanhar_pedido.php','texto'=>'Finalizar Cadastro'),
			array('url'=>'alterar_senha.php','texto'=>'Alterar Senha'),
		);

		foreach ($menu as $link) {
			$current = $_SERVER['REQUEST_URI'] == '/'.$link['url'] ? 'current-menu-item current_page_item' : '';
			echo '<li class="menu-item '.$current.'"><a href="'.$link['url'].'">'.$link['texto'].'</a></li>';
		}
		?>

	</ul> <a href="sign_in.php" class="btn  btn-primary  btn-featured-page" target="_self">Sair</a>
</nav>