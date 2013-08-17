<form method="post" action="">
  <div class="large-8 small-centered columns">
    <h3>Login</h3>
    
    <fieldset>
      <div class="row collapse">            
        <div class="small-2 large-1 columns">
          <span class="prefix"><i class="icon-user"></i></span>
        </div>
        <div class="small-10 large-11 columns">
          <input type="text" name="user" id="user" placeholder="username">
        </div>
      </div>
      <div class="row collapse">
        <div class="small-2 large-1 columns">
          <span class="prefix"><i class="icon-key"></i></span>
        </div>
        <div class="small-10 large-11 columns">
          <input type="password" name="password" id="password" placeholder="password">
        </div>
      </div>
      <input type="submit" class="small button radius" name="login" id="login" value="Login">
    </fieldset>

    <?php if(isset($error) && strlen($error)){ ?>
      <div class="row">
        <div class="large-12 columns">
          <div data-alert class="alert-box alert radius">
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