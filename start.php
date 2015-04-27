<?php

define("THEME_GRAPHICS", elgg_get_site_url() . "mod/theme_zederik/_graphics/");
define("THEME_COLOR_1", "95be9e"); // green
define("THEME_COLOR_2", "edc52e"); // yellow
define("THEME_COLOR_3", "dd7652"); // red
define("THEME_COLOR_4", "afb1ad"); // green
define("THEME_COLOR_5", "b2cbd2"); // blue
define("THEME_COLOR_6", "2c2c2d"); // dark grey (text)
define("THEME_COLOR_7", "e5e5e5"); // light grey (background)
define("THEME_COLOR_8", "F4E797"); // light yellow (background)
define("THEME_COLOR_9", "c9dadf"); // blue

define("GLZ_SITE_GUID", 5118402);

require_once(dirname(__FILE__) . "/lib/hooks.php");

function theme_zederik_init() {

	require_once(elgg_get_plugins_path() . "widget_manager/widgets/rss/vendors/simplepie/autoloader.php");

	elgg_register_widget_type("glz_news", elgg_echo("theme_zederik:widgets:glz_news:title"), elgg_echo("theme_zederik:widgets:glz_news:description"), "index", true);
	elgg_extend_view("css/elgg", "css/theme_zederik");
	
	elgg_unextend_view("page/elements/header", "search/header");
	
	// plugin hooks
	elgg_register_plugin_hook_handler("access:collections:read", "user", "theme_zederik_access_read_hook");
}

elgg_register_event_handler('init', 'system', 'theme_zederik_init');
