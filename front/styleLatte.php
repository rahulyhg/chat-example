<?php
namespace ZbynekRybicka;

require __DIR__ . '/../../../../vendor/autoload.php';

use Latte\Engine as Latte;

function JulieStyle($data) {
	$latte = new Latte();
	$latte->setTempDirectory(__DIR__ . '/../../latte');
	file_put_contents(__DIR__ . '/style.css', $latte->renderToString(__DIR__ . '/style.latte', $data));
}

$function = '\ZbynekRybicka\JulieStyle';
