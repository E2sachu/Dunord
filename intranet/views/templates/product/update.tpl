<H2>Modification de produit</H2>
<form class="form-horizontal" role="form" method='POST' action="{url path='product/update/'}{$product->getId()}">
  <div class="form-group">
    <label for="productLabel" class="col-sm-2 control-label">Label</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="productLabel" name='productLabel' placeholder="Pack de 20 mise en relation" required value='{$product->getLabel()}'>
    </div>
  </div>
  <div class="form-group">
    <label for="productDescription" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="productDescription" name='productDescription' placeholder="TOTO" value="{$product->getDescription()}">
    </div>
  </div>
  <div class="form-group">
    <label for="price" class="col-sm-2 control-label">Prix HT</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" name='productPrice' id="productPrice" placeholder="190" required value='{$product->getPrice()}'>
    </div>
  </div>
  <div class="form-group">
    <label for="productNbRelation" class="col-sm-2 control-label">Nombre de mise en relation</label>
    <div class="col-sm-6">
      <input type="number" name='productNbRelation' class="form-control" id="productNbRelation" placeholder="42" value='{$product->getParams("number")}' required>
    </div>
  </div>
  <div class="form-group">
    <label for="productDurationRelation" class="col-sm-2 control-label">Durée de validité</label>
    <div class="col-sm-6">
      <input type="number" name='productDurationRelation' class="form-control" id="productDurationRelation" placeholder="12" value='{$product->getParams("duration")}' required disabled>
    </div>
  </div>
  <div class="form-group">
    <label for="productExecFct" class="col-sm-2 control-label">Methode d'éxecution</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="productExecFct" name='productExecFct' value="{$product->getExecFct()}" required disabled>
    </div>
  </div>
  <div class="form-group">
    <label for="productType" class="col-sm-2 control-label">Type</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="productType" name='productType' value="{$product->getType()}" required disabled>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button class="btn btn-primary" id='validateProductAdd'>Modifier</button>
    </div>
  </div>
</form>