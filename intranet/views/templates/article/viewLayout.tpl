<div class="row" id='articleId' articleId="{$article->getId()}">
	<h2>
		<i class="fa fa-times mt" title='Supprimer'></i>
		<a href='{url path="article/updateF/"}{$article->getId()}'><i class="fa fa-wrench mt" title='Modifier'></i></a>
		{$article->getTitle()} 
		<span class='label label-info'></span>
	</h2>
	<div class="col-md-6">
		{include file='article/view.tpl'}
	</div>
	<div class="col-md-6">

	</div>
</div>
<div class="row" articleId="{$article->getId()}">
	<div class="col-md-6" id='articleView'>
		
	</div>
</div>


<script language='javascript'>
	$(document).ready(function(){
		$('#articleViewPublish > .panel > .panel-heading > span.pull-right > i').click();
		$('#articleViewStatutPublish > .panel > .panel-heading > span.pull-right > i').click();
		$('.fa-times.mt').click(function(){
			initDialog({
				body: "Voulez-vous vraiment supprimer cet article ?", 
				title: "Confirmez la suppression de l'article"
			});
			$('#dialogWindowButton > button').click(function(){
				if ($(this).data('val') == 'validate'){
					make('article/delete/'+$('#articleId').attr('articleId'), {}, function(){
						toggleDialog();
						reload('article/home');
					}, 'Article supprimé avec succès',
					function (){
						toggleDialog();
					}, 'Article non supprimable');	
				}
			})
		});
	});
</script>