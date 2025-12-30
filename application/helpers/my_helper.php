<?php



function pre($value)
{
	return var_dump('<pre>', $value, '</pre>');
}

function prd($value)
{
	var_dump('<pre>', $value, '</pre>');
	die();
}


function pr($value)
{
	return "<pre>" . print_r($value) . "</pre>";
}
