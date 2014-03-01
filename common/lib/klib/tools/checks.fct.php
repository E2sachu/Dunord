<?php

function is_empty($data){
	return empty($data);
}
function is_int_greater_than_z($data){
	return (intval($data) > 0);
}
function is_mail($data){
	return is_string(filter_var($data, FILTER_VALIDATE_EMAIL));
}