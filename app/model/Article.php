<?php declare(strict_types=1);

namespace App\Model;


/**
 * @\Doctrine\ORM\Mapping\Entity
 */
class Article
{

	/**
	 * @\Doctrine\ORM\Mapping\Id
	 * @\Doctrine\ORM\Mapping\Column(type="integer")
	 * @\Doctrine\ORM\Mapping\GeneratedValue
	 */
	protected $id;

	/**
	 * @\Doctrine\ORM\Mapping\Column(type="string")
	 */
	protected $title;


	public function __construct(
		int $id,
		string $title
	)
	{
		$this->id = $id;
		$this->title = $title;
	}


	public function getId(): int
	{
		return $this->id;
	}


	public function getTitle(): string
	{
		return $this->title;
	}

}
