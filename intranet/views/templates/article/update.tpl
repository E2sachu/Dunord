<h1>Modifier : {$article->getTitle()}</h1>
<form class="form-horizontal" role="form" action='{url path="article/update/"}{$article->getId()}' id='formUpdateArticle' method='POST'>
	
  <div class="row" id="articleAdd" uid="{$article->getId()}">
    <div class="col-md-6">
    	<h2>Informations</h2>
      <div class="form-group">
    		<label for="author" class="col-sm-2 control-label">Auteur</label>
    		<div class="col-sm-6">
      		<select id="selectAuthor" name='author' data-placeholder="Auteur" required class='chosen-select'>
            <option value="">Choisir dans la liste</option>
            {foreach $authors as $author}
              {if $author == $article->getAuthor()}
              <option value="{$author}" selected>{$article->getAuthor()|capitalize:true}</option>
              {else}
              <option value="{$author}">{$author|capitalize:true}</option>
              {/if}
            {/foreach}
          </select>
    		</div>
    	</div>
      <div class="form-group">
        <label for="layout" class="col-sm-2 control-label">Layout</label>
        <div class="col-sm-6">
          <select id="selectLayout" name='layout' data-placeholder="Layout" required class='chosen-select'>
            <option value="">Choisir dans la liste</option>
              {foreach $layouts as $layout}
                {if $layout.tpl == $article->getLayout()}
                <option value="{$layout.tpl}" selected>{$layout@key}</option>
                {else}
                <option value="{$layout.tpl}">{$layout@key}</option>
                {/if}
                }
              {/foreach}
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Titre (&lt;H1&gt;)</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name='title' placeholder="Titre" value='{$article->getTitle()}' required>
        </div>
      </div>
      <div class="form-group">
        <label for="tags" class="col-sm-2 control-label">Tags</label>
        <div class="col-sm-6">
          <input id="tagTags" type="text" class="form-control" value='{implode data=$article->getTags()}' name='tags'>
        </div>
      </div>
      <div class="form-group">
          <label for="datePublished" class="col-sm-2 control-label">Publication</label>
          <div class="col-sm-6">
            <input type="text" name='datePublished' class="form-control datetimepicker" id="dateinscrit" value='{$article->getDateCreate()|date_format:'%d/%m/%Y %R'}'>
          </div>
      </div>
    </div>
    <div class="col-md-6">
      <h2>Meta</h2>
      <div class="form-group">
        <label for="uri" class="col-sm-2 control-label">URI</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name='uri' value='{$article->getUri()}' placeholder='/' required>
        </div>
      </div>
      <div class="form-group">
        <label for="keywords" class="col-sm-2 control-label">Keywords</label>
        <div class="col-sm-6">
          <input id="tagKeywords" type="text" class="form-control" name='keywords' value='{implode data=$article->getKeywords()}'>
        </div>
      </div>
       <div class="form-group">
        <label for="pageTitle" class="col-sm-2 control-label">PageTitle</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name='pageTitle' placeholder="Titre de la page" value='{$article->getPageTitle()}'>
        </div>
      </div>
      <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name='description' placeholder="Description" value='{$article->getDescription()}'>
        </div>
      </div>
      <div class="form-group">
        <label for="language" class="col-sm-2 control-label">Langue</label>
        <div class="col-sm-6">
          <select id="selectLanguage" name='language' data-placeholder="Langue" value='{$article->getLanguage()}' required class='chosen-select'>
            <option value="">Choisir dans la liste</option>
            {foreach $langues as $langue}
              {if $langue@key == $article->getLanguage()}
              <option value="{$langue@key}" selected>{$langue}</option>
              {else}
              <option value="{$langue@key}">{$langue}</option>
              {/if}
            {/foreach}
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class='row'>
    <div class="col-md-12">
      <div class='row'>
        <h2 class='col-md-2' style='margin-top: auto;'>Contenu</h2>
        <div class="col-md-4 dropdown">
          <a id="drop1" class='btn btn-default dropdown-toggle' href="#" role="button" data-toggle="dropdown">Ajouter un contenu <b class="caret"></b></a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
            {foreach $templates as $tpl}
            <li><a class='addContent' tplId='{$tpl}'>{$tpl@key}</a></li>
            {/foreach}
          </ul>
        </div>
      </div>
    </div>
    <div class='row' id='currentContents'>
    {foreach $article->getContents() as $content}
      {include file="article/content/`$content["template"]`" content=$content idc=$content@key}
    {/foreach}
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-6">
      <span class="btn btn-primary" id='validateArticleUpdate'>Modifier</span>
    </div>
  </div>
</form>
<script language='javascript'>
$(document).ready(function(){
  $(document).on('click', '.removeContent', function(){
    $(this).parent().parent().parent().remove();
  });
  $('a.addContent').click(function(){
    var idc =  $('#currentContents').find('.row.content').length;
    make('article/contentTpl', {
        dataType: 'html',
        tpl: $(this).attr('tplId'),
        idc: idc
      }, 
      function(data){
        $('#currentContents').append(data);
        tinymce.init({ 
          selector: "textarea.mce[name='content["+idc+"][body]']",
          plugins: [
              "advlist autolink lists link image charmap preview anchor",
              "searchreplace visualblocks code",
              "insertdatetime media table contextmenu paste moxiemanager"
          ]
        });
      }, 
      ''
    );
  });
  $('.dropdown-toggle').dropdown();
  tinymce.init({
    plugins : 'advlist autolink link image lists charmap print preview code',plugins: [
              "advlist autolink lists link image charmap preview anchor",
              "searchreplace visualblocks code",
              "insertdatetime media table contextmenu paste moxiemanager"
          ],
    selector: "textarea.mce"
  });
  $('#tagKeywords').tagsInput({
    height: '40px'
  });
  $('#tagTags').tagsInput({
    height: '40px'
  });
  $('#selectAuthor').chosen({
       disable_search_threshold: 10,
       allow_single_deselect: true,
       width: "100%"
   });
  $('#selectLayout').chosen({
       disable_search_threshold: 10,
       allow_single_deselect: true,
       width: "100%"
   });
  $('#selectLanguage').chosen({
       disable_search_threshold: 10,
       allow_single_deselect: true,
       width: "100%"
   });
  $('#selectTemplate').chosen({
       disable_search_threshold: 10,
       allow_single_deselect: true,
       width: "100%"
   });
  $('.datetimepicker').datetimepicker({
      lang: 'fr',
      i18n:{
        fr:{
          months:['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
          dayOfWeek:['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa']
          }
        },
      timepicker: true,
      datepicker: true,
      format: 'd/m/Y H:i'
    });
  $('#validateArticleUpdate').click(function(){
    $.formSubmit($('#formUpdateArticle'), function(){
      reload('article/home');
    });
  });
});
</script>