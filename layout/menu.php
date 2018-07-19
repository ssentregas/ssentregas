<nav id="main-navigation" class="main-navigation__container">
	<div class="main-navigation__title"> Escolha uma opção</div>
	<ul id="menu-main-menu" class="main-navigation">
		<?php

		$menu = array(
			array('url'=>'index.php','texto'=>'Página Inicial'),
			array('url'=>'services.php','texto'=>'Serviços'),
			array('url'=>'sign_in.php','texto'=>'Clientes'),
			array('url'=>'blog.php','texto'=>'Blog'),
			array('url'=>'contato.php','texto'=>'Contato'),
		);

		foreach ($menu as $link) {
			$current = $_SERVER['REQUEST_URI'] == '/'.$link['url'] ? 'current-menu-item current_page_item' : '';
			echo '<li class="menu-item '.$current.'"><a href="'.$link['url'].'">'.$link['texto'].'</a></li>';
		}
		?>

	</ul> <a class="btn  btn-primary  btn-featured-page" target="_self" href="orcamento.php"> Faça uma cotação </a>
</nav>