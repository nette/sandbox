<?php

declare(strict_types=1);

namespace App\Presenters;


final class HomepagePresenter extends BasePresenter
{

	/**
	 * @var \Nette\Caching\IStorage|\Kdyby\Redis\RedisStorage
	 */
	private $cache;

	/**
	 * @var \Kdyby\Doctrine\EntityManager
	 */
	private $entityManager;

	/**
	 * @var \Kdyby\Translation\Translator
	 */
	private $translator;

	/**
	 * @var \Kdyby\Monolog\Logger
	 */
	private $logger;


	public function __construct(
		\Nette\Caching\IStorage $cache,
		\Kdyby\Doctrine\EntityManager $entityManager,
		\Kdyby\Translation\Translator $translator,
		\Kdyby\Monolog\Logger $logger
	)
	{
		parent::__construct();
		$this->cache = $cache;
		$this->entityManager = $entityManager;
		$this->translator = $translator;
		$this->logger = $logger;
	}


	public function renderDefault(): void
	{
		$this->template->anyVariable = 'any value';

		// REDIS
		$this->cache->write('key', [
			'a' => 1,
			'b' => 2,
			'c' => 3,
			'd' => 4,
		], []);

		$this->cache->read('key');


		// DOCTRINE
		$article = new \App\Model\Article(1, 'Článeček');
		$this->cache->write('article-' . $article->getId(), $article, []);

		$this->entityManager->persist($article);
		$this->entityManager->flush();

		$foundArticle = $this->entityManager->find(\App\Model\Article::class, 1);


		// TRANSLATION
		\Tracy\Debugger::barDump($this->translator->translate('messages.homepage._some_translation'));


		// MONOLOG
		$this->logger->channel('articleRead')->addInfo($foundArticle->getTitle(), [$article->getId()]);

	}

}
