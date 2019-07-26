<?php
namespace ZbynekRybicka;

require __DIR__ . '/../../../../../vendor/autoload.php';

use Latte\Engine as Latte;

function JulieTest($data) {
	$latte = new Latte();
	$latte->setTempDirectory(__DIR__ . '/../../../../latte');
	foreach ($data['tests'] as $test) {
		file_put_contents(__DIR__ . '/' . $test['name'] . '.spec.js', $latte->renderToString(__DIR__ . '/test.latte', $test));
	}


}

$function = '\ZbynekRybicka\JulieTest';
