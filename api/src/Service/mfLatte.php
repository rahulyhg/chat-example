<?php
namespace ZbynekRybicka;

require __DIR__ . '/../../../../../../vendor/autoload.php';

use Latte\Engine as Latte;

function JulieMF($data) {

	$latte = new Latte();
	$latte->setTempDirectory(__DIR__ . '/../../../../../latte');
	file_put_contents(__DIR__ . '/MF.php', $latte->renderToString(__DIR__ . '/MF.latte', $data));
}

$function = '\ZbynekRybicka\JulieMF';
