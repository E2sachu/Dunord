<h2>Ajouter un coupon</h2>
<form class="form-horizontal" role="form" action='add' id='formAddCoupon'>
  <div class="form-group">
    <label for="productId" class="col-sm-2 control-label">Produit</label>
    <div class="col-sm-6">
      <select id="productId" name='productId' data-placeholder="Produit associé" required class='chosen-select'>
        <option></option>
        {foreach $products as $product}
        <option value="{$product->getId()}">{$product->getLabel()}</option>
        {/foreach}
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="couponKey" class="col-sm-2 control-label">Cl&eacute;</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" name='couponKey' id="couponKey" placeholder="SEMASHOW2013" required>
    </div>
  </div>
  <div class="form-group">
    <label for="couponDateStart" class="col-sm-2 control-label">Date de début de validité</label>
    <div class="col-sm-6">
      <input type="datetime" name='couponDateStart' class="form-control datetimepicker" id="couponDateStart">
    </div>
  </div>
  <div class="form-group">
    <label for="couponDateEnd" class="col-sm-2 control-label">Date de fin de validité</label>
    <div class="col-sm-6">
      <input type="datetime" name='couponDateEnd' class="form-control datetimepicker" id="couponDateEnd">
    </div>
  </div>
  <div class="form-group">
    <label for="couponCounter" class="col-sm-2 control-label">Compteur</label>
    <div class="col-sm-6">
      <input type="number" name='couponCounter' class="form-control" id="couponCounter" value="-1">
    </div>
  </div>
  <div class="form-group">
    <label for="couponPrice" class="col-sm-2 control-label">Prix</label>
    <div class="col-sm-6">
      <input type="number" name='couponPrice' class="form-control" id="couponPrice" value="0">
    </div>
  </div>
  </form>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button class="btn btn-primary" id='validateProductAdd'>Ajouter</button>
    </div>
  </div>

<script language='javascript'>
$(document).ready(function(){
  $('#productId').chosen({
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
  $('#validateProductAdd').click(function(){
    $.formSubmit($('#formAddCoupon'), function(){
      reload('coupon/home');
    });
  });
});
</script>