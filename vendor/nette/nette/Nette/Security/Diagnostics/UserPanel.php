<?php

/**
 * This file is part of the Nette Framework (http://nette.org)
 * Copyright (c) 2004 David Grudl (http://davidgrudl.com)
 */

namespace Nette\Security\Diagnostics;

use Nette;


/**
 * User panel for Debugger Bar.
 *
 * @author     David Grudl
 */
class UserPanel extends Nette\Object implements Nette\Diagnostics\IBarPanel
{
	/** @var Nette\Security\User */
	private $user;


	public function __construct(Nette\Security\User $user)
	{
		$this->user = $user;
	}


	/**
	 * Renders tab.
	 * @return string
	 */
	public function getTab()
	{
		ob_start();
		$user = $this->user;
		require __DIR__ . '/templates/UserPanel.tab.phtml';
		return ob_get_clean();
	}


	/**
	 * Renders panel.
	 * @return string
	 */
	public function getPanel()
	{
		ob_start();
		$user = $this->user;
		require __DIR__ . '/templates/UserPanel.panel.phtml';
		return ob_get_clean();
	}

}
