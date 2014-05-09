	<div class="sticky">
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<!-- Title Area -->
				<li class="name">
					<h1><a href="/" alt="<?php echo config::name(); ?>" title="<?php echo config::name(); ?>"><span>ez</span>PHP Framework</a></h1>
				</li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			</ul>
		
			<section class="top-bar-section">
				<!-- Left Nav Section -->
				<ul class="left">
					<li class="divider"></li>
					<li class="has-dropdown"><a href="/usage/#"><i class="fa fa-code"></i> Usage</a>
						<ul class="dropdown">
							<li class="divider hide-for-large"></li>
							<li><a href="/usage/#info"><i class="fa fa-info-circle"></i> Info</a></li>
							<li class="divider hide-for-large"></li>
							<li><a href="/usage/#routing"><i class="fa fa-sort-amount-asc"></i> Routing</a></li>
							<li class="divider hide-for-large"></li>
							<li><a href="/usage/#templating"><i class="fa fa-html5"></i> Templating</a></li>
							<li class="divider hide-for-large"></li>
							<li><a href="/usage/#user"><i class="fa fa-archive"></i> user class</a></li>
							<li class="divider hide-for-large"></li>
							<li><a href="/usage/#ez"><i class="fa fa-archive"></i> ez class</a></li>
							<li class="divider hide-for-large"></li>
							<li><a href="/usage/#autoload"><i class="fa fa-archive"></i> autoload class</a></li>
							<li class="divider hide-for-large"></li>
						</ul>
					</li>
					<li class="divider"></li>
					<li class="has-dropdown"><a href="/install/#"><i class="fa fa-download-alt"></i> Install</a>
						<ul class="dropdown">
							<li class="divider hide-for-large"></li>
							<li><a href="/install/#git"><i class="fa fa-github-alt"></i> Setup git</a></li>
							<li class="divider hide-for-large"></li>
							<li><a href="/install/#config"><i class="fa fa-gears"></i> Setup config</a></li>
							<li class="divider hide-for-large"></li>
							<li><a href="/install/#permissions"><i class="fa fa-group"></i> Setup permissions</a></li>
							<li class="divider hide-for-large"></li>
							<li><a href="/install/#ignore"><i class="fa fa-eye-slash"></i> Ignore app directory</a></li>
							<li class="divider hide-for-large"></li>
							<li><a href="/install/#update"><i class="fa fa-archive"></i> Update repo</a></li>
							<li class="divider hide-for-large"></li>
						</ul>
					</li>
					<li class="divider<?php if(!user::loggedin()){ ?> hide-for-small<?php } ?>"></li>
	<?php if(user::loggedin()){ ?>
					<li class="has-dropdown"><a href="#">Main Item 3</a>
					
					  <ul class="dropdown">
							<li class="has-dropdown"><a href="#">Dropdown Level 1a</a>
								<ul class="dropdown">
									<li><label>Dropdown Level 2 Label</label></li>
									<li><a href="#">Dropdown Level 2a</a></li>
									<li><a href="#">Dropdown Level 2b</a></li>
									<li class="has-dropdown"><a href="#">Dropdown Level 2c</a>									
										<ul class="dropdown">
											<li><label>Dropdown Level 3 Label</label></li>
											<li><a href="#">Dropdown Level 3a</a></li>
											<li><a href="#">Dropdown Level 3b</a></li>
											<li class="divider"></li>
											<li><a href="#">Dropdown Level 3c</a></li>
										</ul>
									</li>
									<li><a href="#">Dropdown Level 2d</a></li>
									<li><a href="#">Dropdown Level 2e</a></li>
									<li><a href="#">Dropdown Level 2f</a></li>
								</ul>
							</li>
							<li><a href="#">Dropdown Level 1b</a></li>
							<li><a href="#">Dropdown Level 1c</a></li>
							<li class="divider"></li>
							<li><a href="#">Dropdown Level 1d</a></li>
							<li><a href="#">Dropdown Level 1e</a></li>
							<li><a href="#">Dropdown Level 1f</a></li>
							<li class="divider"></li>
							<li><a href="#">See all &rarr;</a></li>
					  </ul>
					</li>
					<li class="divider"></li>
	<?php } ?>
				</ul>
				
				<!-- Right Nav Section -->
				<ul class="right">
				<?php if(user::loggedin()){ ?>
					<li class="divider hide-for-small"></li>
					<li><a href="/admin"><i class="fa fa-cog fa-spin"></i> Admin</a></li>
				<?php } ?>
					<li class="divider"></li>
					<li>
					<?php if(user::loggedin()){ ?>
						<a href="/admin/logout"><i class="fa fa-sign-out"></i> Logout</a>
					<?php } else { ?>
						<a href="/admin/login"><i class="fa fa-sign-in"></i> Login</a>
					<?php } ?>
					</li>
				</ul>
			</section>
		</nav>
	</div>
