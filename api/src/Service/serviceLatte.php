<?php
namespace ZbynekRybicka;

require __DIR__ . '/../../../../../../vendor/autoload.php';

use Latte\Engine as Latte;

function JulieService($data) {
	foreach ($data['database'] as $service) {
		$latte = new Latte();
		$latte->setTempDirectory(__DIR__ . '/../../../../../latte');
		file_put_contents(__DIR__ . '/' . ucfirst($service['table']) . 'Service.php', $latte->renderToString(__DIR__ . '/Service.latte', $service));
	}

}

$function = '\ZbynekRybicka\JulieService';
