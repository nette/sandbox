<?php declare(strict_types = 1);

namespace App\Model;

class CalculateRandomNumber
{

	/**
	 * @throws \Exception
	 */
	public function calculate(): int
	{
		return \random_int(
			\random_int(0, 100),
			\random_int(101, 1000)
		);
	}

}
