
	<div class="row">
		<div class="large-8 columns">
			<h3>What is <?php echo config::name(); ?>?</h3>
			<div class="row">
				<div class="large-12 columns">
					<div class="panel callout" id="start1">
						<p>The <?php echo config::name(); ?> is an open source object-oriented HMVC framework written in PHP. The core of the project was mostly developed in 3 days by Jeff Hays as a way of learning namespaces and routing from scratch. It's light weight, easy-to-use, and was programmed specifically to make it easy to use for developers. This is accomplished by autoloading classes and providing as many sensible aliases and syntax options as possible.</p>
					</div><a name="usage"></a>

					<h3 class="subheader">Model, View, and Controller</h3>
					<p>The routing is dispatched to load the appropriate controller, model, and the files in the view: <em>header.php</em>, <em>nav.php</em>, <em>index.php</em>, and <em>footer.php</em>. These template partials are of course loaded from the views folder that matches the action name (or the one you routed to a non-default location). Since <?php echo config::name(); ?> is Hierarchical, it will also grab each of those same files from the parent folder if any of them are missing from that view folder</p>
					<p>Additionally <?php echo config::name(); ?> will load a single file if the filename matches the action name and is in the top level of your view folder. This will load only that file without the <em>header.php</em>, <em>nav.php</em>, and <em>footer.php</em> files. This makes it easy to create a quick landing page that has all the front end content in one spot from top to bottom.</p>
					<p>This site is a live implementation of <?php echo config::name(); ?> and for those with access to the git repository, this is an exact copy of what you get when downloading the repo.</p>

					<h3 class="subheader"><a name="routing" alt="<?php echo config::title(); ?> Routing" title="<?php echo config::title(); ?> Routing">Routing</a></h3>
					<div class="panel">
						<p>The routing was done so you don't have to be a regex nerd to complete the task at hand. It's setup with an associative array where the key of the array is the inbound URL and a value of the directory within packages/app that you want the view to load from (model, view and controller).</p>
						<p class="text-center">
							<code>array('/url/action' => 'app/path');</code>
							<br>i.e.<br>
							<code>array('/admin' => 'areas/admin');</code>
						</p>
						<h4>route::add(<em>array('/admin' => 'areas/admin')</em>);</h4>
						<p>This function allows you to add routes on the fly. This of course needs to be done before the model, view, and controller, but for those of you that develop your own classes this can come in handy if you want to alter the routes.</p>

						<h4>route::show();</h4>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>route::show();</code></p>
							<p><em>Output:</em></p>
							<p><div class="centered"><?php route::show(); ?></div></p>
						</blockquote>
					</div>

					<h3 class="subheader"><a name="templating" alt="<?php echo config::title(); ?> Templating" title="<?php echo config::title(); ?> Routing">Templating</a></h3>
					<div class="panel">
						<h4>view::set(<em>'foo', 'bar'</em>);</h4>
						<blockquote>
							<p><em>Result:</em></p>
							<p>Sets a variable $foo with the value 'bar' that is available to all template partials in the view.</p>
						</blockquote>

						<h4>html::css(<em>'style.css' <span>[, $echo=true]</span></em>);</h4>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>html::css('style.css');</code></p>
							<p><em>Output:</em></p>
							<p><pre class="text-center"><?php echo htmlspecialchars('<link rel="stylesheet" href="/css/style.css">'); ?></pre></p>
						</blockquote>

						<h4>html::js(<em>'style.js' <span>[, $echo=true]</span></em>);</h4>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>html::js('ez.js');</code></p>
							<p><em>Output:</em></p>
							<p><pre class="text-center"><?php echo htmlspecialchars('<script src="/js/ez.js"></script>'); ?></pre></p>
						</blockquote>

						<h4>html::breadcrumbs();</h4><a name="crumbs"></a>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>html::breadcrumbs();</code></p>
							<p><em>Output:</em></p>
							<p><?php html::breadcrumbs(); ?></p>
							<a href="/crumbs/example/url#crumbs" class="small radius button">Click Here</a>
							<p>... to go to a URL that will offer breadcrumbs (they don't show up on the home page since there's nothing at the end of your URL. The link above was made by creating a few routes:
								<p class="text-center"><code>'/crumbs/example/url' => '',<br>'/crumbs/example' => '',<br>'/crumbs' => ''</code></p>
								These route each of the parts of URL to the index page while showing you the appropriate order to put your routes in. Putting the child-most directories first is required for since the routing will find the first match in the list.</p>
						</blockquote>
					</div>
					
					<h3 class="subheader">The content below is dummy content...</h3>
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
			<div class="panel">
				<h5 class="subheader">Current <?php echo config::name(); ?> Version: </h5><a class="small orange centered radius button" href="#" alt="Download <?php echo config::name() . ' ' . config::version(); ?>" title="Download <?php echo config::name() . ' ' . config::version(); ?>"><?php echo config::version(); ?></a>
			</div>
			<h4><i class="icon-truck medium-icon"></i> What's under the hood...</h4>
			<p>The <?php echo config::name(); ?> project is a custom object-oriented PHP framework using namespaces. The front end is powered by Foundation CSS, Font Awesome, jQuery, and all sits on a RESTful URL structure.</p>
			<p><?php echo config::name(); ?> comes with its own database class that's done in a chained method query builder fashion similar to Kohana 3. The routing is custom and makes it easy to route inbound paths to a base directory to load a different set of models, views, and controllers via a simple array key/value pair.</p>
			<div class="panel">
				<h3 class="subheader">Updates:</h3>
				<ul>
					<li>Implemented user class to handle sessions and allow central location for user data</li>
					<li>Added <code>autoload::libs()</code> function to automatically load libraries from the folder you pass it</li>
					<li>Added <code>html::breadcrumbs()</code> function that will echo out Foundation breadcrumbs based on the current URL</li>
					<li>Added <code>route::url()</code> function to handle all controller/model/view paths in the route class</li>
					<li>Recently implemented an admin login page and started the auth class that will handle sessions and user data</li>
				</ul>
			</div>

			<h4><i class="icon-rocket medium-icon"></i> Try <?php echo config::name(); ?></h4>
			<p>Let <?php echo config::name(); ?> start managing your client requests today by signing up for a Free Trial. It's super easy to sign up! Just click the button below to start your free trial.</p>
					
			<div class="panel">
				<h3 class="subheader">To Do:</h3>
				<ul>
					<li>Move dBug class from libs to core</li>
				</ul>
			</div>
			
		</div>
	</div>
