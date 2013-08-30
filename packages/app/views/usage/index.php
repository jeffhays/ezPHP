
	<div class="row usage">
		<div class="large-3 columns tableofcontents">
			<a name="info"></a>
			<h3>Function Reference</h3>
			<div class="row">
				<ol class="large-8 columns">
					<li><a href="#routing">Routing</a></li>
					<li><a href="#templating">Templating</a></li>
					<li><a href="#user">user class</a></li>
					<li><a href="#ez">ez class</a></li>
					<li><a href="#autoload">autoload class</a></li>
				</ol>
			</div>
		</div>
		<div class="large-9 columns">
			<h3><?php echo config::name(); ?> Usage</h3>
			<div class="row">
				<div class="large-12 columns">
					<p>Below is a working list of available usage. Check back here for updates on usage and how the framework works from the current git repo. When added functionality has gotten past the initial bugs and is fairly usable, I'll be sure to update this page with some more usage.
					<h3 class="subheader"><a name="constants" alt="<?php echo config::title(); ?> Global Constants" title="<?php echo config::title(); ?> Global Constants">Global Constants</a></h3>
					<div class="panel">
						<table>
							<thead>
								<tr>
									<td>Constant</td>
									<td>Value</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><strong>DS</strong></td>
									<td>DIRECTORY_SEPARATOR <em>- this would be "/" in most cases if you're smart enough to be using linux</em></td>
								</tr>
								<tr>
									<td><strong>EXT</strong></td>
									<td>.php <em>- I might let you config this later but I think for now let's assume you're using .php files :)</td>
								</tr>
								<tr>
									<td><strong>BASE</strong></td>
									<td>The base path of your <?php echo config::name(); ?> install</td>
								</tr>
								<tr>
									<td><strong>CONFIG</strong></td>
									<td>Path to <strong>config</strong> directory within the <strong>base path</strong> of your <?php echo config::name(); ?> install</td>
								</tr>
								<tr>
									<td><strong>PKG</strong></td>
									<td>Path to <strong>packages</strong> directory within the <strong>base path</strong> of your <?php echo config::name(); ?> install</td>
								</tr>
								<tr>
									<td><strong>TMP</strong></td>
									<td>Path to <strong>tmp</strong> directory within the <strong>base path</strong> of your <?php echo config::name(); ?> install</td>
								</tr>
								<tr>
									<td><strong>LIB</strong></td>
									<td>Path to <strong>lib</strong> directory within the <strong>packages directory</strong> of your <?php echo config::name(); ?> install</td>
								</tr>
								<tr>
									<td><strong>APP</strong></td>
									<td>Path to <strong>app</strong> directory within the <strong>packages directory</strong> of your <?php echo config::name(); ?> install</td>
								</tr>
								<tr>
									<td><strong>CORE</strong></td>
									<td>Path to <strong>ez</strong> directory within the <strong>packages directory</strong> of your <?php echo config::name(); ?> install</td>
								</tr>
								<tr>
									<td><strong>SESS</strong></td>
									<td>Path to <strong>sessions</strong> directory within the <strong>tmp directory</strong> of your <?php echo config::name(); ?> install</td>
								</tr>
								<tr>
									<td><strong>LOG</strong></td>
									<td>Path to <strong>logs</strong> directory within the <strong>tmp directory</strong> of your <?php echo config::name(); ?> install</td>
								</tr>
							</tbody>
						</table>
						<p>These can be pretty handy when you're including files. With the <a href="#autoload">autoload class</a> you can quickly and dynamically load files based on these paths. Here's some examples with and without using autoload.</p>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>require_once(PKG . 'mypackage' . DS . 'myclass' . EXT);</code></p>
							<p class="text-center"><code>autoload::add_class('ez\app\myclass', PKG . 'mypackage' . DS . 'myclass' . EXT);</code></p>
						</blockquote>
					</div>
					<h3 class="subheader"><a name="routing" alt="<?php echo config::title(); ?> Routing" title="<?php echo config::title(); ?> Routing">Routing</a></h3>
					<div class="panel">
						<p>The routing was done so you don't have to be a regex nerd to complete the task at hand. It's setup with an associative array where the key of the array is the inbound URL and the value is the directory within the packages/app folder that you want the view to load from.</p>
						<p class="text-center">
							<code>array('/url/action' => 'app/path');</code>
							<br>i.e.<br>
							<code>array('/admin' => 'areas/admin');</code>
						</p>
						<hr>
						<h4>route::add(<em>array('/admin' => 'areas/admin')</em>);</h4>
						<p>This function allows you to add routes on the fly. This of course needs to be done before the model, view, and controller, but for those of you that develop your own classes this can come in handy if you want to alter the routes.</p>

						<hr>
						<h4>route::show();</h4><a name="routeurl"></a>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>route::show();</code></p>
							<p><em>Output:</em></p>
							<p><div class="centered"><?php route::show(); ?></div></p>
						</blockquote>
						<h4>route::url();</h4>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>route::url();</code></p>
							<p><em>Result:</em></p>
							<p><div>This function is used in <code>view::render()</code> and is the main function that handles the routing. After this function runs, the files used for Controller, Model, and View are loaded for the view to use.</div></p>
						</blockquote>
					</div>

					<h3 class="subheader"><a name="templating" alt="<?php echo config::title(); ?> Templating" title="<?php echo config::title(); ?> Routing">Templating</a></h3>
					<div class="panel">
						<h4>view::set(<em>'foo', 'bar'</em>);</h4>
						<blockquote>
							<p><em>Result:</em></p>
							<p>Sets a variable $foo with the value 'bar' that is available to all template partials in the view.</p>
						</blockquote>
						<hr>
						<h4>html::css(<em>'style.css' <span>[, $echo=true]</span></em>);</h4>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>html::css('style.css');</code></p>
							<p><em>Output:</em></p>
							<p><pre class="text-center"><?php echo htmlspecialchars('<link rel="stylesheet" href="/css/style.css">'); ?></pre></p>
						</blockquote>
						<hr>
						<h4>html::js(<em>'style.js' <span>[, $echo=true]</span></em>);</h4><a name="favicon"></a>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>html::js('ez.js');</code></p>
							<p><em>Output:</em></p>
							<p><pre class="text-center"><?php echo htmlspecialchars('<script src="/js/ez.js"></script>'); ?></pre></p>
						</blockquote>
						<hr>
						<h4>html::favicon(<em>'favicon.png' <span>[, $echo=true]</span></em>);</h4><a name="crumbs"></a>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>html::favicon('favicon.ico');</code></p>
							<p><em>Output:</em></p>
							<p><pre class="text-center"><?php echo htmlspecialchars('<link rel="icon" href="/img/favicon.ico" type="image/x-icon">'); ?></pre></p>
						</blockquote>
						<hr>
						<h4>html::breadcrumbs();</h4>
						<blockquote>
							<p><em>Example:</em></p>
							<p class="text-center"><code>html::breadcrumbs();</code></p>
							<p><em>Output:</em></p>
							<p><?php html::breadcrumbs(); ?></p>
							<p>This output is based on the current URL. After I've pimped out the routing some more I'll check back here and add an additional route to this page so these crumbs have more than 1 dimension to them. You can <a href="/admin/login">click here</a> to see a preview of how they look on a more nested URL.</p>
						</blockquote>
					</div>
				</div>
			</div>
			
			<h3 class="subheader"><a name="user" alt="<?php echo config::title(); ?> User Class" title="<?php echo config::title(); ?> User Class">User Class</a></h3>
			<div class="panel">
				<h4>user::require_login(<em><span>'/redirect/url'</span></em>);</h4>
				<blockquote>
					<p><em>Examples:</em></p>
					<p class="text-center"><code>user::require_login();</code></p>
					<p class="text-center"><code>user::require_login('/admin/index');</code></p>
					<p><em>Result:</em></p>
					<p>Checks to see if the user is logged in (requires a success user::login() call). If the user is not logged in, and the current URL is not the redirect URL, it will forward the user to the redirect URL passed. When there is no redirect URL passed, it will pull the value from config::$login_url in /config/config.php and redirect you to that URL.</p>
				</blockquote>
				<hr>
				<h4>user::login(<em>$values</em>);</h4>
				<blockquote>
					<p><em>Example:</em></p>
					<p class="text-center"><code>user::login(array('ID' => 2, 'username' => 'jeff'));</code></p>
					<p><em>Result:</em></p>
					<p>If the <em>$values</em> parameter is an array or object that has values, the User Class will automatically set $_SESSION variables for you based on the values you pass it. This allows you to do your own checking to see if the user successfully logged in. The intention of coding it like this was so that you can use this directly with the db class.</p>
					<p><em>Example with db class:</em></p>
					<p><code>
						if(is_array($_POST) && isset($_POST['username']) && isset($_POST['password'])){<br>
						<blockquote>
							$user = db::i()->select()->from('ez_users')<br>
							<p class="display:block;margin-left:8.45em;">
								->where('username', '=', $_POST['username'])<br>
								->andwhere('password', '=', md5($_POST['password']))->row();<br>
							</p>
							$user = user::login($user);<br>
							if($user) header('Location: /admin/index');<br>
						</blockquote>
						}
					</code></p>
				</blockquote>
				<hr>
				<h4>user::logout(<em><span>'/redirect/url'</span></em>);</h4>
				<blockquote>
					<p><em>Example:</em></p>
					<p class="text-center"><code>user::login();</code></p>
					<p><em>Result:</em></p>
					<p>Logs the current user out and unsets all $_SESSION variables. If the redirect URL is passed, it will forward the user to the redirect URL passed after the user is logged out.</p>
				</blockquote>
				<hr>
				<h4>user::loggedin();</h4>
				<blockquote>
					<p><em>Example:</em></p>
					<p class="text-center"><code>user::loggedin();</code></p>
					<p><em>Result:</em></p>
					<p>Returns a boolean based on whether or not the user is logged in.</p>
				</blockquote>
				<hr>
				<h4>user::values();</h4>
				<blockquote>
					<p><em>Example:</em></p>
					<p class="text-center"><code>user::values();</code></p>
					<p><em>Result:</em></p>
					<p>Returns the array or object of the user data that was originally passed in the <code>user::login()</code> function. You can use this with <code>ez::dbug(user::values());</code> to print out a nice dbug window of the values like so:</p>
					<p>
						<table cellspacing="2" cellpadding="3" class="dBug_object">
							<tbody>
								<tr><td class="dBug_objectHeader" colspan="2" onclick="dBug_toggleTable(this)" title="click to collapse" style="font-style: normal;"> (object)</td></tr>
								<tr><td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">ID</td><td>0</td></tr>
								<tr><td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">username</td><td>admin</td></tr>
								<tr><td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">level</td><td>10</td></tr>
								<tr><td valign="top" onclick="dBug_toggleRow(this)" class="dBug_objectKey">createdon</td><td>2013-08-16 22:01:22</td></tr>
							</tbody>
						</table>
					</p>
				</blockquote>
				<hr>
				<h4>user::val(<em>'key'</em>);</h4>
				<blockquote>
					<p><em>Example:</em></p>
					<p class="text-center"><code>user::val('username');</code></p>
					<p><em>Result:</em></p>
					<p>Returns the 'username' value of the user array. Remember, the user values are set from the values you pass to the User Class when you call <code>user::login($values);</code></p>
				</blockquote>
			</div>
			<h3 class="subheader"><a name="ez" alt="<?php echo config::title(); ?> ez Class" title="<?php echo config::title(); ?> ez Class">ez Class</a></h3>
			<div class="panel">
				<h4>ez::dbug(<em>$mixed</em>);</h4>
				<blockquote>
					<p><em>Info:</em></p>
					<p>This is by far one of my favorite parts of <?php echo config::name(); ?> is the integration of one of my old favorite debugger classes "dBug" by Kwaku Otchere. It's a simple one-file solution to spit out the contents of all types of data to avoid having to echo pre tags and such. It also has old school JS to collapse and toggle different parts of the output. I plan to eventually write my own but this one is an old past time of mine.</p>
					<p><em>Example:</em></p>
					<p class="text-center"><code>ez::dbug(array('user' => array('ID' => 2, 'name' => 'billy'), 'ip' => '<?php echo $_SERVER['REMOTE_ADDR']; ?>'));</code></p>
					<p><em>Output:</em></p>
					<p><?php ez::dbug(array('user' => array('ID' => 2, 'name' => 'billy'), 'ip' => $_SERVER['REMOTE_ADDR'])); ?></p>
				</blockquote>
				<hr>
				<h4>ez::timer();</h4>
				<blockquote>
					<p><em>Info:</em></p>
					<p>Want to time your scripts or functions? This function allows you to toggle a microtime timer just like a stop watch to pull back how many seconds it took for an operation to complete.</p>
					<p><em>Example:</em></p>
					<p class="text-center"><code>ez::timer();</code></p>
					<p class="text-center"><code>usleep(100);</code></p>
					<p class="text-center"><code>ez::timer();</code></p>
					<p><em>Output:</em></p>
					<p><?php ez::timer(); usleep(100); ez::timer(); ?></p>
				</blockquote>

			</div>
			<h3 class="subheader"><a name="autoload" alt="<?php echo config::title(); ?> autoload Class" title="<?php echo config::title(); ?> autoload Class">autoload Class</a></h3>
			<div class="panel">
				<h4>autoload::libs(<em>'path/to/libs/directory'</em>);</h4>
				<blockquote>
					<p><em>Info:</em></p>
					<p>This function will automatically load PHP files from the directory passed to it. I use this same method in the public/index.php file so our lib directory is loaded by using <code>autoload::libs(LIB);</code></p>
					<p><em>Example:</em></p>
					<p class="text-center"><code>autoload::libs(PKG . 'my_addon');</code></p>
					<p><em>Result:</em></p>
					<p>Loads all .php files from packages/my_addon. You'll need to review the list of constants when including files to make your function calls easy.</p>
				</blockquote>
				<hr>				
				<h4>autoload::add_classes(<em>array('namespace\classname' => 'path/to/file.php')</em>);</h4>
				<blockquote>
					<p><em>Info:</em></p>
					<p>Adds classes to automatically load by passing a keyed array of classes and file paths. This only loads classes in an array which can then be loaded using the <code>autoload::register();</code> function.</p>
					<p><em>Example:</em></p>
					<p class="text-center"><code>autoload::add_classes(array(<br>'ez\myconf' => CONFIG . 'myconfig.php',<br>'ez\core\addon' => PKG . 'addon' . DS . 'main.php'<br>));</code></p>
					<p><em>Result:</em></p>
					<p>Loads two PHP classes:
						<ol class="push-1">
							<li>loads class "myconf" into namespace "ez" from file "config/myconfig.php".</li>
							<li>loads class "addon" into namespace "ez\core" from file "packages/addon/main.php".</li>
						</ol>
					</p>
				</blockquote>
				<hr>				
				<h4>autoload::add_class(<em>'namespace\classname', 'path/to/file.php'</em>);</h4>
				<blockquote>
					<p><em>Info:</em></p>
					<p>Adds a class to automatically load into a namespace. This only loads a class in an array which can then be loaded using the <code>autoload::register();</code> function.</p>
					<p><em>Example:</em></p>
					<p class="text-center"><code>autoload::add_class('ez\core\cookies', PKG . 'myaddon' . DS . 'cookies.php');</code></p>
					<p><em>Result:</em></p>
					<p>
						<ol class="push-1">
							<li>loads class "cookies" into namespace "ez\core" from file "packges/myaddon/cookies.php".</li>
						</ol>
						<p class="push-1">(This would be a good example to extend the ez core for your own cookie handler)</p>
					</p>
				</blockquote>
			</div>			
		</div>
	</div>