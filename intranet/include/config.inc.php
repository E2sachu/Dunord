<?php
C::s('AUTHFILE', __DIR__.'/../../data/auth');
C::s('HTMLCONTROLLER_DEFAULT_CSS', array(
		'static/css/bootstrap.min.css',
		'static/css/bootstrap-theme.min.css',
		'static/css/font-awesome.min.css',
		'static/css/jquery.pnotify.default.css',
		'static/css/jquery.dataTables.css',
		'static/css/jquery.chosen.min.css',
		'static/css/jquery.datetimepicker.css',
		'static/css/jquery.tagsinput.css',
		'static/css/jquery.ui.css',
		'static/css/style.css',
	));
C::s('HTMLCONTROLLER_DEFAULT_JS', array(
			'static/js/libs/jquery.min.js',
			'static/js/libs/jquery.pnotify.min.js',
			'static/js/libs/jquery.dataTables.min.js',
			'static/js/libs/bootstrap.min.js',
			'static/js/libs/charts.min.js',
			'static/js/libs/jquery.ui.js',
			'static/js/libs/jquery.datetimepicker.js',
			'static/js/libs/jquery.chosen.min.js',
			'static/js/libs/jquery.ajaxChosen.min.js',
			'static/js/libs/jquery.tagsinput.js',
			'static/js/libs/jquery.tagsinput.min.js',
			'static/js/libs/tinymce/jquery.tinymce.min.js',
			'static/js/libs/tinymce/tinymce.min.js',
			'static/js/main.js',
	));
?>