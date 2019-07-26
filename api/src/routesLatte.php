<?php
namespace ZbynekRybicka;

require __DIR__ . '/../../../../../vendor/autoload.php';

use Latte\Engine as Latte;

function JulieRoutes($data) {
	foreach ($data['ajax'] as &$ajax) {
		foreach ($data['database'] as $database) {
			if ($database['table'] === $ajax['service'] && in_array($ajax['method'], ['post', 'put', 'delete'])) {
				$ajax['entity'] = true;
			}
		}
	}
	$latte = new Latte();
	$latte->setTempDirectory(__DIR__ . '/latte');
	file_put_contents(__DIR__ . '/routes.php', $latte->renderToString(__DIR__ . '/routes.latte', $data));


}

$function = '\ZbynekRybicka\JulieRoutes';
