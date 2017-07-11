<?php
declare(strict_types=1);

namespace App\Presenters;

use App\Forms;
use Nette\Application\UI\Form;


class SignPresenter extends BasePresenter
{
	/** @var Forms\SignInFormFactory */
	private $signInFactory;

	/** @var Forms\SignUpFormFactory */
	private $signUpFactory;


	public function __construct(Forms\SignInFormFactory $signInFactory, Forms\SignUpFormFactory $signUpFactory)
	{
		$this->signInFactory = $signInFactory;
		$this->signUpFactory = $signUpFactory;
	}


	/**
	 * Sign-in form factory.
	 */
	protected function createComponentSignInForm(): Form
	{
		return $this->signInFactory->create(function () {
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
