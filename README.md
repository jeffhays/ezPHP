ezPHP
=====

Another PHP Framework that's geared to be extremely lightweight and easy to use for developers. Comes with some great routing, autoloading, simple database class, and tons of little utilities

Full usage and instructions can be found here:  http://ezphp.org/usage/#

Usage
=====

Below is a working list of available usage. Check back here for updates on usage and how the framework works from the current git repo. When added functionality has gotten past the initial bugs and is fairly usable, I'll be sure to update this page with some more usage.

Global Constants
================

	``DS`` DIRECTORY_SEPARATOR - this would be "/" in most cases if you're smart enough to be using linux
	``EXT`` .php - I might let you config this later but I think for now let's assume you're using .php files :)
	``BASE`` The base path of your ezPHP Framework install
	``CONFIG`` Path to config directory within the base path of your ezPHP Framework install
	``PKG`` Path to packages directory within the base path of your ezPHP Framework install
	``TMP`` Path to tmp directory within the base path of your ezPHP Framework install
	``LIB`` Path to lib directory within the packages directory of your ezPHP Framework install
	``APP`` Path to app directory within the packages directory of your ezPHP Framework install
	``CORE`` Path to ez directory within the packages directory of your ezPHP Framework install
	``SESS`` Path to sessions directory within the tmp directory of your ezPHP Framework install
	``LOG`` Path to logs directory within the tmp directory of your ezPHP Framework install

These can be pretty handy when you're including files. With the autoload class you can quickly and dynamically load files based on these paths. Here's some examples with and without using autoload.

Example:

	require_once(PKG . 'mypackage' . DS . 'myclass' . EXT);
	autoload::add_class('ez\app\myclass', PKG . 'mypackage' . DS . 'myclass' . EXT);

Routing
=======

The routing was done so you don't have to be a regex nerd to complete the task at hand. It's setup with an associative array where the key of the array is the inbound URL and the value is the directory within the packages/app folder that you want the view to load from.

	array('/url/action' => 'app/path'); 
i.e.
	array('/admin' => 'areas/admin');

route::add(array('/admin' => 'areas/admin'));
=================================================

This function allows you to add routes on the fly. This of course needs to be done before the model, view, and controller, but for those of you that develop your own classes this can come in handy if you want to alter the routes.

route::show();
==============

Example:

	route::show();

Output (this looks much prettier with collapsable debugging when not on github):

	(array)
	/admin	areas/admin
	/crumbs/example/url	[empty string]
	/crumbs/example	[empty string]
	/crumbs	[empty string]

route::url();
=============

Example:

	route::url();

Result:

	This function is used in view::render() and is the main function that handles the routing. After this function runs, the files used for Controller, Model, and View are loaded for the view to use.

==========
Templating
==========

view::set('foo', 'bar');
========================

Result:

	Sets a variable $foo with the value 'bar' that is available to all template partials in the view.

html::css('style.css' [, $echo=true]);
======================================

Example:

	html::css('style.css');

Output:

	<link rel="stylesheet" href="/css/style.css">

html::js('style.js' [, $echo=true]);
====================================

Example:

	html::js('ez.js');

Output:

	<script src="/js/ez.js"></script>
	
html::favicon('favicon.png' [, $echo=true]);
============================================

Example:

	html::favicon('favicon.ico');

Output:

	<link rel="icon" href="/img/favicon.ico" type="image/x-icon">

html::breadcrumbs();
====================

Example:

	html::breadcrumbs();

Output:

	(these can be seen at the top of the page here: http://ezphp.org/admin/login)

=====
USAGE
=====

This output is based on the current URL. After I've pimped out the routing some more I'll check back here and add an additional route to this page so these crumbs have more than 1 dimension to them. You can click here to see a preview of how they look on a more nested URL.

user::require_login('/redirect/url');
=====================================

Examples:

	user::require_login();
or
	user::require_login('/admin/index');

Result:

	Checks to see if the user is logged in (requires a success user::login() call). If the user is not logged in, and the current URL is not the redirect URL, it will forward the user to the redirect URL passed. When there is no redirect URL passed, it will pull the value from config::$login_url in /config/config.php and redirect you to that URL.

user::login($values);
=====================

Example:

	user::login(array('ID' => 2, 'username' => 'jeff'));

Result:

	If the $values parameter is an array or object that has values, the User Class will automatically set $_SESSION variables for you based on the values you pass it. This allows you to do your own checking to see if the user successfully logged in. The intention of coding it like this was so that you can use this directly with the db class.

	*NEW* — This function will now automatically redirect back to the URL that called the user::require_login() function

Example with db class:

	if(is_array($_POST) && isset($_POST['username']) && isset($_POST['password'])){
		$user = db::i()->select()->from('ez_users')
		->where('username', '=', $_POST['username'])
		->andwhere('password', '=', md5($_POST['password']))->row();
		$user = user::login($user);
		if($user) header('Location: /admin/index');
	}

user::logout('/redirect/url');
==============================

Example:

	user::login();

Result:

	Logs the current user out and unsets all $_SESSION variables. If the redirect URL is passed, it will forward the user to the redirect URL passed after the user is logged out.

user::loggedin();
=================

Example:

	user::loggedin();

Result:

	Returns a boolean based on whether or not the user is logged in.

user::values();
===============

Example:

	user::values();

Result (this looks much prettier with collapsable debugging when not on github):

	Returns the array or object of the user data that was originally passed in the user::login() function. You can use this with ez::dbug(user::values()); to print out a nice dbug window of the values like so:

	(object)
	ID	0
	username	admin
	level	10
	createdon	2013-08-16 22:01:22
	user::val('key');

Example:

	user::val('username');

Result:

	Returns the 'username' value of the user array. Remember, the user values are set from the values you pass to the User Class when you call user::login($values);

========
ez Class
========

ez::dbug($mixed);
=================

This is by far one of my favorite parts of ezPHP Framework is the integration of one of my old favorite debugger classes "dBug" by Kwaku Otchere. It's a simple one-file solution to spit out the contents of all types of data to avoid having to echo pre tags and such. It also has old school JS to collapse and toggle different parts of the output. I plan to eventually write my own but this one is an old past time of mine.

Example:

	ez::dbug(array('user' => array('ID' => 2, 'name' => 'billy'), 'ip' => '127.0.0.1'));

Output (this looks much prettier with collapsable debugging when not on github):

	array
	user	
	array
	ID	2
	name	billy
	ip	127.0.0.1

ez::timer();
============

Want to time your scripts or functions? This function allows you to toggle a microtime timer just like a stop watch to pull back how many seconds it took for an operation to complete.

Example:

	ez::timer();
	usleep(100);
	ez::timer();

Output:

	Execution time: 0.00014591217041 seconds

==============
autoload Class
==============

autoload::libs('path/to/libs/directory');
=========================================

This function will automatically load PHP files from the directory passed to it. I use this same method in the public/index.php file so our lib directory is automatically loaded using autoload::libs(LIB);

Example:

	autoload::libs(PKG . 'my_addon');

Result:

	Loads all .php files from packages/my_addon. You'll need to review the list of constants when including files to make your function calls easy.

autoload::add_classes(array('namespace\classname' => 'path/to/file.php'));
==========================================================================

Adds classes to automatically load by passing a keyed array of classes and file paths. This only loads classes in an array which can then be loaded using the autoload::register(); function.

Example:

	autoload::add_classes(array(
		'ez\myconf' => CONFIG . 'myconfig.php',
		'ez\core\addon' => PKG . 'addon' . DS . 'main.php'
	));

Result:

	Loads two PHP classes:

		loads class "myconf" into namespace "ez" from file "config/myconfig.php".
		loads class "addon" into namespace "ez\core" from file "packages/addon/main.php".

autoload::add_class('namespace\classname', 'path/to/file.php');
===============================================================

Adds a class to automatically load into a namespace. This only loads a class in an array which can then be loaded using the autoload::register(); function.

Example:

	autoload::add_class('ez\core\cookies', PKG . 'myaddon' . DS . 'cookies.php');

Result:

	loads class "cookies" into namespace "ez\core" from file "packges/myaddon/cookies.php". (This would be a good example to extend the ez core for your own cookie handler)

