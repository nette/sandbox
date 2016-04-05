<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;


class FormFactory
{
	use Nette\SmartObject;

	/**
	 * @return Form
	 */
	public function create()
	{
		return new Form;
	}

}
