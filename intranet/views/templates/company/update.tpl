<h2><a href='{url path="company/view/"}{$company->getId()}'><i class="fa fa-reply"></i></a> Modifier une compagnie</h2>
<form class="form-horizontal" role="form" action='add' id='formUpdateCompany'>
  <div class="col-md-6" id="companyUpdate" uid='{$company->getId()}'>
		<div class="form-group">
  		<label for="label" class="col-sm-2 control-label">Label</label>
  		<div class="col-sm-6">
    		<input type="text" class="form-control" name='label' placeholder="Label" value='{$company->getLabel()}' required>
  		</div>
  	</div>
  	<div class="form-group">
  		<label for="adr1" class="col-sm-2 control-label">Adresse</label>
  		<div class="col-sm-6">
    		<input type="text" class="form-control" name='adr1' placeholder="Adresse du siège" value='{$company->getAddress1()}' required>
  		</div>
  	</div>
  	<div class="form-group">
  		<label for="adr2" class="col-sm-2 control-label"></label>
  		<div class="col-sm-6">
    		<input type="text" class="form-control" name='adr2' placeholder="Complément" value='{$company->getAddress2()}'>
  		</div>
  	</div>
	  <div class="form-group">
  		<label for="pays" class="col-sm-2 control-label">Pays</label>
  		<div class="col-sm-6">
  		 	<select id="pays" name='pays' data-placeholder="pays" required class='chosen-select'>
    			<option value="">Choisir dans la liste</option>
    			{foreach $countries as $country}
    				{if $country@key == $company->getCountry()}
    					<option value="{$country@key}" selected>{$country}</option>
    				{else}
 					    <option value="{$country@key}">{$country}</option>
 					  {/if}
    			{/foreach}
  			</select>
  		</div>
	  </div>
  	<div class="form-group">
  		<label for="ville" class="col-sm-2 control-label">Ville</label>
  		<div class="col-sm-6">
    		<input id="ville" class="form-control" name='ville' placeholder="Ville" required>
    	</div>
  	</div>
    <div class="form-group">
      <label class="col-sm-2 control-label"></label>
        <div class="col-sm-6">
          <h4><strong>Contact</strong></h4>
        </div>
    </div>
    <div class="form-group">
      <label for="contactTel" class="col-sm-2 control-label">Tel</label>
      <div class="col-sm-6">
        <input id="contactTel" class="form-control" name='contactTel' placeholder="Numéro de téléphone" value='{$company->getTelContact()}' required>
      </div>
    </div>
    <div class="form-group">
      <label for="contactMail" class="col-sm-2 control-label">mail</label>
      <div class="col-sm-6">
        <input id="contactMail" class="form-control" name='contactMail' placeholder="mail" value='{$company->getMailContact()}' required>
      </div>
    </div>
  </div>
  <div class="col-md-6" id="companyUpdate">
    <div class="form-group">
      <label for="sector" class="col-sm-2 control-label">Secteur</label>
      <div class="col-sm-6">
        <select id="sector" name='sector' data-placeholder="secteur" required class='chosen-select'>
          <option value="">Choisir dans la liste</option>
          {foreach $sectors as $sector}
            {if $sector@key == $company->getActivitySector()}
              <option value="{$sector@key}" selected>{$sector}</option>
            {else}
              <option value="{$sector@key}">{$sector}</option>
            {/if}
          {/foreach}
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="effective" class="col-sm-2 control-label">Effectif</label>
      <div class="col-sm-6">
        <select id="effective" name='effective' data-placeholder="effectif" required class='chosen-select'>
          <option value="">Choisir dans la liste</option>
          {foreach $effectives as $effective}
            {if $effective@key == $company->getStaffSize()}
              <option value="{$effective@key}" selected>{$effective}</option>
            {else}
          <option value="{$effective@key}">{$effective}</option>
          {/if}
          {/foreach}
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="ca" class="col-sm-2 control-label">CA</label>
      <div class="col-sm-6">
        <select id="ca" name='ca' data-placeholder="ca" required class='chosen-select'>
          <option value="">Choisir dans la liste</option>
          {foreach $cas as $ca}
            {if $ca@key == $company->getCa()}
              <option value="{$ca@key}" selected>{$ca}</option>
            {else}
          <option value="{$ca@key}">{$ca}</option>
          {/if}
          {/foreach}
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="createYear" class="col-sm-2 control-label">création</label>
        <div class="col-sm-6">
          <input id="creatYear" class="form-control" name='createYear' placeholder="Année de création" value='{$company->getCreationYear()}' required>
        </div>
    </div>
    <div class="form-group">
      <label for="siren" class="col-sm-2 control-label">Siren</label>
        <div class="col-sm-6">
          <input id="siren" class="form-control" name='siren' placeholder="Siren" value='{$company->getSerialNumber()}' required>
        </div>
    </div>
    <div class="form-group">
      <label for="tva" class="col-sm-2 control-label">TVA</label>
      <div class="col-sm-6">
        <input id="tva" class="form-control" name='tva' placeholder="TVA intra-communautaire" value='{$company->getTvaIntraCom()}' required>
      </div>
    </div>
    <div class="form-group">
      <label for="website" class="col-sm-2 control-label">Site Web</label>
      <div class="col-sm-6">
        <span class="btn btn-primary addWebsite"><i class="fa fa-plus fa-3"></i></span>
      </div>  
    </div>
    <div class="row website" id="currentWebsite">
      {if is_array($company->getWebsite())}
        {foreach $company->getWebsite() as $website}
          <div class="form-group">
            <div class="col-sm-2"> 
              <span class="btn btn-danger removeWebsite"><i class="fa fa-minus fa-3"></i></span>
            </div>
            <div class="col-sm-6">
              <input class="form-control" name='website[]' placeholder="Site web" value='{$website}' required>
            </div>
          </div>
        {/foreach}
      {/if}
    </div>  
  </div>    
</form>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-6">
    <button class="btn btn-primary" id='validateUserUpdate'>Modifier</button>
  </div>
</div>
<script language='javascript'>
$(document).ready(function(){
  $(document).on('click', '.removeWebsite', function(){
    $(this).parent().parent().remove();
  });
  $('.addWebsite').click(function(){
    $('#currentWebsite').append("<div class=\"form-group\"><div class=\"col-sm-2\"> <span class=\"btn btn-danger removeWebsite\"><i class=\"fa fa-minus fa-3\"></i></span></div><div class=\"col-sm-6\"><input class=\"form-control\" name='website[]' placeholder=\"Site web\" required></div></div>");
  });
	$('#sector').chosen({
    disable_search_threshold: 10,
    allow_single_deselect: true,
    width: "100%"
  });
  $('#pays').chosen({
    disable_search_threshold: 10,
    allow_single_deselect: true,
    width: "100%"
  });
  $('#effective').chosen({
    disable_search_threshold: 10,
    allow_single_deselect: true,
    width: "100%"
  });
  $('#ca').chosen({
    disable_search_threshold: 10,
    allow_single_deselect: true,
    width: "100%"
  });
  $('#validateCompanyUpdate').click(function(){
    $.formSubmit($('#formUpdatecompany'), function(){
      reload('company/view/'+$('#companyUpdate').attr('uid'));
    });
  });
  $('#ville').autocomplete({ //marche toujours pas
     source: function( request, response ) {
        $.ajax({
            url: $.baseUrl+"autocomplete/city?q="+request.term,
            dataType: "json",
            success: function( data ) {
               response( $.map( data, function( item ) {
                  return item.name;
              }));
            }
        });
      }
  });
});
</script>
