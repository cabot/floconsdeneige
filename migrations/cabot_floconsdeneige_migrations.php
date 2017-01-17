<?php
/**
*
* @package phpBB Extension - Flocons de neige
* @copyright (c) cabot
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace cabot\floconsdeneige\migrations;

class cabot_floconsdeneige_migrations extends \phpbb\db\migration\migration
{
	public function update_schema()
	{
		return array(
			'add_columns'		=> array(
				$this->table_prefix . 'users'	=> array(
					'user_floconsdeneige'		=> array('BOOL', 1, 'after' => 'user_options'),
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_columns'		=> array(
				$this->table_prefix . 'users'	=> array(
					'user_floconsdeneige',
				),
			),
		);
	}
}
