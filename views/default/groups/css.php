<?php
/**
 * Elgg Groups css
 * 
 * @package groups
 */

?>
.groups-profile > .elgg-image {
	margin-right: 10px;
	background: #<?php echo THEME_COLOR_2; ?>;
	border: 1px solid #<?php echo THEME_COLOR_2; ?>;
}

.groups-stats {
	padding: 5px;
	color: #<?php echo THEME_COLOR_1; ?>;
}

.groups-stats a {
	color: white;
}

.groups-profile-fields .odd,
.groups-profile-fields .even {
	background: #E4E4E4;
	
	padding: 2px 4px;
	margin-bottom: 7px;
}

.groups-profile-fields .elgg-output {
	margin: 0;
}

#groups-tools > li {
	width: 48%;
	min-height: 200px;
	margin-bottom: 40px;
}

#groups-tools > li:nth-child(odd) {
	margin-right: 4%;
}

.groups-widget-viewall {
	float: right;
	font-size: 85%;
}

.groups-latest-reply {
	float: right;
}
