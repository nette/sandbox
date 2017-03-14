<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;
use App\Forms;


class SignPresenter extends BasePresenter
{
	/** @var Forms\SignInFormFactory @inject */
	public $signInFactory;

	/** @var Forms\SignUpFormFactory @inject */
	public $signUpFactory;

	/** @persistent */
	public $backlink = '';


	/**
	 * Sign-in form factory.
	 */
	protected function createComponentSignInForm(): Form
	{
		return $this->signInFactory->create(function () {
			$this->restoreRequest($this->backlink);
			$this->redirect('Homepage:');
		});
	}


	/**
	 * Sign-up form factory.
	 */
	protected function createComponentSignUpForm(): Form
	{
		return $this->signUpFactory->create(function () {
			$this->redirect('Homepage:');
		});
	}


	public function actionOut()
	{
		$this->getUser()->logout();
	}

}
