<!DOCTYPE html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><html class="no-js" lang="en"><!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title><?php echo config::title(); ?></title>
<?php
	html::css('normalize.css');
	html::css('font-awesome.min.css');
	html::css('foundation.min.css');
	html::css('jquery-ui-1.10.3.custom.min.css');
	html::css('ez.css');
?>
	<link href="/img/favicon.png" rel="icon" type="image/png">
</head>
<body>
	<div class="row content">
		<div class="large-12 columns">
			<p>
				<a name="pricing" alt="<?php echo config::title(); ?> Pricing" title="<?php echo config::title(); ?> Pricing"><h3 class="subheader">Sample Pricing Landing Page</h3></a>
				<p>This page is just here to show you that you can alternatively have a file in the view folder instead of a folder and it will load as a landing page in that it doesn't load <em>header.php</em>, <em>nav.php</em>, <em>index.php</em>, and <em>footer.php</em>. This file is the entire view from top to bottom.</p>
				<h4 class="subheader">The content below this line is sample content...</h4>
				<hr>
				<div class="panel">
					<div class="row">
						<div class="small-2 large-1 columns">
							<i class="fa fa-exclamation-triangle secondary large-icon"></i>
						</div>
						<p class="small-10 large-11 columns">Pricing <em>does not apply</em> to clients. If you are someone's client and would like to place a request	<a href="/admin/login" class="tiny orange button" alt="<?php echo config::name(); ?> Login" title="<?php echo config::name(); ?> Login">Click Here</a> to get started!</p>
					</div>
				</div>
				<div class="row">
					<div class="large-4 columns">
					  <ul class="pricing-table">
					    <li class="title">Trial</li>
					    <li class="price">Free</li>
					    <li class="description">Free Trial (60 days)</li>
					    <li class="bullet-item">1 User</li>
					    <li class="bullet-item">5 Clients</li>
					    <li class="bullet-item">10 Requests Per Client</li>
					    <li class="cta-button">
					    	<a href="#" class="small button" alt="<?php echo config::name(); ?> Trial" title="<?php echo config::name(); ?> Pricing"><i class="fa fa-shopping-cart"></i> Try Now</a>
					    </li>
					  </ul>
					</div>
					<div class="large-4 columns">
					  <ul class="pricing-table">
					    <li class="title">Standard</li>
					    <li class="price">$20/mo</li>
					    <li class="description">The Most Popular</li>
					    <li class="bullet-item">5 Users</li>
					    <li class="bullet-item">50 Clients</li>
					    <li class="bullet-item">100 Requests Per Client</li>
					    <li class="cta-button"><a class="small button" href="#"><i class="fa fa-shopping-cart"></i> Buy Now</a></li>
					  </ul>
					</div>
					<div class="large-4 columns">
					  <ul class="pricing-table">
					    <li class="title">Premium</li>
					    <li class="price">$60/mo</li>
					    <li class="description">The Most Robust</li>
					    <li class="bullet-item">Unlimited Users</li>
					    <li class="bullet-item">Unlimited Clients</li>
					    <li class="bullet-item">Unlimited Requests Per Client</li>
					    <li class="cta-button"><a class="small button" href="#"><i class="fa fa-shopping-cart"></i> Buy Now</a></li>
					  </ul>
					</div>
				</div>
			</p>
		</div>
	</div>
	
</body>
</html>