<?php
/*	Project:	EQdkp-Plus
 *	Package:	Star Wars - the old republic game package
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
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