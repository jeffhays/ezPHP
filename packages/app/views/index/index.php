
	<div class="row content">
		<div class="large-8 columns">
			<h3>What is <?php echo config::name(); ?>?</h3>
			<div class="row">
				<div class="large-12 columns">
					<div class="panel callout" id="start1">
						<p>The <?php echo config::name(); ?> is an open source object-oriented PHP framework written with a typical HMVC (no ORM in the model yet, so this is specifically talking about conveniently auto-loaded views, controllers, and models). The core of the project was started in 3 long nights by Jeff Hays out of a frustration with most light-weight oop PHP frameworks not having insanely simple routing and syntax.</p>
					</div>

					<h3 class="subheader">Model, View, and Controller</h3>
					<p>The routing is dispatched to load the appropriate controller, model, and the files in the view: <em>header.php</em>, <em>nav.php</em>, <em>index.php</em>, and <em>footer.php</em>. These template partials are loaded from the views folder that matches the action name (or the one you routed to a non-default location). Since <?php echo config::name(); ?> is Hierarchical, anything <?php echo config::name(); ?> it will also grab each of those same files from the parent folder if any of them are missing from that view folder</p>
					<p>Additionally <?php echo config::name(); ?> will load a single file if the filename matches the action name and is in the top level of your view folder. This will load only that file without the <em>header.php</em>, <em>nav.php</em>, and <em>footer.php</em> files. This makes it easy to create a quick landing page that has all the front end content in one spot from top to bottom.</p>
					<p>This site is a live implementation of <?php echo config::name(); ?> and for those with access to the git repository, this is an exact copy of what you get when downloading the repo.</p>
				</div>
			</div>
			
			<div class="panel">
				<h3 class="subheader">Recent Updates:</h3>
				<ul>
					<li>Updated db class to finish support for other engines besides MySQL <small>(removed back ticks)</small></li>
					<li>Added <a href="/usage/#ez"><code>ez::timer();</code></a> function to easily time your script's or function's execution time.
					<li>Added a site_description setting to config, and <code>config::description();</code> for use in the meta tags.</li>
					<li>w00t! Finally finished the pieces of the routing that were missing, including but not limited to: infinite parameters can now be passed in the controller function that is called, fail overs have been added to fix all the issues between routed URLs and non-routed URLs, and general pimpification of routing functions. I also added a <a href="/admin/users/edit/10">users view in the admin</a> to provide an example of how URL variables are passed.</li>
					<li>Added <a href="/usage/#favicon"><code>html::favicon()</code></a> function that outputs a HTML5 favicon link tag.</li>
					<li>Implemented <a href="/usage/#user" alt="<?php echo config::name(); ?> User Class" title="<?php echo config::name(); ?> User Class">User Class</a> to handle sessions and allow central location for user data. You can pass the user class an array or object of data and it will automatically be handled through the session handler.</li>
					<li>Added <a href="/usage/#autoload"><code>autoload::libs()</code></a> function to automatically load libraries from the folder you pass it</li>
					<li>Recently implemented an admin login page and started the auth class that will handles sessions.</li>
					<li>Added <a href="/usage/#crumbs"><code>html::breadcrumbs()</code></a> function that outputs Foundation breadcrumbs based on the current URL.</li>
					<li>Put in an adorable <a href="/pricing">example pricing page</a> that showcases using 1 single view file as opposed to a folder.</li>
					<li>Added <a href="/usage/#routeurl"><code>route::url()</code></a> function to handle all controller/model/view paths in the route class.</li>
				</ul>
			</div>

		</div>

		<div class="large-4 columns">
			<h3>&nbsp;</h3>
			<div class="panel">
				<h5 class="subheader">Current <?php echo config::name(); ?> Version: </h5><a class="small orange centered radius button" href="https://github.com/jphase/ezPHP/archive/master.zip" alt="Download <?php echo config::name() . ' ' . config::version(); ?>" title="Download <?php echo config::name() . ' ' . config::version(); ?>"><i class="icon-code-fork icon-flip-horizontal left"></i> <?php echo config::version(); ?> <i class="icon-code-fork right"></i></a>
				<p><small><div class="error text-center">(OMG!!! ezPHP just went open source!)</div></small></p>
				<p>ezPHP has been recently made into a public repository on github.com so you can download, browse, and use the code at your liesure. Please keep in mind that this project is still in its infancy and the bulk of the code needs your help and critique to make it better! I'm always looking for more developers to help contribute to any of my open source projects, so if you like what you see then PLEASE PLEASE contribute!<p class="text-center"><a href="https://github.com/jphase/ezPHP/" alt="Fork jphase on github!" title="Fork jphase on github!" target="_blank"><i class="icon-github icon-large"></i> fork me on github! <i class="icon-github icon-large"></i></a></p></p>
				<p class="text-center"><em>Read below to contact the developer...</em> <i class="icon-level-down icon-small"></i></p>
			</div>
			<h4><i class="icon-truck medium-icon"></i> What's under the hood...</h4>
			<p>The <?php echo config::name(); ?> project is a custom object-oriented PHP framework using namespaces. The front end is powered by Foundation CSS, Font Awesome, jQuery, and all sits on a RESTful URL structure.</p>
			<p><?php echo config::name(); ?> comes with its own database class that's done in a chained method query builder fashion similar to Kohana 3. The routing is custom and makes it easy to route inbound paths to a base directory to load a different set of models, views, and controllers via a simple array key/value pair.</p>

			<div class="panel">
				<h3 class="subheader">To Do:</h3>
				<ul>
					<li>Move dBug class from libs to core</li>
					<li>Add usage documentation for db class</li>
				</ul>
			</div>
			
			<h4><i class="icon-envelope medium-icon"></i> Try <?php echo config::name(); ?></h4>
			<p>Wanna start using <?php echo config::name(); ?>? If you would like to be a part of the ezPHP development team, then <p class="text-center"><a href="https://github.com/jphase/ezPHP/" alt="Fork jphase on github!" title="Fork jphase on github!"><i class="icon-github icon-large"></i> fork me on github! <i class="icon-github icon-large"></i></a></p></p>
			<p>This site is a working copy of what comes with the git repo and will be exactly what you get if you want to look at it and decide if you like it enough to contribute as a developer.</p>
			
		</div>
	</div>
