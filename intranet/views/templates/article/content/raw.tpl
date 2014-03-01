<div class='row content'>
	<div class='row col-md-12'>
		<div class="col-md-1">
			<span class='btn btn-danger removeContent'><i class='fa fa-trash-o'></i></span>
		</div>
		<div class="form-group col-md-4">
			<label for="subtitle" class="col-sm-4 control-label">Sous-titre (&lt;H2&gt;)</label>
			<div class="col-sm-8">
				{if isset($content)}
				<input type="text" class="form-control" name='content[{$idc}][subtitle]' placeholder="Sous-titre" value='{$content.subtitle}'>
				{else}
				<input type="text" class="form-control" name='content[{$idc}][subtitle]' placeholder="Sous-titre">
				{/if}
			</div>
		</div>
		<div class="form-group col-md-4">
			<label for="contentTemplate" class="col-sm-12 control-label">Template : raw.tpl</label>
			<input type='hidden' name='content[{$idc}][template]' value='raw.tpl'>
		</div>
	</div>
	<div class='row col-md-12' id='articleContents'>
		<div class="form-group col-sm-12">
			{if isset($content)}
			<textarea class="form-control mce" name="content[{$idc}][body]" placeholder="content" required>{$content.body}</textarea>
			{else}
			<textarea class="form-control mce" name="content[{$idc}][body]" placeholder="content" required></textarea>
			{/if}
		</div>
	</div>
</div>