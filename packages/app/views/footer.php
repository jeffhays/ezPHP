
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
	html::js('vendor/custom.modernizr.js');
	html::js('foundation.min.js');
	html::js('ez.js');
?>
	<script>$(document).foundation();</script>
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-43641037-1', 'ezphp.org');
	  ga('send', 'pageview');
	</script>
</body>
</html>