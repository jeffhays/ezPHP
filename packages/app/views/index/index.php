
	<div class="row">
		<div class="large-8 columns">
			<h3>What is <?php echo config::name(); ?>?</h3>

			<div class="row">
				<div class="large-12 columns">
					<div class="panel callout" id="start1">
						<p>The <?php echo config::name(); ?> is a project created by Jeff Hays in 3 days as a way of learning namespaces and routing from scratch. It's a light weight easy-to-use HMVC framework that was programmed specifically to make it easy to use as possible for developers. This is accomplished by using as many sensible aliases and syntax options as possible.</p>
						<p>The routing was done so you don't have to be a regex nerd to complete the task at hand. It's setup with an associative array where the key of the array is the inbound URL and a value of the directory within packages/app that you want the view to load from (model, view and controller).</p>
						<p class="textcentered">
							<code>array('/url/action' => 'app/path');</code>
							<br>i.e.<br>
							<code>array('/admin' => 'areas/admin');</code>
						</p>
						<p>The routing is then dispatched to load the appropriate controller and model, and load <em>header.php</em>, <em>nav.php</em>, <em>index.php</em>, and <em>footer.php</em> template partials from the folder in the appropriate views folder that matches the action name - as most mvc frameworks do. Since this one is Hierarchical it also will grab each of those same files from the parent folder if any of them are missing from that view folder. It also will load a single file with the action name if it's in the top level of the views folder, which will load only that file without the <em>header.php</em>, <em>nav.php</em>, and <em>footer.php</em> files. This makes it easy to create a quick landing page that has all the front end content in one spot from top to bottom.</p>
						<p>This site is a live implementation of <?php echo config::name(); ?> and for those with access to the git repository, this is an exact copy of what you get when downloading the repo. <h3 class="subheader">The content below is dummy content...</h3></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="large-12 columns">
					<p>
						<a name="pricing" alt="<?php echo config::title(); ?> Pricing" title="<?php echo config::title(); ?> Pricing"><h3 class="subheader">Our Pricing</h3></a>
						<div class="panel">
							<div class="row">
								<div class="small-2 large-1 columns">
									<i class="icon-exclamation-sign secondary large-icon"></i>
								</div>
								<p class="small-10 large-11 columns">Pricing <em>does not apply</em> to clients. If you are someone's client and would like to place a request	<a href="/admin/login" class="tiny orange radius button" alt="<?php echo config::name(); ?> Login" title="<?php echo config::name(); ?> Login">Click Here</a> to get started!</p>
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
							    	<a href="#" class="small radius button" alt="<?php echo config::name(); ?> Trial" title="<?php echo config::name(); ?> Pricing"><i class="icon-shopping-cart"></i> Try Now</a>
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
							    <li class="cta-button"><a class="small radius button" href="#"><i class="icon-shopping-cart"></i> Buy Now</a></li>
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
							    <li class="cta-button"><a class="small radius button" href="#"><i class="icon-shopping-cart"></i> Buy Now</a></li>
							  </ul>
							</div>
						</div>
					</p>

				</div>
			</div>

		</div>

		<div class="large-4 columns">
			<h3>&nbsp;</h3>
			<h4><i class="icon-rocket medium-icon"></i> Try <?php echo config::name(); ?></h4>
			<p>Let <?php echo config::name(); ?> start managing your client requests today by signing up for a Free Trial. It's super easy to sign up! Just click the button below to start your free trial.</p>
			<a class="small radius orange button" href="#" alt="Start Your <?php echo config::name(); ?> Free Trial" title="Start Your <?php echo config::name(); ?> Free Trial">Sign Up Today!</a>
			<hr>
			<h4><i class="icon-truck medium-icon"></i> What's under the hood...</h4>
			<p>The <?php echo config::name(); ?> project is a custom object-oriented PHP framework using namespaces. The front end is powered by Foundation CSS, jQuery, and all sits on a RESTful URL structure.</p>
			<p><?php echo config::name(); ?> comes with its own database class that's done in a chained method query builder fashion similar to Kohana 3. The routing is custom and makes it easy to route inbound paths to a base directory to load a different set of models, views, and controllers via a simple array key/value pair.</p>

			<div class="panel">
				<h3 class="subheader">Updates</h3>
				<p>This means that you get new features automatically rolled out with your membership! We value the feedback of our clients (<u>and</u> your clients) and actively pursue suggestions for added enhancements in our newest version.</p>
				<p><h5 class="subheader">Current Version <h4 class="subheader"><?php echo config::version(); ?></h4></h5></p>
			</div>
					
			<div class="panel">
				<h3 class="subheader">To Do:</h3>
				<ul>
					<li>Implement user class for - central location for static user data.</li>
					<li>Move preg_replace string manipulation from view class and move to route::route_url() as originally intended.</li>
					<li>Add autoload routine for lib folder (and remove from public/index.php).</li>
				</ul>
			</div>
			
		</div>
	</div>
