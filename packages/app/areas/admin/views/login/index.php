	
	<div class="content row">
		<?php html::breadcrumbs(); ?>
		<form method="post" action="">
		  <div class="large-8 small-centered columns">
		    <h3>Login</h3>
		    
		    <fieldset>
		      <div class="row collapse">            
		        <div class="small-2 large-1 columns">
		          <span class="prefix"><i class="fa fa-user"></i></span>
		        </div>
		        <div class="small-10 large-11 columns">
		          <input type="text" name="username" id="user" placeholder="username">
		        </div>
		      </div>
		      <div class="row collapse">
		        <div class="small-2 large-1 columns">
		          <span class="prefix"><i class="fa fa-asterisk"></i></span>
		        </div>
		        <div class="small-10 large-11 columns">
		          <input type="password" name="password" id="password" placeholder="password">
		        </div>
		      </div>
		      <button type="submit" class="small button" name="login"><i class="fa fa-sign-in"></i> Login</button>
		    </fieldset>
		
		    <?php if(isset($error) && strlen($error)){ ?>
		      <div class="row">
		        <div class="large-12 columns">
		          <div data-alert class="alert-box alert">
		            <?php echo $error; ?>
		            <a href="#" class="close">&times;</a>
		          </div>
		        </div>
		      </div>
		    <?php } ?>
		
		  </div>
		  <div class="row">
		    <div class="large-8 small-centered columns">
		      <!-- <img src="/images/PM2013_masthead.jpg"> -->
		    </div>
		  </div>
		</form>
	</div>