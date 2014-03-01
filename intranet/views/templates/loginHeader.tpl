<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="robots" content="nofollow">
        <meta name="googlebot" content="nofollow">
        <meta name="google" value="notranslate">
        <link rel="shortcut icon" href="static/img/icon_pc_portable.ico" />
		<title>{$headerTitle}</title>
		{foreach $headerCss as $hCss}
		<link href="{url path=$hCss}" media="screen" rel="stylesheet" type="text/css">
		{/foreach}
		<link href="static/css/login.css" media="screen" rel="stylesheet" type="text/css">
		{foreach $headerJs as $hJs}
		<script src="{url path=$hJs}" type="text/javascript"></script>
		{/foreach}
		<script language='javascript'>
		$(document).ready(function(){
		{foreach $headerNotifs as $hNotif}
			$.pnotify({ type:'{$hNotif.type}' , text:"{$hNotif.msg}", title:'{$hNotif.title}', styling: 'bootstrap'});
		{/foreach}
		});
		</script>
	</HEAD>
	<BODY>
		


