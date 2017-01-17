<?php
/**
*
* @package phpBB Extension - Flocons de neige - English
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
	'FLOCONSDENEIGE'			=> 'Display snowflakes',
	'FLOCONSDENEIGE_EXPLAIN'	=> 'Select "No" to disable the snowflakes on the board.',
));
