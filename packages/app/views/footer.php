
	<footer class="main">
		<div class="row">
			<div class="large-12 columns textcentered">&copy; <?php echo date('Y') . ' ' . config::name(); ?></div>
		</div>
	</footer>
	<script>
	document.write('<script src=' +
	('__proto__' in {} ? '<?php echo config::js(); ?>vendor/zepto' : 'js/vendor/jquery') +
	'.js><\/script>')
	</script>
<?php
	html::js('jquery.min.js');
	html::js('jquery-ui-1.10.3.custom.min.js');
	html::js('vendor/custom.modernizr.js');
	html::js('foundation.min.js');
	html::js('ez.js');
?>
	<script>$(document).foundation();</script>
</body>
</html>