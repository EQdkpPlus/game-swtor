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
		'republic'	=> 'Rebublik',
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
		'Unknown',
		'Mensch',
		'Rattataki',
		'Twi\'lek',
		'Chiss',
		'Reinblut Sith',
		'Miraluka',
		'Mirialan',
		'Zabrak',
		'Cyborg',
		'Cathar',
	),
	'roles' => array(
		1 => array(2, 3, 5),
		2 => array(1, 6, 8),
		3 => array(2, 4, 5),
		4 => array(1, 3, 6, 7, 8)
	),
	'lang' => array(
		'swtor'						=> 'Star Wars: The Old Republic',

		//Admin Settings
		'core_sett_fs_gamesettings'	=> 'SWToR Einstellungen',
		'swtor_faction'				=> 'Fraktion',
		'swtor_faction_help'		=> 'Die Fraktion dient dem Ausblenden der Klassen der jeweils anderen Fraktion.',

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
	),
);

?>