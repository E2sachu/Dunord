<div class="row">
	<div class="col-md-2" id='menu'>{include file='article/menu.tpl'}</div>
	{if isset($corps)}
	<div class="col-md-10" id='content'>{include file=$corps}</div>
	{else}
	<div class="col-md-10" id='content'>{include file='article/list.tpl'}</div>
	{/if}
</div>