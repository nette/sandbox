<?php

namespace App\Presenters;

use Nette;
use Tracy\ILogger;


class ErrorPresenter extends Nette\Object implements Nette\Application\IPresenter
{
	/** @var ILogger */
	private $logger;

	/** @var bool */
	private $debugMode;


	public function __construct(ILogger $logger, $debugMode = FALSE)
	{
		$this->logger = $logger;
		$this->debugMode = $debugMode;
	}


	/**
	 * @return Nette\Application\IResponse
	 */
	public function run(Nette\Application\Request $request)
	{
		$e = $request->getParameter('exception');

		if ($e instanceof Nette\Application\BadRequestException) {
			// $this->logger->log("HTTP code {$e->getCode()}: {$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", 'access');
			return new Nette\Application\Responses\ForwardResponse($request->setPresenterName('Error4xx'));

		} elseif ($this->debugMode) {
			throw $e;
		}

		$this->logger->log($e, ILogger::EXCEPTION);
		return new Nette\Application\Responses\CallbackResponse(function () {
			require __DIR__ . '/templates/Error/500.phtml';
		});
	}

}
