<?php

wp_enqueue_script('jquery');
wp_register_script('zopimapi_min', zopimapi_url . 'scripts/script.js' );
wp_enqueue_script('zopimapi_min');

function zopimapi_form_style() {
	wp_register_style('zopimapi_bootstrap_css', zopimapi_url . 'css/bootstrap.min.css');
	wp_enqueue_style('zopimapi_bootstrap_css');
	wp_register_style('zopimapi_form_css', zopimapi_url . 'css/form.css');
	wp_enqueue_style('zopimapi_form_css');
}		