function is_empty(varref) {
	
	if(varref.length > 0){
		return false;
	}
	return true;
}

function is_valid_email(email) { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 

jQuery(document).ready(function() {
 jQuery('form#zopimapi_addclient input').keyup(function() {
 		jQuery(this).removeClass('error').parents('li').find('span.error').remove();
 	});

 jQuery('#submit_form').on('click', function(event) {

 	event.preventDefault();
 	
 	//Tomar los parametros
 	var nombre = jQuery('#nombre').val();
 	var apellido = jQuery('#apellido').val();
 	var empresa = jQuery('#empresa').val();
 	var telefono = jQuery('#telefono').val();
 	var email = jQuery('#email').val();
 	var pass = jQuery('#pass').val();

 	var error = [];

 	//verificar que todos estan completos
 	
 	if(is_empty(nombre)){
 	  error.push('nombre');
 	}
 	if(is_empty(apellido)){
 	  error.push('apellido');
 	}
 	if(is_empty(email)) {
 		error.push('empresa');
 	}
 	if(is_empty(telefono)) {
 		error.push('telefono');
 	}
 	if(is_empty(email)){
 	  error.push('email');
 	}
 	if(is_empty(pass)){
 	  error.push('pass');
 	}
 	//que el mail sea valido
 	if(!is_valid_email(email) && !is_empty(email)){
 		error.push('invalid_email');
 		jQuery('#email').parents('li').find('span.error').remove();
 		jQuery('#email').addClass('error').after('<span class="error">Ups, parece que no es un email valido</span>');
 	}

 	if(error.length > 0) {
 		var texto;
 		error.forEach(function(field) {
 			texto = field;
 			if(texto === 'pass') { texto = 'contraseña'; }
 			texto = texto.charAt(0).toUpperCase() + texto.slice(1);
 			jQuery('#' + field).parents('li').find('span.error').remove();
 			jQuery('#' + field).addClass('error').after('<span class="error">' + texto + ' es un campo requerido</span>');
 		});
 	} else { 
 		var dataInput = 'action=zopimapi_addclient&nombre='+nombre+'&apellido='+apellido+'&email='+email+'&pass='+pass+'&empresa='+empresa+'&telefono='+telefono;
 		jQuery.ajax({
				url: zopimapi_ajax_url,
				data: dataInput,
				dataType: 'JSON',
				type: 'POST',
				success:function(response){
					
					//var response = jQuery.parseJSON(data);
					var success_el = jQuery('#zopimapi_api_success');
					var error_el = jQuery('#zopimapi_api_error');
				    var heading = error_el.find('.panel-heading');
					var body = error_el.find('.panel-body');
					
					
					if(response.status === 'error'){
						var error = response.error;
						
						if(error == 'empty') { // Llego un dato vacio a PHP
							
							delete response.error;
							jQuery.each(response, function(i, v) {
								jQuery('#zopimapi_addclient').find('input#'+v).addClass('error').val('');
							});
							jQuery('input.error').first().focus();
							jQuery(heading).html('<span>Ups!, parece que hay un error en el formulario</span>');
							
							if(Object.keys(response).length == 1){
								var txt = '<span>En rojo encontrar&aacute;s el campo que debemos corregir</span>';
							} else {
								var txt = '<span>En rojo encontrar&aacute;s los campo que debemos corregir</span>';
							}
							jQuery(body).html(txt);
							error_el.fadeIn();
						}
					   if(error == 'zopim') {
					   		var output  = '<span>';
					   			output += response.message;
					   		if(response.link) {
					   			output += '<a href="' + response.link + '"> Click Aquí</a>';
					   		}
					   		output += '</span>';

					   		jQuery(heading).html(output);
					   		if(response.elemento === 'email') {
					   			jQuery('form#zopimapi_addclient').fadeOut();
					   		}
					   		error_el.fadeIn();
					   }
					   
					   if(error == 'whmcs') {
					   		jQuery(heading).html('<span>'+ response.message + '</span>');
					   		jQuery(body).hide();
					   		error_el.fadeIn();
					   }
					}
					
					if(response.hasOwnProperty('done')) {
						
						jQuery('#zopimapi_addclient').fadeOut();
						jQuery('.btn-container').fadeOut();
						jQuery('#zopimapi_api_success').fadeIn('slow');
						setTimeout(function() {
							window.location.href = response.redirect;
						}, 10000);
					}
				}
		});
 	}
 	//Enviar a ajax en carpeta especial
 	
 	//recibir respuesta
 	
 });
 
});
	
