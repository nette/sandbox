<?php declare(strict_types=1);

namespace App\Presenters;


final class RedisPresenter extends BasePresenter
{

	/**
	 * @var \Nette\Caching\Cache
	 */
	private $cache;


	public function __construct(
		\Nette\Caching\Cache $cache
	)
	{
		parent::__construct();
		$this->cache = $cache;
	}


	/**
	 * @throws \Exception
	 */
	public function renderDefault(): void
	{
		// Random data
		$this->cache->save('key', [
			'a' => 1,
			'b' => 2,
			'c' => 3,
			'd' => 4,
		], []);

		$keyedArray = $this->cache->load('key');

		\Tracy\Debugger::barDump($keyedArray);

		// Entity
		$article = new \App\Model\Article(1, 'Článeček');
		$this->cache->save('article-' . $article->getId(), $article, [
			\Nette\Caching\Cache::TAGS => [
				'allArticles',
			],
		]);

		$loadedArticle = $this->cache->load('article-' . $article->getId());

		$this->getTemplate()->setParameters([
			'keyedArray' => $keyedArray,
			'article' => $loadedArticle,
		]);

		\Tracy\Debugger::barDump($loadedArticle);

		// invalidate cache for all articles
		$this->cache->clean([
			\Nette\Caching\Cache::TAGS => [
				'allArticles',
			],
		]);

		$invalidated = $this->cache->load('article-' . $article->getId());

		\Tracy\Debugger::barDump($invalidated);
	}

}
