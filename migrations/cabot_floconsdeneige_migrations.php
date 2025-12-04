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
		return [
			'add_columns'		=> [
				$this->table_prefix . 'users'	=> [
					'user_floconsdeneige'		=> ['BOOL', 1, 'after' => 'user_options'],
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_columns'		=> [
				$this->table_prefix . 'users'	=> [
					'user_floconsdeneige',
				],
			],
		];
	}
}
