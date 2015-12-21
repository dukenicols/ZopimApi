<form method="post" action="">

<h3><i class="zopimapi-icon-wrench"></i><?php _e('Zopim Config','zopimapi'); ?></h3>
<table class="form-table">
	<tr valing="top">
		<th scope="row"><label><?php _e('Dias de prueba'); ?></label></th>
		<td>
			<input type="text" name="zopim_api_trial_days" id="zopim_api_trial_days" value="<?php echo zopimapi_get_option('zopim_api_trial_days'); ?>" class="regular-text" />
			<span class="description"><?php _e('Ingresa el numero de días que obtienen los usuarios de prueba {7} {14} {21}.','zopimapi'); ?></span>
		</td>
	</tr>
	<tr valing="top">
		<th scope="row"><label><?php _e('Plan de Prueba'); ?></label></th>
		<td>
			<input type="text" name="zopim_api_trial_plan" id="zopim_api_trial_plan" value="<?php echo zopimapi_get_option('zopim_api_trial_plan'); ?>" class="regular-text" />
			<span class="description"><?php _e('{trial} {basic} {lite}','zopimapi'); ?></span>
		</td>
	</tr>
	<tr valing="top">
		<th scope="row"><label><?php _e('No. de Agentes'); ?></label></th>
		<td>
			<input type="text" name="zopim_api_num_agents" id="zopim_api_num_agents" value="<?php echo zopimapi_get_option('zopim_api_num_agents'); ?>" class="regular-text" />
			<span class="description"><?php _e('Numero de Agentes que obtienen en el trial.','zopimapi'); ?></span>
		</td>
	</tr>	
</table>

<h3><i class="zopimapi-icon-wrench"></i><?php _e('API Token','zopimapi'); ?></h3>
<table class="form-table">
	<tr valing="top">
		<th scope="row"><label><?php _e('Zopim Api Token'); ?></label></th>
		<td>
			<input type="text" name="zopim_api_key" id="zopim_api_key" value="<?php echo zopimapi_get_option('zopim_api_key'); ?>" class="regular-text" />
		</td>
	</tr>
	<tr valing="top">
		<th scope="row"><label><?php _e('Zopim Api Secret'); ?></label></th>
		<td>
			<input type="text" name="zopim_api_secret" id="zopim_api_secret" value="<?php echo zopimapi_get_option('zopim_api_secret'); ?>" class="regular-text" />
		</td>
	</tr>
	
</table>

<h3><i class="zopimapi-icon-wrench"></i><?php _e('WHMCS','zopimapi'); ?></h3>
<table class="form-table">
	<tr valing="top">
		<th scope="row"><label><?php _e('Admin: username'); ?></label></th>
		<td>
			<input type="text" name="admin_user" id="admin_userr" value="<?php echo zopimapi_get_option('admin_user'); ?>" class="regular-text" />
		</td>
	</tr>
	<tr valing="top">
		<th scope="row"><label><?php _e('Admin: password'); ?></label></th>
		<td>
			<input type="text" name="admin_pass" id="admin_pass" value="<?php echo zopimapi_get_option('admin_pass'); ?>" class="regular-text" />
		</td>
	</tr>
	<tr valing="top">
		<th scope="row"><label><?php _e('WHMCS API Url'); ?></label></th>
		<td>
			<input type="text" name="whcms_url" id="whcms_url" value="<?php echo zopimapi_get_option('whcms_url'); ?>" class="regular-text" />
		</td>
	</tr>
	
</table>

<h3><i class="zopimapi-icon-wrench"></i><?php _e('Errores','zopimapi'); ?></h3>
<table class="form-table">
	<tr valing="top">
		<th scope="row"><label><?php _e('Usuario existente'); ?></label></th>
		<td>
			<input type="text" name="zopim_api_user_exist" id="zopim_api_user_exist" value="<?php echo zopimapi_get_option('zopim_api_user_exist'); ?>" class="regular-text" />
			<span class="description"><?php _e('Ingresa el texto que se muestra cuando un usuario ya existe','zopimapi'); ?></span>
		</td>
	</tr>
	<tr valing="top">
		<th scope="row"><label><?php _e('Link de redirección'); ?></label></th>
		<td>
			<input type="text" name="zopim_api_user_exist_link" id="zopim_api_user_exist_link" value="<?php echo zopimapi_get_option('zopim_api_user_exist_link'); ?>" class="regular-text" />
			<span class="description"><?php _e('http://example.com/usuarioexiste','zopimapi'); ?></span>
		</td>
	</tr>
</table>




<p class="submit">
	<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Guardar','zopimapi'); ?>"  />

</p>

</form>