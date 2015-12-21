<?php

	/* Admin bar */
	function zopimapi_admin_bar(){
		global $zopimapi_admin;
	?>
			<div class="zopimapi-admin-head">
				<div class="zopimapi-admin-left">
					<a href="<?php echo admin_url('admin.php'); ?>?page=zopimapi"></a>
					
				</div>
				<div class="zopimapi-admin-right">
				
					<a href="http://dodable.com" class="button"><?php _e('Soporte','zopimapi'); ?></a>
					
				</div>
				<div class="clear"></div>
			</div>
	<?php
	}
