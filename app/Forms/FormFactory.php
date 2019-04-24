<?php

declare(strict_types=1);

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;


final class FormFactory
{
	use Nette\SmartObject;

	public function create(): Form
	{
		$form = new Form;
		return $form;
	}
}
