function validateProperty(){
	var name = $('#propertyValueInput').val();
	var valid = true;
	var messages = [];

	if(name.trim().length < 3){
		valid = false;
		messages.push("El item debe tener al menos 3 caracteres.");
	}

	if(!valid){
		alert(messages.join("\n"));
	}

	return valid;
}

function deleteItem(ev){
	ev.preventDefault();
	if(!confirm('¿Seguro que desea eliminar este item?')) return;
	$(this).closest('li').remove();
}

$(document).ready(function(){
	
	window.prettyPrint && prettyPrint();

	$('#colorselector_1').colorselector({
		callback: function (value, color, title) {
			$("#hexa").val(value);
		}
	});

	var tablaActual = 1;
	var tablaUltima = 1;

	
	$('#addProperty').on('show.bs.modal',function(e){
		$('#propertyValueInput').val('');
		$(this).data('relatedTarget',e.relatedTarget)
	});

	$('#addProperty').on('shown.bs.modal',function(e){
		$('#propertyValueInput').focus();
	});

	$('#addProperty').submit(function(ev){
		ev.preventDefault();
		if(!validateProperty()){
			return false;
		}
		var btn = $(this).data('relatedTarget');
		var ul = $('.list-group',$(btn).closest('div'));
		var template = $('.template',ul);
		var li = template.clone().removeClass('template');
		$('input',li).val($('#propertyValueInput').val());
		$('span',li).text($('#propertyValueInput').val());
		$('button',li).click(deleteItem);
		li.appendTo(ul);

		$(this).modal('hide');
	});

	$('#varieties .list-group-item .close').click(deleteItem);
});
