<?php

exit();
require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))) . "/engine/start.php");

admin_gatekeeper();

set_time_limit(0);

if (!subsite_manager_on_subsite()) {
	forward();
}

$site = elgg_get_site_entity();

$csv_location = dirname(dirname(dirname(__FILE__))) . "/vendors/zederik/emails.csv";

$fh = fopen($csv_location, "r");
if ($fh === false) {
	echo "couldn't open the csv file: " . $csv_location;
	exit();
}

$counter = array(
	"no_old" => 0,
	"changed" => 0,
	"added" => 0,
	"member" => 0,
	"not_found" => 0
);

while (($data = fgetcsv($fh)) !== false) {
	/**
	 * $data structure
	 *
	 * array
  	 *  0 => string 'name'
  	 *  1 => string 'new email'
  	 *  2 => string 'old email'
  	 */
	$user = false;
	
	if (!empty($data[2])) {
		// check for existing user with old email
		$users = get_user_by_email($data[2]);
		if (!empty($users) && (count($users) == 1)) {
			$user = $users[0];
			
			// make sure no duplicate emails
			if (!get_user_by_email($data[1])) {
				// change email address
				$user->email = $data[1];
				
				$user->save();
				$counter["changed"]++;
			}
		} else {
			// check with new email
			$users = get_user_by_email($data[1]);
			if (!empty($users) && (count($users) == 1)) {
				$user = $users[0];
			}
		}
	} else {
		$counter["no_old"]++;
		
		// check for existing user with new email
		$users = get_user_by_email($data[1]);
		if (!empty($users) && (count($users) == 1)) {
			$user = $users[0];
		}
	}
	
	if (!empty($user)) {
		if (!$site->isUser($user->getGUID())) {
			$site->addUser($user->getGUID());
			$counter["added"]++;
		} else {
			$counter["member"]++;
		}
	} else {
		$counter["not_found"]++;
	}
}

var_dump($counter);

echo "Done!";