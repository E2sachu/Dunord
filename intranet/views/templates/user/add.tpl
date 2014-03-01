<h1>Ajouter un utilisateur</h1>
<form class="form-horizontal" role="form" action='add' id='' method='POST'>
  <div class="col-md-6" id="userAdd">
    <div class="form-group">
      <label for="userNom" class="col-sm-2 control-label">Nom</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name='user[nom]' placeholder="Nom" required>
      </div>
    </div>
    <div class="form-group">
      <label for="userPrenom" class="col-sm-2 control-label">Pr&eacute;nom</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name='user[prenom]' id="prenom" placeholder="Pr&eacute;nom" required>
      </div>
    </div>
    <div class="form-group">
      <label for="userMail" class="col-sm-2 control-label">Mail</label>
      <div class="col-sm-6">
        <input type="mail" class="form-control" name='user[mail]' id="mail" placeholder="example@monkey-tie.com" required>
      </div>
    </div>
    <div class="form-group">
      <label for="userMdp" class="col-sm-2 control-label">Mot de passe</label>
      <div class="col-sm-6">
        <input type="mail" class="form-control" name='user[password]' id="password" value="MonkeyTie2014" required>
      </div>
    </div>
    <div class="form-group">
      <label for="userIncrit" class="col-sm-2 control-label">Date d'inscription</label>
      <div class="col-sm-6">
        <input type="text" name='user[dateinscrit]' class="form-control datetimepicker" id="dateinscrit" value='{$now|date_format:'%d/%m/%Y %R'}'>
      </div>
    </div>
    <div class="form-group">
      <label for="userType" class="col-sm-2 control-label">Type d'utilisateur</label>
      <div class="col-sm-6">
        <select id="profilType" name='user[profilType]' data-placeholder="Type d'utilisateur" required class='chosen-select'>
          <option>Type d'utilisateur</option>
          <option value="1">Candidat</option>
          <option value="2" selected>Recruteur</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="userActiv" class="col-sm-2 control-label">Compte</label>
      <div class="col-sm-6">
        <div class="col-md-6">
          <input type="radio" name="user[actived]" value="true" checked>Activ&eacute;
        </div>
        <div class="col-md-6">
          <input type="radio" name="user[actived]" value="false" >Desactiv&eacute;
        </div>
      </div> 
    </div>
     <div class="form-group">
      <label for="userActiv" class="col-sm-2 control-label">Verrouillage</label>
      <div class="col-sm-6">
        <div class="col-md-6">
          <input type="radio" name="user[locked]" value="true">Activ&eacute;
        </div>
        <div class="col-md-6">
          <input type="radio" name="user[locked]" value="false" checked>Desactiv&eacute;
        </div>
      </div> 
    </div>
    <div class="form-group">
      <label for="userParent" class="col-sm-2 control-label">Parent</label>
      <div class="col-sm-6">
        <select id="userParent" name='user[parent]' class='chosen-select'>
          <option value='' selected>Choisir dans la liste</option>
          {foreach $recruiters as $recruiter}
          <option value='{$recruiter->getId()}'>{$recruiter->getNom()} {$recruiter->getPrenom()}</option>
          {/foreach}
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-6">
        <button class="btn btn-primary" id='validateUserAdd'>Ajouter</button>
      </div>
    </div>
  </div>
  <div class="col-md-6" id='companyAdd'>
    <div class="form-group">
      <label for='company[id]' class="col-sm-2 control-label">Compagnie d&eacute;j&agrave; enregistré</label>
      <div class="col-sm-6">
        <select id="companyId" name='company[id]' class='chosen-select'>
          <option value='' selected>Choisir dans la liste</option>
          {foreach $companys as $societe}
          <option value='{$societe->getId()}'>{$societe->getLabel()}</option>
          {/foreach}
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="companyLabel" class="col-sm-2 control-label">Label</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name='company[label]' placeholder="Nom de la companie">
      </div>
    </div>
    <div class="form-group">
      <label for="company[addr1]" class="col-sm-2 control-label">Adresse</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name='company[addr1]' placeholder="Adresse">
      </div>
    </div>
    <div class="form-group">
      <label for="company[addr2]" class="col-sm-2 control-label">Compl&eacute;ment</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name='company[addr2]' placeholder="Compl&eacute;ment">
      </div>
    </div>
    <div class="form-group">
      <label for="company[country]" class="col-sm-2 control-label">Pays</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name='company[country]' placeholder="Pays">
      </div>
    </div>
    <div class="form-group">
      <label for='company[city]' class="col-sm-2 control-label">Ville</label>
      <div class="col-md-6">
        <input type="text" class="form-control" name='company[city]' placeholder="Ville">
      </div>
    </div>
    <div class="form-group">
      <label for='company[zipcode]' class="col-sm-2 control-label">Code postal</label>
      <div class="col-md-6">
        <input type="text" class="form-control" name='company[zipcode]' placeholder="Code postal">
      </div>
    </div>
    <div class="form-group">
      <label for='company[mail]' class="col-sm-2 control-label">Mail de contact</label>
      <div class="col-sm-6">
        <input type="mail" class="form-control" name='company[mail]' placeholder="example@monkey-tie.com">
      </div>
    </div>
    <div class="form-group">
      <label for='company[datecrea]' class="col-sm-2 control-label">Date de cr&eacute;ation</label>
      <div class="col-sm-6">
        <input type="text" name='company[datecrea]' class="form-control datetimepicker">
      </div>
    </div>
    <div class="form-group">
      <label for='company[freeApplication]' class="col-sm-2 control-label">Candidature libre</label>
      <div class="col-sm-6">
        <div class="col-md-6">
          <input type="radio" name='company[freeApplication]' value="true" checked>oui
        </div>
        <div class="col-md-6">
          <input type="radio" name='company[freeApplication]' value="false" >non
        </div> 
      </div>
    </div>
    <div class="form-group">
      <label for='company[mission]' class="col-sm-2 control-label">Mission</label>
      <div class="col-sm-6">
       <input type="text" class="form-control" name='company[mission]' id="mission" placeholder="Mission">
      </div>      
    </div>
    <div class="form-group">
      <label for='company[visible]' class="col-sm-2 control-label">Visible</label>
      <div class="col-sm-6">
        <div class="col-md-6">
          <input type="radio" name='company[visible]' value="true" checked>oui
        </div>
        <div class="col-md-6">
          <input type="radio" name='company[visible]' value="false" >non
        </div> 
      </div>
    </div>
    <div class="form-group">
      <label for='company[parent]' class="col-sm-2 control-label">Parent</label>
      <div class="col-sm-6">
        <select id="companyParent" name='company[parent]' class='chosen-select'>
          <option value='' selected>Choisir dans la liste</option>
          {foreach $companys as $societe}
          <option value='{$societe->getId()}'>{$societe->getLabel()}</option>
          {/foreach}
        </select>
      </div>
    </div>
  </div>
</form>


<script language='javascript'>
$(document).ready(function(){
  $('#profilType').chosen({
       disable_search_threshold: 10,
       allow_single_deselect: true,
       width: "100%"
   });
  $('#userParent').chosen({
      disable_search_threshold: 10,
      allow_single_deselect: true,
      width: "100%"
  });
  $('#companyParent').chosen({
      disable_search_threshold: 10,
      allow_single_deselect: true,
      width: "100%"
  });
  $('#companyId').chosen({
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
  $('#validateUserAdd').click(function(){
    $.formSubmit($('#formAddUser'), function(){
      reload('user/home');
    });
  });
});
</script>