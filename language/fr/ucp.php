<?php
/**
*
* @package phpBB Extension - Flocons de neige - French
* @copyright (c) cabot
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang = array_merge($lang, array(
	'FLOCONSDENEIGE'			=> 'Afficher les flocons de neige',
	'FLOCONSDENEIGE_EXPLAIN'	=> 'Sélectionner "Non" pour désactiver les flocons de neige sur le forum',
));
