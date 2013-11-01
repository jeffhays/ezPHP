
	<div class="row usage">
		<div class="large-3 columns tableofcontents">
			<a name="info"></a>
			<h3>Function Reference</h3>
			<div class="row">
				<ol class="large-8 columns">
					<li><a href="#git">Setup git</a></li>
					<li><a href="#config">Setup config file</a></li>
					<li><a href="#permissions">Setup permissions</a></li>
					<li><a href="#ignore">Ignore app directory</a></li>
					<li><a href="#update">Update repo</a></li>
				</ol>
			</div>
		</div>
		<div class="large-9 columns">
			<h3><?php echo config::name(); ?> Installation</h3>
			<div class="row">
				<div class="large-12 columns">
					<p>These are some basic installation instructions. They are sort of general since I don't have enough time to document everyone's server environment. If any of these instructions seem erroneous or you have some errors on your screen you'd like some help with, feel free to contact <a href="mailto:jeff@offthewallmedia.com?subject=ezPHP+install+bug">Jeff Hays</a> to report your issue.</p>
					<h3 class="subheader"><a name="git" alt="Setup git repository" title="Setup git repository">Setup git repository</a></h3>
					<div class="panel">
						<p>Start by <a href="https://github.com/jphase/ezPHP/" alt="Fork jphase on github!" title="Fork jphase on github!" target="_blank"><i class="fa fa-github fa-large"></i> forking me on github! <i class="fa fa-github fa-large"></i></a> These installation steps are assuming you already have git installed and the commands are meant for a unix/linux command line. After you've forked the repo, you should be able to add it how your normally would your own github projects:</p>
						<hr>
						<blockquote>
							<p><code>git init</code></p>
							<p><code>git remote add origin git@github.com:jphase/ezPHP.git</code></p>
							<p><code>git pull origin master</code></p>
						</blockquote>
						<hr>
					</div>
					<h3 class="subheader"><a name="config" alt="Setup <?php echo config::name(); ?> config file" title="Setup <?php echo config::name(); ?> config file">Setup config file</a></h3>
					<div class="panel">
						<h4>Copy config.sample.php to config.php</h4>
						<p>Once you've downloaded the git repository, you'll need to go into the config directory and move or copy config.sample.php to config.php. After you've done that you'll need to open up config.php and setup all the variables as you see fit. The sections should be pretty self explanatory. Here's how you'd do this on Linux or Mac <small>(from the root of the git repo)</small>:</p>
						<hr>
						<blockquote>
							<p><code>cd config</code></p>
							<p><code>cp config.sample.php config.php</code></p>
						</blockquote>
						<hr>
						<p>Then you'd open up the config.php file with vim or nano or whatever you prefer.</p>
					</div>
					<h3 class="subheader"><a name="permissions" alt="Setup permissions" title="Setup permissions">Setup permissions</a></h3>
					<div class="panel">
						<h4>Give write access to your web server on the sessions directory</h4>
						<p>After you've copied the config file over, you'll need to give apache (or nginx or whatever you use) write access to the sessions directory in order to get the warnings to go away. Since I'm not going to turn this site into a linux permissions tutorial, I'll just give two examples for popular linux distros:</p>
						<hr>
						<blockquote>
							<p><em>CentOS / Fedora: <small>(default apache config)</small></em></p>
							<p><code>chgrp -R apache tmp</code></p>
							<p><code>chmod -R g+w tmp</code></p>
						</blockquote>
						<hr>
						<blockquote>
							<p><em>Ubuntu: <small>(default apache config)</small></em></p>
							<p><code>chgrp -R www-data tmp</code></p>
							<p><code>chmod -R g+w tmp</code></p>
						</blockquote>
						<hr>
						<p>For any other more custom configs, just make sure apache has write access to the tmp directory</p>
					</div>
					<h3 class="subheader"><a name="ignore" alt="Ignore app directory" title="Ignore app directory">Ignore app directory</a></h3>
					<div class="panel">
						<h4>Ignore app directory with .gitignore so you can update the <?php echo config::name(); ?> core</h4>
						<p>If you want to continue to use git pull to update <?php echo config::name(); ?> core files without ruining your entire project. These instructions are just to ignore the packages/app folder with a .gitignore file. You may also want to consider ignoring the folders in your public direcotry as well. I'll assume you can figure that part out.</p>
						<hr>
						<blockquote>
							<p><em>Create the file: packages/app/.gitignore and add an asterisks to that file:</em></p>
							<p><code>*</code></p>
						</blockquote>
						<hr>
					</div>
					<h3 class="subheader"><a name="update" alt="Update repo" title="Update repo">Update repo</a></h3>
					<div class="panel">
						<h4>You should now be able to update your repo</h4>
						<p>After you've added the aformentioned .gitignore file, you should be able to update without the repo overwriting the work you've done in your packages/app directory. Again, you may want to add a .gitignore file to your public directory that has "css", "img", and "js" in it if you want to not update and overwrite your public assets.</p>
						<hr>
					</div>
				</div>
			</div>
		</div>
	</div>