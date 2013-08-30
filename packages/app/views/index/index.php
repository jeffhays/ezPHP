
	<div class="row content">
		<div class="large-8 columns">
			<h3>What is <?php echo config::name(); ?>?</h3>
			<div class="row">
				<div class="large-12 columns">
					<div class="panel callout" id="start1">
						<p>The <?php echo config::name(); ?> is an open source object-oriented HMVC framework written in PHP. The core of the project was recently started on August 16<sup>th</sup>, 2013 by Jeff Hays as an excuse for learning namespaces and routing from scratch. It's light weight, easy-to-use, and was programmed specifically to make it easy to use for developers. This is accomplished by autoloading classes and providing as many sensible aliases and syntax options as possible.</p>
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
				<h5 class="subheader">Current <?php echo config::name(); ?> Version: </h5><a class="small orange centered radius button" href="<?php if(user::loggedin()) echo 'http://code.offthewallmedia.com/jeff/hmvc/repository/archive'; ?>" alt="Download <?php echo config::name() . ' ' . config::version(); ?>" title="Download <?php echo config::name() . ' ' . config::version(); ?>"><i class="icon-code-fork icon-flip-horizontal left"></i> <?php echo config::version(); ?> <i class="icon-code-fork right"></i></a>
				<?php if(!user::loggedin()){ ?>
				<p><small><div class="error text-center">(Sorry... you must be logged in to download the source)</div></small></p>
				<p class="text-center"><em>Read below to contact the developer...</em> <i class="icon-level-down icon-small"></i></p>
				<?php } ?>
			</div>
			<h4><i class="icon-truck medium-icon"></i> What's under the hood...</h4>
			<p>The <?php echo config::name(); ?> project is a custom object-oriented PHP framework using namespaces. The front end is powered by Foundation CSS, Font Awesome, jQuery, and all sits on a RESTful URL structure.</p>
			<p><?php echo config::name(); ?> comes with its own database class that's done in a chained method query builder fashion similar to Kohana 3. The routing is custom and makes it easy to route inbound paths to a base directory to load a different set of models, views, and controllers via a simple array key/value pair.</p>

			<div class="panel">
				<h3 class="subheader">To Do:</h3>
				<ul>
					<li>Move dBug class from libs to core</li>
					<li>Update db class to finish support for other engines besides MySQL <small>(remove back ticks)</small></li>
				</ul>
			</div>
			
			<h4><i class="icon-envelope medium-icon"></i> Try <?php echo config::name(); ?></h4>
			<p>Wanna start using <?php echo config::name(); ?>? It is currently on limited distribution since it is in its infancy. If you would like to be a part of the ezPHP development team, send an email to jeff at offthewallmedia dot com and I'll send you teh codez! o_O</p>
			<p>This site is a working copy of what comes with the git repo and will be exactly what you get if you want to look at it and decide if you like it enough to contribute as a developer.</p>
			
		</div>
	</div>
