<h2>Ajouter un produit</h2>
<form class="form-horizontal" role="form" method='POST' action='add'>
  <div class="form-group">
    <label for="productLabel" class="col-sm-2 control-label">Label</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="productLabel" name='productLabel' placeholder="Pack de 20 mise en relation" required>
    </div>
  </div>
  <div class="form-group">
    <label for="productDescription" class="col-sm-2 control-label">Description</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="productDescription" name='productDescription' placeholder="TOTO">
    </div>
  </div>
  <div class="form-group">
    <label for="price" class="col-sm-2 control-label">Prix HT</label>
    <div class="col-sm-6">
      <input type="number" class="form-control" name='productPrice' id="productPrice" placeholder="190" required>
    </div>
  </div>
  <div class="form-group">
    <label for="productNbRelation" class="col-sm-2 control-label">Nombre de mise en relation</label>
    <div class="col-sm-6">
      <input type="number" name='productNbRelation' class="form-control" id="productNbRelation" placeholder="42" required>
    </div>
  </div>
  <div class="form-group">
    <label for="productDurationRelation" class="col-sm-2 control-label">Durée de validité</label>
    <div class="col-sm-6">
      <input type="number" name='productDurationRelation' class="form-control" id="productDurationRelation" placeholder="12" required disabled>
    </div>
  </div>
  <div class="form-group">
    <label for="productExecFct" class="col-sm-2 control-label">Methode d'éxecution</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="productExecFct" name='productExecFct' value="addPutInRelation" required disabled>
    </div>
  </div>
  <div class="form-group">
    <label for="productType" class="col-sm-2 control-label">Type</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="productType" name='productType' value="relation" required disabled>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-6">
      <button class="btn btn-primary" id='validateProductAdd'>Ajouter</button>
    </div>
  </div>
</form>