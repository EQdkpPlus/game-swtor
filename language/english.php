<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2011
 * Date:		$Date$
 * -----------------------------------------------------------------------
 * @author		$Author$
 * @copyright	2006-2011 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev$
 * 
 * $Id$
 */

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}
$english_array =  array(
	'factions' => array(
		'republic'	=> 'Republic',
		'imperial'	=> 'Empire'
	),
	'classes' => array(
		0	=> 'Unknown',

		#republic
		1	=> 'Vanguard',
        2	=> 'Commando',
		3	=> 'Scoundrel',
		4	=> 'Gunslinger',
		5	=> 'Sage',
		6	=> 'Shadow',
		7	=> 'Sentinel',
		8	=> 'Guardian',

		# imperium
		9	=> 'Powertech',
		10	=> 'Mercenary',
		11	=> 'Operative',
		12	=> 'Sniper',
		13	=> 'Sorcerer',
		14	=> 'Assassin',
		15	=> 'Marauder',
		16	=> 'Juggernaut',
	),
	'races' => array(
		'Unknown',
		'Human',
		'Rattataki',
		'Twi\'lek',
		'Chiss',
		'Sith Pureblood',
		'Miraluka',
		'Mirialan',
		'Zabrak',
		'Cyborg',
		'Cathar',
	),
	'roles' => array(
		1	=> 'Healer',
		2	=> 'Tank',
		3	=> 'Range-DD',
		4	=> 'Melee',
	),
	'lang' => array(
		'swtor'						=> 'Star Wars: The Old Republic',

		//Admin Settings
		'core_sett_fs_gamesettings'	=> 'SWToR Settings',
		'uc_one_faction'		=> 'Restrict the class selection to a specific faction?',
		'uc_faction'			=> 'Faction',
		'uc_faction_help'		=> 'The classes of the opposing faction cannot be selected anymore.',

		// Profile information
		'uc_gender'					=> 'Gender',
		'uc_male'					=> 'Male',
		'uc_female'					=> 'Female',
		'uc_guild'					=> 'Guild',
		'uc_race'					=> 'Race',
		'uc_class'					=> 'Class',
	),
);

?>