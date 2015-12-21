		<div class="form_container">
				
							<div class="panel panel-success" id="zopimapi_api_success" style="text-align: center; display:none;">
							  <div class="panel-heading">Gracias por registrarte en Zopim Argentina</div>
							  <div class="panel-body">
							    Estamos configurando tu cuenta... <br> En breve ser&aacute;s redireccionado a tu Panel de Control... 
							  </div>
							</div>
							
							<div class="panel panel-danger" id="zopimapi_api_error" style="text-align: center; display:none;">
							  <div class="panel-heading"></div>
							  <div class="panel-body">
							    
							  </div>
							</div>
							
							<section>
							<form id="zopimapi_addclient" name="testform" method="post" action="">
								<input name="action"  value="zopimapi_addclient" type="hidden">
								<input name="ajaxurl" value="http://www.zopim.com.ar/wp-admin/admin-ajax.php" type="hidden">
								
								<ul class="style-1 clearfix">
						          <li>
						            <input name="nombre" id="nombre" class="style-1"  type="text" placeholder="Nombre">
						          </li>
						          <li>
						            <input name="apellido" id="apellido" class="style-1"  type="text" placeholder="Apellido">
						          </li>
						          <li>
						            <input name="empresa" id="empresa" class="style-1"  type="text" placeholder="Empresa">
						          </li>
						          <li>
						            <input name="telefono" id="telefono" class="style-1"  type="text" placeholder="Tel&eacute;fono">
						          </li>
						          <li>
						          	<input name="email" id="email" class="style-1"  type="text" placeholder="Correo Electr&oacute;nico">
						          </li>
						          <li>
						          	<input name="pass" id="pass" class="style-1"  type="password" placeholder="Contrase&ntilde;a">
						          </li>
						        </ul>
								<div class="btn-container">
									<button data-form="zopimapi_add_client" id="submit_form">REGISTRARME</button>
								</div>
							</form>	
								
							</section>
					</div>	

	