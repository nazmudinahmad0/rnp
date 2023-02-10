<?php

function debug($value='')
{
	print_r("<pre>");
	print_r($value);
	print_r("</pre>");
}

function dd($value='')
{
	print_r("<pre>");
	print_r($value);
	print_r("</pre>");
	die;
}

function enc_msg($msg="")
{
	$data = base64_encode(htmlentities($msg));
	return $data;
}

function dec_msg($msg="")
{
	$data = html_entity_decode(base64_decode($msg));
	return $data;
}