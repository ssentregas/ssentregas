$('#contato').submit(function(){

	$.ajax({
		url:'php/ControllerSite.php?action=contato',
		method: 'POST',
		data: $('#contato').serializeArray(),
		success: function(e) {
			if(e != 'true') {
				alert(e);
			}
			else {
				alert('Mensagem enviada com sucesso');
				$('#contato input[type="text"],#contato input[type="email"],#contato textarea').val('');
			}
		}
	});

	return false;

});