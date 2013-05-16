$(function(){

	$('#cta').val($('#cuenta-m option:first-child').val());

	$('#form-movimiento').on('submit',function(e){
		e.preventDefault();

		var self = $(this);

		$.ajax({
			beforeSend: function(){
				$('#popup').html('<div id="loader"></div>')
				$('#loader').spin({
					color: '#FFF'
				});
				$('#popup').fadeIn();
			},
			type: self.attr('method'),
			url: self.attr('action'),
			data: self.serialize(),
			//dataType: 'json',
			success: function(s){
				

				$('#popup').fadeOut();
				console.log(s)
				if(s.estado === 1){
					self.reset();
					alertify.success('Operacion agregada');
				}else if(s.estado === 2){
					alertify.error(s.msg);
				}else{
					alertify.error('Error desconocido');
				}
				
			}
		})
	})

	$('#cuentas-t').selectbox({
		onChange: function(v,inst){
			$('#cta').val(v);
		}
	});

	$('input[type=radio]').picker();


	
})