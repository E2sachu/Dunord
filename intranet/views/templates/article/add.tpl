<h1>Nouvel article </h1>
<form class="form-horizontal" role="form" action='add' id='formAddArticle' method='POST'>
  <div class="row" id="articleAdd">
    <div class="col-md-6">
    	<h2>Informations</h2>
      <div class="form-group">
    		<label for="author" class="col-sm-2 control-label">Auteur</label>
    		<div class="col-sm-6">
      		<select id="selectAuthor" name='author' data-placeholder="Auteur" required class='chosen-select'>
            <option value="">Choisir dans la liste</option>
            {foreach $authors as $author}
              {if $admin->getId() == $author@key}
              <option value="{$author@key}" selected>{$author|capitalize:true}</option>
              {else}
              <option value="{$author@key}">{$author|capitalize:true}</option>
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
                {if $layout@key == 'default'}
                <option value="{$layout@key}" selected>{$layout.tpl}</option>
                {else}
                <option value="{$layout@key}">{$layout.tpl}</option>
                {/if}
                }
              {/foreach}
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Titre (&lt;H1&gt;)</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name='title' placeholder="Titre" required>
        </div>
      </div>
      <div class="form-group">
        <label for="tags" class="col-sm-2 control-label">Tags</label>
        <div class="col-sm-6">
          <input id="tagTags" type="text" class="form-control" name='tags'>
        </div>
      </div>
      <div class="form-group">
          <label for="datePublished" class="col-sm-2 control-label">Publication</label>
          <div class="col-sm-6">
            <input type="text" name='datePublished' class="form-control datetimepicker" id="dateinscrit" value='{$now|date_format:'%d/%m/%Y %R'}'>
          </div>
      </div>
    </div>
    <div class="col-md-6">
      <h2>Meta</h2>
      <div class="form-group">
        <label for="uri" class="col-sm-2 control-label">URI</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name='uri' value='/' placeholder='/' required>
        </div>
      </div>
      <div class="form-group">
        <label for="keywords" class="col-sm-2 control-label">Keywords</label>
        <div class="col-sm-6">
          <input id="tagKeywords" type="text" class="form-control" name='keywords' value="">
        </div>
      </div>
       <div class="form-group">
        <label for="pageTitle" class="col-sm-2 control-label">PageTitle</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name='pageTitle' placeholder="Titre de la page">
        </div>
      </div>
      <div class="form-group">
        <label for="description" class="col-sm-2 control-label">Description</label>
        <div class="col-sm-6">
          <input type="text" class="form-control" name='description' placeholder="Description">
        </div>
      </div>
      <div class="form-group">
        <label for="language" class="col-sm-2 control-label">Langue</label>
        <div class="col-sm-6">
          <select id="selectLanguage" name='language' data-placeholder="Langue" required class='chosen-select'>
            <option value="">Choisir dans la liste</option>
            {foreach $langues as $langue}
              {if $langue@key == 'fr'}
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
      <div class='row content'>
        <div class='row col-md-12'>
          <div class="col-md-1">
            <span class='btn btn-danger removeContent'><i class='fa fa-trash-o'></i></span>
          </div>
          <div class="form-group col-md-4">
            <label for="subtitle" class="col-sm-4 control-label">Sous-titre (&lt;H2&gt;)</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name='content[0][subtitle]' placeholder="Sous-titre">
            </div>
          </div>
          <div class="form-group col-md-4">
            <label for="contentTemplate" class="col-sm-12 control-label">Template : Raw</label>
            <input type='hidden' name='content[0][template]' value='raw.tpl'>
          </div>
        </div>
        <div class='row col-md-12' id='articleContents'>
          <div class="form-group col-sm-12">
            <textarea class="form-control mce" name="content[0][body]" placeholder="content" required></textarea>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-6">
      <span class="btn btn-primary" id='validateArticleAdd'>Ajouter</span>
    </div>
  </div>
</form>
<script language='javascript'>
$(document).ready(function(){
  $(document).on('click', '.removeContent', function(){
    $(this).parent().parent().parent().remove();
  });
  $('input[name="title"]').change(function(){
    $('input[name="pageTitle"]').val($(this).val()+' | Monkey tie');
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
          plugins: [
              "advlist autolink lists link image charmap preview anchor",
              "searchreplace visualblocks code",
              "insertdatetime media table contextmenu paste moxiemanager"
          ], 
          selector: "textarea.mce[name='content["+idc+"][body]']"
        });
      }, 
      ''
    );
  });
  $('.dropdown-toggle').dropdown();
  tinymce.init({
    plugins: [
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
  $('#validateArticleAdd').click(function(){
    $.formSubmit($('#formAddArticle'), function(){
      reload('article/home');
    });
  });
});
</script>