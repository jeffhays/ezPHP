	<div class="sticky">
		<nav class="top-bar">
			<ul class="title-area">
				<!-- Title Area -->
				<li class="name">
					<h1><a href="/"><?php echo config::name(); ?></a></h1>
				</li>
				<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
				<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
			</ul>
		
			<section class="top-bar-section">
				<!-- Left Nav Section -->
				<ul class="left">
					<li class="divider"></li>
					<li class="active"><a href="/"><i class="icon-info-sign"></i> About</a></li>
					<li class="divider"></li>
					<li><a href="/#routing"><i class="icon-sort-by-attributes-alt"></i> Routing</a></li>
					<li class="divider"></li>
					<li class="has-dropdown"><a href="/#usage"><i class="icon-code"></i> Usage</a>
						<ul class="dropdown">
							<li class="divider"></li>
							<li><a href="/#routing"><i class="icon-sort-by-attributes-alt"></i> Routing</a></li>
							<li class="divider"></li>
							<li><a href="/#templating"><i class="icon-html5"></i> Templating</a></li>
							<li class="divider"></li>
						</ul>
					</li>
					<li class="divider"></li>
<?php if(isset($_SESSION['loggedin'])) { ?>
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
					<li class="divider hide-for-small"></li>
					<li><a href="/#pricing"><i class="icon-money"></i> Pricing</a></li>
					<li class="divider hide-for-small"></li>
<!--
					<li>Requests</li>
					<li class="divider"></li>
-->
					<li class="has-form">
						<?php if(isset($_SESSION['loggedin'])) { ?>
							<div style="float:left;color:#fff;margin:.6em 1em .6em 0;">Welcome <?php echo $_SESSION['username']; ?>!</div>
							<form style="float:right" action="/logout" method="post">
								<button class="small orange radius button" type="submit"><i class="icon-eject"></i> Logout</button>
							</form>
						<?php } else { ?>
<a class="small radius button" href="/admin/login"><i class="icon-key"></i> Login</a>
						<?php } ?>
					</li>
				</ul>
			</section>
		</nav>
	</div>
