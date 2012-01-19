<?php

	gatekeeper();
	
	$group_guid = (int) get_input("group_guid");
	
	$owner_block = get_input("owner_block");
	$actions = get_input("actions");
	$menu = get_input("menu");
	$members = get_input("members");
	$featured = get_input("featured");
	
	$forward_url = REFERER;
	
	if(($group = get_entity($group_guid)) && ($group instanceof ElggGroup)){
		if($group->canEdit()){
			$prefix = "group_tools:cleanup:";
			
			$group->setPrivateSetting($prefix . "owner_block", $owner_block);
			$group->setPrivateSetting($prefix . "actions", $actions);
			$group->setPrivateSetting($prefix . "menu", $menu);
			$group->setPrivateSetting($prefix . "members", $members);
			$group->setPrivateSetting($prefix . "featured", $featured);
			
			
			$forward_url = $group->getURL();
			system_message(elgg_echo("group_tools:actions:cleanup:success"));
		} else {
			register_error(elgg_echo("groups:cantedit"));
		}
	} else {
		register_error(elgg_echo("groups:notfound:details"));
	}
	
	forward($forward_url);