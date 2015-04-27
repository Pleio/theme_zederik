<?php
/**
 * All plugin hook handlers are bundled here
 */

/**
 * Add an option to the read acl options
 *
 * @param string $hook         'access:collections:read'
 * @param string $type         'user'
 * @param array  $return_value current read acls
 * @param array  $params       supplied params
 */
function theme_zederik_access_read_hook($hook, $type, $return_value, $params) {
	static $result;
	
	if (elgg_in_context("glz_news")) {
	
		if (!isset($result)) {
			$result = false;
	
			if (!empty($params) && is_array($params)) {
				$user_guid = (int) elgg_extract("user_id", $params);
	
				$ia = elgg_set_ignore_access(true);
	
				$glz_site = elgg_get_site_entity(GLZ_SITE_GUID);
				if ($glz_site->isUser($user_guid)) {
					$result = $glz_site->getACL();
				}
	
				elgg_set_ignore_access($ia);
			}
		}
	
		if ($result !== false) {
			$return_value[] = $result;
		}
	}
	
	return $return_value;
}
