<ul class="list-group" articleId="{$article->getId()}">
	<li class="list-group-item">Identifiant : {$article->getId()}</li>
	<li class="list-group-item">Auteur : {$article->getAuthor()}</li>
	<li class="list-group-item">Title : {$article->getTitle()}</li>
	<li class="list-group-item">URI : {$article->getUri()}</li>
	<li class="list-group-item">Status: 
		{if $article->isPublished()}
		<span class='label label-success' id='articleViewStatusPublish'>Publi&eacute;</span>
		{else}
		<span class='label label-danger' id='articleViewStatusPublish'>D&eacute;publi&eacute;</span>
		{/if}
		<div class="btn-group-xs pull-right">
			{if !$article->isPublished()}
			<button type="button" class="btn btn-success" id='articleViewPublish'>Publi&eacute;</button>
			{else}
			<button type="button" class="btn btn-danger" id='articleViewPublish'>D&eacute;publi&eacute;</button>
			{/if}
		</div>
	</li>
	<li class="list-group-item">Date de publication: {$article->getDatePublish('d/m/Y H:i:s')}</li>
	<li class="list-group-item">Page Title: {$article->getPageTitle()}</li>
	<li class="list-group-item">Description: {$article->getDescription()}</li>
	<li class="list-group-item">Langue: {$langues[$article->getLanguage()]}</li>
	<li class="list-group-item">keywords: {implode data=$article->getKeyWords()}</li>
	<li class="list-group-item">Tags: {implode data=$article->getTags()}</li>
	<li class="list-group-item">Auteur: {$article->getAuthor()}</li>
	<li class="list-group-item">Date de cr&eacute;ation: {$article->getDateCreate('d/m/Y H:i:s')}</li>
	<li class="list-group-item">Date de modification: {$article->getDateModify('d/m/Y H:i:s')}</li>
</ul>
<script language='javascript'>
	$(document).ready(function(){
		$('#articleViewPublish').click(function(){
			var uid = $(this).parent().parent().parent().attr('articleId');
			var btn = $(this);
			btn.removeClass();
			make('article/published/'+uid, {}, function(data){
				$('#articleViewStatusPublish').removeClass();
				if (data['status']){
					btn.html('D&eacute;publi&eacute;');
					btn.addClass('btn btn-danger');
					$('#articleViewStatusPublish').html('Publi&eacute;');
					$('#articleViewStatusPublish').addClass('label label-success');
				}else{
					btn.html('Publié');
					btn.addClass('btn btn-success');
					$('#articleViewStatusPublish').html('D&eacute;publi&eacute;')
					$('#articleViewStatusPublish').addClass('label label-danger');
				}
			}, 'Status modifi&eacute; avec succ&egrave;s.');
		});
	});
</script>