$(function(){

	$('#empresa').ddslick({
		onSelected: function(info){ //Cuando cambie seleccion
			var selectedValue = info.selectedData.value; //Obtiene valor seleccionado
			$('#empr_id').val(selectedValue);
		},
		width: "100%",
		height: "200px"
	});

	$('#fecha_inicio,#fecha_fin').Zebra_DatePicker();


	$('#crear-balance').on('submit',function(e){
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
			dataType: 'json',
			success: function(s){
	//			alertify.alert(self.serialize());

				if(s.estado === 1){
					location.href = './balance_edit.php?id='+s.id;
				}else if(s.estado === 2){
					$('#popup').fadeOut();
					alertify.error(s.msg);
				}else{
					$('#popup').fadeOut();
					alertify.error('Error desconocido');
				}
				//
			}
		})

	})

})