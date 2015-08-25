<?php 

defined('DS') ? null : 				define('DS', DIRECTORY_SEPARATOR);

defined('SITE_ROOT') ? null : 		define('SITE_ROOT'		, DS.'xampp'.DS.'htdocs'.DS.'advertisements');
defined('DB_SERVER') ? null : 		define("DB_SERVER"		, "localhost");
defined('DB_NAME') ? null : 		define("DB_NAME"		, "advertisements");
defined('DB_USER') ? null : 		define("DB_USER"		, "root");
defined('DB_PASS') ? null : 		define("DB_PASS"		, "");
defined('HOSTNAME') ? null : 		define("HOSTNAME"		, "http://localhost/");
defined('HOST') ? null : 			define("HOST"			, HOSTNAME . "advertisements/");

// defined('SITE_ROOT') ? null : 		define('SITE_ROOT'		, DS.'home'.DS.'wwwkelly'.DS.'public_html'.DS.'advertisements');
// defined('DB_SERVER') ? null : 		define("DB_SERVER"		, "localhost");
// defined('DB_NAME') ? null : 		define("DB_NAME"		, "nemoryst_ads");
// defined('DB_USER') ? null : 		define("DB_USER"		, "nemoryst_user");
// defined('DB_PASS') ? null : 		define("DB_PASS"		, "DhjkLmnOP2{}");

defined('INCLUDES_PATH') ? null : 	define('INCLUDES_PATH', SITE_ROOT.DS.'includes');
defined('PUBLIC_PATH') ? null : 	define('PUBLIC_PATH', SITE_ROOT.DS.'public');
defined('CLASSES_PATH') ? null : 	define('CLASSES_PATH', INCLUDES_PATH.DS.'classes');

// HELPERS
require_once(INCLUDES_PATH.DS."config.php");

// CORE PHPS
require_once(CLASSES_PATH.DS."database.php");
require_once(CLASSES_PATH.DS."database_object.php");
require_once(CLASSES_PATH.DS."session.php");

// OBJECT PHPS
require_once(CLASSES_PATH.DS."user.php");
require_once(CLASSES_PATH.DS."advertisement.php");

?>