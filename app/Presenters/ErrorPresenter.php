<?php
declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\Responses;
use Nette\Http;
use Tracy\ILogger;


class ErrorPresenter implements Nette\Application\IPresenter
{
	use Nette\SmartObject;

	/** @var ILogger */
	private $logger;


	public function __construct(ILogger $logger)
	{
		$this->logger = $logger;
	}


	/**
	 * @return Nette\Application\IResponse
	 */
	public function run(Nette\Application\Request $request): Nette\Application\IResponse
	{
		$e = $request->getParameter('exception');

		if ($e instanceof Nette\Application\BadRequestException) {
			// $this->logger->log("HTTP code {$e->getCode()}: {$e->getMessage()} in {$e->getFile()}:{$e->getLine()}", 'access');
			[$module, , $sep] = Nette\Application\Helpers::splitName($request->getPresenterName());
			$errorPresenter = $module . $sep . 'Error4xx';
			return new Responses\ForwardResponse($request->setPresenterName($errorPresenter));
		}

		$this->logger->log($e, ILogger::EXCEPTION);
		return new Responses\CallbackResponse(function (Http\IRequest $httpRequest, Http\IResponse $httpResponse) {
			if ((bool) preg_match('#^text/html(?:;|$)#', $httpResponse->getHeader('Content-Type'))) {
				require __DIR__ . '/templates/Error/500.phtml';
			}
		});
	}
}
