<?php

namespace Icybee\Modules\Cache;

use ICanBoogie\Routing\ActionController;

class CacheController extends ActionController
{
	protected function action_get_admin()
	{
		$this->view->content = new ManageBlock($this->module);
		$this->view->template = null;
	}
}
