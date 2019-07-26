<?php
namespace ZbynekRybicka;

require __DIR__ . '/../../../../../../vendor/autoload.php';

use Latte\Engine as Latte;

function JulieEntity($data) {
	foreach ($data['database'] as $entity) {
		$latte = new Latte();
		$latte->setTempDirectory(__DIR__ . '/../../../../../latte');
		file_put_contents(__DIR__ . '/' . ucfirst($entity['table']) . 'Entity.php', $latte->renderToString(__DIR__ . '/entity.latte', $entity));
	}

}

$function = '\ZbynekRybicka\JulieEntity';
