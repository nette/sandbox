<?php

declare(strict_types=1);

// Upgrades a Major Versions of packages in composer.json
//
// usage: composer-upgrade.php                (upgrades all Nette packages)
//        composer-upgrade.php  doctrine/*    (upgrades all Doctrine packages)
//        composer-upgrade.php  *             (upgrades all packages)

$masks = array_slice($argv, 1) ?: ['nette/*', 'tracy/*', 'latte/*'];


exec('composer outdated -D --format=json', $output, $error);
if ($error) {
	exit(1);
}


$outdated = json_decode(implode($output));
$upgrade = [];
foreach ($outdated->installed as $package) {
	foreach ($masks as $mask) {
		if (fnmatch($mask, $package->name)) {
			$upgrade[] = $package->name;
			continue 2;
		}
	}
}

if (!$upgrade) {
	echo "nothing to update\n";
	exit;
}


passthru('composer --no-update --no-scripts require ' . implode(' ', $upgrade));
