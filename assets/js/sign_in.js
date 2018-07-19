$(document).ready(function(){
	
	$('.click_senha').click(function(e){
		e.preventDefault();
		$('#login,#form_senha').toggle();
	})

	$('#form_senha').submit(function(){

		$.ajax({
			url:'php/ControllerCliente.php?action=esqueci_senha',
			method: 'POST',
			data: $('#form_senha').serializeArray(),
			success: function(e) {
				if(e != 'true') {
					alert(e);
				}
				else {
					$('#login,#form_senha').toggle();
					alert('Senha enviada com sucesso');
					$('#form_senha input[type="text"],#form_senha input[type="email"],#add_cliente input[type="password"]').val('');
				}
			}
		});

		return false;

	});

	$('#add_cliente').submit(function(){

		if($('#add_cliente input[name="senha"]').val() != $('#confirm_senha').val()) {
			alert('Os campos de senha estão diferentes.');
			return false;
		}

		$.ajax({
			url:'php/ControllerCliente.php?action=add',
			method: 'POST',
			data: $('#add_cliente').serializeArray(),
			success: function(e) {
				if(e != 'true') {
					alert(e);
				}
				else {
					alert('Cadastrado com sucesso');
					$('#add_cliente input[type="text"],#add_cliente input[type="email"],#add_cliente input[type="password"]').val('');
				}
			}
		});

		return false;
	});

	$('#login').submit(function(){

		$.ajax({
			url:'php/ControllerCliente.php?action=login',
			method: 'POST',
			data: $('#login').serializeArray(),
			success: function(e) {
				if(e != 'true') {
					alert('Falha de autenticação.');
				}
				else {
					window.location.href = './area_cliente.php';
					$('#login input[type="text"],#login input[type="password"]').val('');
				}
			}
		});

		return false;
	});

});