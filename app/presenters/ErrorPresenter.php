<?php

namespace App\Presenters;

use Nette,
	App\Model,
	Tracy\ILogger;


/**
 * Error presenter.
 */
class ErrorPresenter extends BasePresenter
{
	/** @var ILogger */
	private $logger;


	public function __construct(ILogger $logger)
	{
		$this->logger = $logger;
	}


	/**
	 * @param  Exception
	 * @return void
	 */
	public function renderDefault($exception)
	{
		if ($exception instanceof Nette\Application\BadRequestException) {
			$code = $exception->getCode();
			// load template 403.latte or 404.latte or ... 4xx.latte
			$this->setView(in_array($code, array(403, 404, 405, 410, 500)) ? $code : '4xx');

			if ($code === 404 && ($referer = $this->getHttpRequest()->getHeader('referer')) !== NULL
				&& preg_match(sprintf("#^https?://[\\.a-z0-9]++(?<=[/\\.]%s)#", preg_quote($this->getHttpRequest()->getUrl()->getHost())), $referer)
			) {
				// bad link - log exception
				$this->logger->log($exception, ILogger::EXCEPTION);
			} else {
				// log to access.log
				$this->logger->log("HTTP code $code: {$exception->getMessage()} in {$exception->getFile()}:{$exception->getLine()}", 'access');
			}

		} else {
			$this->setView('500'); // load template 500.latte
			$this->logger->log($exception, ILogger::EXCEPTION); // and log exception
		}

		if ($this->isAjax()) { // AJAX request? Note this error in payload.
			$this->payload->error = TRUE;
			$this->terminate();
		}
	}

}
