$(function(){

	$('#empresa').ddslick({
		onSelected: function(info){ //Cuando cambie seleccion
			var selectedValue = info.selectedData.value; //Obtiene valor seleccionado
			alertify.error(selectedValue);
		},
		width: "100%",
		height: "200px"
	});

	$('#fecha_inicio,#fecha_fin').Zebra_DatePicker();


})