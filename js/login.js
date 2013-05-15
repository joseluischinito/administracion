$(function(){

	$('#login-form').on('submit',function(e){

		e.preventDefault();

		var self = $(this);
		var data = self.serialize();
		var method = self.attr('method');
		var action = self.attr('action');

		$.ajax({
			beforeSend: function(){
				self.children('input[type=submit]').val('...');
				self.children('input[type=submit]').attr('disabled','disabled');
			},
			type: method,
			url: action,
			data: data,
			dataType: 'json',
			success: function(s){
				if(s.estado === 1 || s.estado === 2){
					alertify.success('Bienvenido!');
					setTimeout(function() { location.href = './' }, 2500);
				}else{
					alertify.error('Nombre de usuario o contrase&ntilde;a incorrectos');
					self.children('input[type=submit]').removeAttr('disabled');
					self.children('input[type=submit]').val('Entrar');
				}
			}
		})
	})
})