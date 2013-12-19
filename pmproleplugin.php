<?php
/*
Plugin Name: PMP Role Plugin
Plugin URI: http://www.jacobisawesome.com/pmp-is-the-shiz/
Description: Manages switching the Wordpress role for paid and unpaid users when subscription status changes
Version: .1
Author: Jacob Lauzier
Author URI: http://www.jacobisawesome.com
*/
/*
	This code will make members signing up for membership level #1 authors and make them subscribers when they cancel.
*/
function my_pmpro_after_change_membership_level($level_id, $user_id)
{
	if($level_id > 0)
	{
		//New member of level #1. If they are a subscriber, make them an author.
		$wp_user_object = new WP_User($user_id);
		if(in_array("free", $wp_user_object->roles))
			$wp_user_object->set_role('paid');
	}
	else
	{
		//Not a member of level #1. If they are an author, make them a subscriber.
		$wp_user_object = new WP_User($user_id);
		if(in_array("paid", $wp_user_object->roles))
			$wp_user_object->set_role('free');
	}
}
add_action("pmpro_after_change_membership_level", "my_pmpro_after_change_membership_level", 10, 2);
?>