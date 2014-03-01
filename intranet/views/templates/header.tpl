<!DOCTYPE html>
<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="robots" content="nofollow">
		<meta name="googlebot" content="nofollow">
		<meta name="google" value="notranslate">
		<link rel="shortcut icon" href="{url path='static/img/icon_pc_portable.ico'}" />
		<title>{$headerTitle}</title>
		{foreach $headerCss as $hCss}
		<link href="{url path=$hCss}" media="screen" rel="stylesheet" type="text/css">
		{/foreach}
		{foreach $headerJs as $hJs}
		<script src="{url path=$hJs}" type="text/javascript"></script>
		{/foreach}
		<script language='javascript'>
		$(document).ready(function(){
		{foreach $headerNotifs as $hNotif}
			$.pnotify({ type:'{$hNotif.type}' , text:"{$hNotif.msg}", title:'{$hNotif.title}', styling: 'bootstrap'});
		{/foreach}
		});
		$.baseUrl = "{config key='BASEURL'}";
		</script>
	</HEAD>
	<BODY>
		<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="{url path=''}">Dunord</a>

				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						{if isset($admin) && is_a($admin, 'Admin')}
						<li><a href="{url path='material/home'}">Matériel</a></li>
						{else}
						<li><a href="{url path='logout'}">Déconnexion</a></li>
						{/if}
					</ul>
					{if isset($admin) && is_a($admin, 'Admin')}
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user mt"></i> {$admin->getFirstName()|capitalize} {$admin->getSureName()|upper} <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="{url path='logout'}"><i class="fa fa-power-off mt"></i> D&eacute;conexion</a></li>
							</ul>
						</li>
					</ul>
					{/if}
				</div><!--/.nav-collapse -->
				
			</div>
		</div>
		<div class="modal fade" id="dialogWindow">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="dialogWindowTitle"></h4>
					</div>
					<div class="modal-body" id="dialogWindowBody">
						
					</div>
					<div class="modal-footer" id='dialogWindowButton'>
						<button type="button" class="btn btn-default" data-dismiss="modal" data-val='close'>Fermer</button>
						<button type="button" class="btn btn-primary" data-val='validate'>Valider</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

