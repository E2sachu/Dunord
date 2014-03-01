function getContent(div, url, data){
	url = $.baseUrl+url;
	div.html('<center><i class="fa fa-spinner fa-spin" style="font-size: 30px;"></i></center>');
	$.ajax({
			method: 'POST',
				url: url,
				async: false,
				data: data,
				success: 
				function(data){
				$(div).html(data);
			},
				dataType: 'html'
	});
}
function make(url, data, successHandle, successText, errorHandle, errorText){
	if (successText == undefined)
		successText = "Action effectuée avec succès ;)";
	if (errorText == undefined)
		errorText = "Une erreur est survenue :x";
	url = $.baseUrl+url;
	var dataType = 'json';
	if (data['dataType'] == 'html'){
		dataType = 'html';
		delete data['dataType']; 
	}
	$.ajax({
			method: 'POST',
			url: url,
			async: false,
			data: data,
			success: 
				function(data){
					if (successText != '')
						$.pnotify({type:'success' , text:successText});
					if (typeof successHandle == 'function')
						successHandle(data);
				},
			error: 
				function(data){
					if (errorText != '')
						$.pnotify({type:'error' , text:errorText});
					if (typeof errorHandle == 'function')
						errorHandle(data);
				},
			dataType: dataType
	});
}

function reload(url){
	url = $.baseUrl+url;
	$(location).attr('href', url);
}

function confirmDialog(data){
	initDialog(data);
	$('#dialogWindowButton .btn-primary').click(data['validate']);
	$('#dialogWindowButton .btn-default').click(function(){
		toggleDialog();
	});
}

function initDialog(data){
	$.dialogWindowResult = undefined;
	$('#dialogWindowTitle').html(data['title']);
	$('#dialogWindowBody').html(data['body']);
	$('#dialogWindow').modal(data['options']);
}

function toggleDialog(){
	$.dialogWindowResult = undefined;
	$('#dialogWindow').modal('toggle');
}
$.formSubmit = function(form, done){
	var data = {};
	var error = 0;
	var key = '';
	$('.form-group').removeClass('has-error');
	form.find(':input').each(function(){
		key = $(this).prop('name');
		if (key){
			if ($(this).prop('required')){
				if ($(this).is('.mce')){
					if (tinyMCE.get(key).getContent() == ''){
						error++;	
					}else
						data[key] = tinyMCE.get(key).getContent();
				}else if ($(this).val() == '' || $(this).val() == null){
					$(this).parents('.form-group').addClass('has-error');
					error++;
				}else
					data[key] = $(this).val();
			}else
				data[key] = $(this).val();
		}
	});
	if (error > 0){
		$.pnotify({ type:'error' , text:"Merci de remplir tous les champs", title:'Il manque des données', styling: 'bootstrap'});
	}else{
		$.ajax(form.prop('action'), {
			data: data,
			type: 'POST',
			dataType: 'json',
			async: false,
			success: done,
			error: function(data){
				$.pnotify({ type:'error' , text: data.text, title:data.title, styling: 'bootstrap'});		
			}
		});
	}
}
$(document).on('click', '.fa.fa-caret-square-o-down.mt', function(){
	var item = $(this).parent().parent().parent().find('table');
	if (item.length == 0)
		item = $(this).parent().parent().parent().find('form');
		if (item.length == 0)
			item = $($(this).parent().parent().parent().find('div')[1]);
	item.show();
	$(this).removeClass('fa-caret-square-o-down');
	$(this).addClass('fa-caret-square-o-up');
});
$(document).on('click', '.fa.fa-caret-square-o-up.mt', function(){
	var item = $(this).parent().parent().parent().find('table');
	$.test = $(this);
	if (item.length == 0)
		item = $(this).parent().parent().parent().find('form');
		if (item.length == 0)
			item = $($(this).parent().parent().parent().find('div')[1]);
	item.hide();
	$(this).removeClass('fa-caret-square-o-up');
	$(this).addClass('fa-caret-square-o-down');
});