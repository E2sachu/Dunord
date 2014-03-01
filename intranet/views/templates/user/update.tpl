<h2><a href='{url path="user/view/"}{$user->getId()}'><i class="fa fa-reply"></i></a> Modifier un utilisateur</h2>
<div class="col-md-6" id="userUpdate" uid='{$user->getId()}'>
  <form class="form-horizontal" role="form" action='{url path="user/update/"}{$user->getId()}' id='formUpdateUser'>
    <div class="form-group">
      <label for="userNom" class="col-sm-2 control-label">Nom</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name='user[nom]' placeholder="Nom" value='{$user->getNom()}' required>
      </div>
    </div>
    <div class="form-group">
      <label for="userPrenom" class="col-sm-2 control-label">Pr&eacute;nom</label>
      <div class="col-sm-6">
        <input type="text" class="form-control" name='user[prenom]' placeholder="Pr&eacute;nom" value='{$user->getPrenom()}' required >
      </div>
    </div>
    <div class="form-group">
      <label for="userMail" class="col-sm-2 control-label">Mail</label>
      <div class="col-sm-6">
        <input type="mail" class="form-control" name='user[mail]' placeholder="example@monkey-tie.com" value='{$user->getMail1()}'required>
      </div>
    </div>
    <div class="form-group">
      <label for="userType" class="col-sm-2 control-label">Type d'utilisateur</label>
      <div class="col-sm-6">
        <select id="profilType" name='user[profilType]' data-placeholder="Type d'utilisateur" required class='chosen-select'>
          <option>Type d'utilisateur</option>
          {if $user->getProfilType() == 1}
          <option value="1" selected>Candidat</option>
          {else}
          <option value="1">Candidat</option>
          {/if}
          {if $user->getProfilType() == 2}
          <option value="2" selected>Recruteur</option>
          {else}
          <option value="2">Recruteur</option>
          {/if}
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="userParent" class="col-sm-2 control-label">Parent</label>
      <div class="col-sm-6">
        <select id="userParent" name='user[parent]' class='chosen-select'>
          <option value='' selected>Choisir dans la liste</option>
          {foreach $recruiters as $recruiter}
          {if $user->getParentId() == $recruiter->getId()}
          <option value='{$recruiter->getId()}' selected>{$recruiter->getNom()} {$recruiter->getPrenom()}</option>
          {else}
          <option value='{$recruiter->getId()}'>{$recruiter->getNom()} {$recruiter->getPrenom()}</option>
          {/if}
          {/foreach}
        </select>
      </div>
    </div>
  </form>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button class="btn btn-primary" id='validateUserUpdate'>Modifier</button>
    </div>
  </div>
</div>

<script language='javascript'>
$(document).ready(function(){
  $('#userParent').chosen({
      disable_search_threshold: 10,
      allow_single_deselect: true,
      width: "100%"
    });
  $('#profilType').chosen({
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
  $('#validateUserUpdate').click(function(){
    $.formSubmit($('#formUpdateUser'), function(){
      reload('user/view/'+$('#userUpdate').attr('uid'));
    });
  });
});
</script>