<?php
/**
*
* @package phpBB Extension - Flocons de neige
* @copyright (c) cabot
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

namespace cabot\floconsdeneige\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/**
	* Constructor
	*
	* @param \phpbb\request\request		$request	Request object
	* @param \phpbb\template\template	$template	Template object
	* @param \phpbb\user				$user		User object
	* @return \cabot\floconsdeneige\event\listener
	* @access public
	*/
	public function __construct(\phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->request = $request;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.ucp_prefs_view_data'			=> 'ucp_prefs_data_add',
			'core.ucp_prefs_view_update_data'	=> 'ucp_prefs_data_update',
			'core.page_header'					=> 'include_files_floconsdeneige',
		);
	}

	/**
	* Add configuration to UCP
	*/
	public function ucp_prefs_data_add($event)
	{
		$this->user->add_lang_ext('cabot/floconsdeneige', 'ucp');

		$floconsdeneige = $this->request->variable('floconsdeneige', (bool) $this->user->data['user_floconsdeneige']);
		$event['data'] = array_merge($event['data'], array(
			'floconsdeneige'	=> $floconsdeneige,
		));

		$this->template->assign_vars(array(
			'S_FLOCONSDENEIGE'	=> $floconsdeneige,
		));
	}

	/**
	* Updates configuration in UCP
	*/
	public function ucp_prefs_data_update($event)
	{
		$event['sql_ary'] = array_merge($event['sql_ary'], array(
			'user_floconsdeneige'		=> $event['data']['floconsdeneige'],
		));
	}

	/**
	* Include CSS and JS in template according to radio checked in UCP
	*/
	public function include_files_floconsdeneige($event)
	{
		$this->template->assign_vars(array(
			'S_DISPLAY_FLOCONSDENEIGE'	=> $this->user->data['user_floconsdeneige'],
		));
	}	
}
