<div class='row content'>
	<div class='row col-md-12'>
		<div class="col-md-1">
			<span class='btn btn-danger removeContent'><i class='fa fa-trash-o'></i></span>
		</div>
		<div class="form-group col-md-4">
			<label for="subtitle" class="col-sm-4 control-label">Sous-titre (&lt;H2&gt;)</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" name='content[{$idc}][subtitle]' placeholder="Sous-titre">
			</div>
		</div>
		<div class="form-group col-md-4">
			<label for="contentTemplate" class="col-sm-12 control-label">Template : YouTube</label>
			<input type='hidden' name='content[{$idc}][template]' value='youtube.tpl'>
		</div>
	</div>
	<div class='row col-md-12' id='articleContents'>
		<div class="form-group col-sm-12">
			<input type"text" class="form-control" name='content[{$idc}][body]' placeholder="id de la video">
		</div>
	</div>
</div>