<div class="panel panel-primary">
	<div class="panel-heading">
		<span><i class="fa fa-plus mt article" id="addArticle"></i> Articles</span>
	</div>
	<div class="panel-body">
		<table class="table table-condensed table-hover">
			<thead>
				<tr>
					<td><strong>URI</strong></td>
					<td><strong>Titre</strong></td>
					<td><strong>Status</strong></td>
					<td><strong>Date de création</strong></td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				{foreach $articles as $article}
				<tr articleId="{$article->getId()}">
					<td>{$article->getUri()}</td>					
					<td>{$article->getTitle()}</td>
					<td>
						{if $article->isPublished()}
						<span class='label label-success'>Publiée</span>
						{else}
						<span class='label label-danger'>Non publiée</span>
						{/if}
					</td>
					<td>{$article->getDateCreate('d/m/Y H:i')}</td>
					<td>
						<a href='{url path="article/view/"}{$article->getId()}'><i class="fa fa-sign-out mt" title='Consulter'></i></a>
					</td>
				</tr>
				{foreachelse}
				<tr>
					<td colspan=8><center>Pas d'article enregistr&eacute;</center></td>
				</tr>
				{/foreach}
			</tbody>
		</table>	
  	</div>
</div>
<script language='javascript'>
	$(document).ready( function(){
	    $('#addArticle').click(function(){
	    	console.log('Click : OK');
	        getContent($('#content'), 'article/addF');
	    });
	    $('.fa.fa-sign-out.mt').click(function(){
	        var articleId = $(this).parent().parent().attr('articleId')
	        getContent($('#content'), 'article/view/'+articleId);
	    });
	});
</script>