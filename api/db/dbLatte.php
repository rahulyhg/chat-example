<?php
namespace ZbynekRybicka;

require __DIR__ . '/../../../../../vendor/autoload.php';

use Latte\Engine as Latte;

function JulieMigrationEntity($data) {
	$latte = new Latte();
	$latte->setTempDirectory(__DIR__ . '/../../../../latte');
	file_put_contents(__DIR__ . '/import/import.sql', $latte->renderToString(__DIR__ . '/db.latte', $data));

}

$function = '\ZbynekRybicka\JulieMigrationEntity';
