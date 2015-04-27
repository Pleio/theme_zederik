<?php
/**
 * Elgg header logo
 */

$site = elgg_get_site_entity();
$site_name = $site->name;
$site_url = elgg_get_site_url();
?>
<h1>
	<a class="elgg-heading-site" href="<?php echo $site_url; ?>">
		&nbsp;
	</a>
</h1>
<?php if (elgg_is_logged_in()) { ?>
<img class="theme-zederik-header-gradient" src="<?php echo $site_url; ?>mod/theme_zederik/_graphics/header_gradient.png"></img>
<?php } else {?>
<style type="text/css">
	.elgg-page-header > .elgg-inner {
		background: none;
	}
</style>
<?php } ?>
<img class="theme-zederik-header-zederik" src="<?php echo $site_url; ?>mod/theme_zederik/_graphics/logo_intranet_zederik.png"></img>
