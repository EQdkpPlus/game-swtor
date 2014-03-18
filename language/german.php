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
$german_array = array(
	'factions' => array(
		'republic'	=> 'Republik',
		'imperial'	=> 'Imperium'
	),
	'classes' => array(
		0	=> 'Unbekannt',

		#republic
		1	=> 'Frontkaempfer',
        2	=> 'Kommando',
		3	=> 'Schurke',
		4	=> 'Revolverheld',
		5	=> 'Gelehrter',
		6	=> 'Schatten',
		7	=> 'Waechter',
		8	=> 'Hueter',

		# imperium
		9	=> 'Powertech',
		10	=> 'Soeldner',
		11	=> 'Saboteur',
		12	=> 'Scharfschuetze',
		13	=> 'Hexer',
		14	=> 'Attentaeter',
		15	=> 'Marodeur',
		16	=> 'Juggernaut',
	),
	'races' => array(
		0	=> 'Unknown',
		1	=> 'Mensch',
		2	=> 'Rattataki',
		3	=> 'Twi\'lek',
		4	=> 'Chiss',
		5	=> 'Reinblut Sith',
		6	=> 'Miraluka',
		7	=> 'Mirialan',
		8	=> 'Zabrak',
		9	=> 'Cyborg',
		10	=> 'Cathar',
	),
	'roles' => array(
		1	=> 'Heiler',
		2	=> 'Tank',
		3	=> 'DD Fernkampf',
		4	=> 'DD Nahkampf',
	),
	'lang' => array(
		'swtor'						=> 'Star Wars: The Old Republic',

		//Admin Settings
		'core_sett_fs_gamesettings'	=> 'SWToR Einstellungen',
		'uc_one_faction'			=> 'Klassenauswahl auf bestimmte Fraktion einschränken?',
		'uc_faction'				=> 'Fraktion',
		'uc_faction_help'			=> 'Die Klassen der gegnerischen Fraktion können nicht mehr ausgewählt werden.',

		// Roles
		'role1'						=> 'Heiler',
		'role2'						=> 'Tank',
		'role3'						=> 'DD Fernkampf',
		'role4'						=> 'DD Nahkampf',

		// Profile information
		'uc_gender'					=> 'Geschlecht',
		'uc_male'					=> 'Männlich',
		'uc_female'					=> 'Weiblich',
		'uc_guild'					=> 'Gilde',
		'uc_race'					=> 'Rasse',
		'uc_class'					=> 'Klasse',
	),
);

?>