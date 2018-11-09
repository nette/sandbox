<?php

declare(strict_types=1);

namespace App\Forms;

use Nette\Application\UI\Form;


interface FormFactory
{
	function create(): Form;
}
