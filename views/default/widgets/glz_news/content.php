<?php
	
$widget = elgg_extract("entity", $vars);

$num_display = (int) $widget->num_display;
if ($num_display < 1) {
	$num_display = 5;
}

$glz_site = elgg_get_site_entity(GLZ_SITE_GUID);
echo elgg_view("output/url", array(
	"text" => elgg_view("output/img", array("src" => "mod/theme_zederik/_graphics/gizelle.jpg", "alt" => $glz_site->name)),
	"href" => $glz_site->getURL(),
	"is_trusted" => true
));

$options = array(
	"type" => "object",
	"subtype" => "blog",
	"limit" => $num_display,
	"site_guids" => array($glz_site->getGUID()), // hard coded site guid for glz.pleio.nl
	"metadata_name_value_pairs" => array(
		array(
			"name" => "status",
			"value" => "published"
		),
		array(
			"name" => "tags",
			"value" => "voorpaginanieuws"
		),
	),
	"metadata_case_sensitive" => false
);

$cache = _elgg_get_access_cache();
$cache->clear();

elgg_push_context("glz_news");

$blogs = elgg_get_entities_from_metadata($options);

elgg_pop_context();
$cache->clear();

if (!empty($blogs)) {
	echo "<ul class='elgg-list elgg-list-entity'>";
	
	foreach ($blogs as $blog) {
		echo "<li class='elgg-item'>";
		echo elgg_view("output/url", array("text" => $blog->title, "href" => $blog->getURL(), "is_trusted" => true));
		echo "</li>";
	}
	echo "</ul>";
} else {
	echo elgg_view("output/longtext", array("value" => elgg_echo("notfound")));
}
