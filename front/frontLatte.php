<?php
namespace ZbynekRybicka;

require __DIR__ . '/../../../../vendor/autoload.php';

use Latte\Engine as Latte;

function transformPathToStore($value, $shouldStore = true) {
	return str_replace('"', '\'', preg_replace('/(^|\[|\(|\s|\!|:)\./', '$1' . ($shouldStore ? '' : '') . 'state.', $value));
}

function hasActionAjax($action, $data) {
	foreach ($data['structure']['actions'] as $structureAction) {
		if ($structureAction['title'] === $action && $structureAction['ajax']) {
			return true;
		}
	}
	return false;
}


function transformComponentAttributes(&$data) {
	$transformArrayToStore = function ($item) {
		return transformPathToStore($item);
	};
	foreach ($data['ajax'] as &$request) {
		if ($request['data']) {
			$request['data'] = transformPathToStore($request['data'], false);
		} 
	}

	foreach ($data['components'] as &$component) {
		$component['tag'] = 'div';
		$component['nestedTag'] = 'div';
		$component['s-content'] = [];
		$vueAttributes = [ 'class' => $component['title'] ];
		foreach ($component['attributes'] as $attribute) {
			list($key, $value) = array_values($attribute);
			switch ($key) {
				case 'if': 
					$content = array_map($transformArrayToStore, $value);
					$vueAttributes['v-if'] = '(' . implode(") && (", $content) . ')';
					break;
				case 'ifnot': 
					$content = array_map($transformArrayToStore, $value);
					$vueAttributes['v-if'] = '!(' . implode(") && (", $content) . ')';
					break;
				case 'header':
					$component['tag'] = 'h' . $value;
					break;
				case 'button':
					$component['tag'] = 'button';
					$vueAttributes['class'] .= ' btn btn-' . $value;
					break;
				case 'nest':
				case 'static':
					$component[$key] = transformPathToStore($value);
					break;
				case 'content': 
					$content = array_map($transformArrayToStore, $value);
					$vueAttributes['v-text'] = implode(" + ", $content);
					break;
				case 'input': 
					$component['tag'] = 'input';
					if ($value === 'datetime') {
						$value = 'datetime-local';
					}
					$vueAttributes['type'] = $value;
					break;
				case 'link':
					$component['tag'] = 'a';
					$vueAttributes['href'] = $value ?: "#";
					break;
				case 'ref': 
					$vueAttributes['@input'] = "\$store.commit('input', { path: '"
						. str_replace('[', '[\' + ', 
							str_replace(']', ' + \']', 
								str_replace('[.', '[$store.state', 
									transformPathToStore($value, false))))
						. "', value: \$event.target." . ($vueAttributes['type'] === 'checkbox' ? "checked ? 1 : 0" : "value" ) . " })";	
					$value = transformPathToStore($value);
					$vueAttributes[':value'] = $vueAttributes['type'] === 'datetime-local' 
						? "moment($value).format('YYYY-MM-DDTHH:mm')" : $value;
					break;
				case 'list':
					$component['list'] = transformPathToStore($value);
					$component['nest'] = 'item';
					if ($attribute['filter']) {
						$component['filter'] = '(' . implode(') && (', array_map($transformArrayToStore, $attribute['filter'])) . ')';
					}
					break;
				case 'items':
					$store = transformPathToStore($value);
					$component['list'] = "Array.isArray($store) ? Object.assign({}, $store) : $store";
					$component['nest'] = 'item';
					$component['nestedTag'] = 'option';
					if ($attribute['filter']) {
						$component['filter'] = '(' . implode(') && (', array_map($transformArrayToStore, $attribute['filter'])) . ')';
					}
					$component['s-value'] = 'id';
					break;
				case 's-content':
					$component['s-content'][] = transformPathToStore($value);
					break;
				case 'table':
					$component['tag'] = 'tbody';
					$component['nestedTag'] = 'tr';
					break;
				case 'class':
					$vueAttributes[$key] .= ' ' . $value;
					break;
				case 'tag':
					$component['tag'] = $value;
					break;
				case 'test':
					$vueAttributes['data-test'] = $value;
					break;
				case 'prompt':
					$component['prompt'] = $value;
					break;
				case 'focus':
					$vueAttributes[':data-focus'] = str_replace('"', "'", $value);
					break;
				default:
					$vueAttributes[$key] = transformPathToStore($value);
					break;
			}
			

		} 
		foreach ($component['events'] as $event) {
			$hasAjax = hasActionAjax($event['action'], $data);
			$value = transformPathToStore($event['param'] ?: 'null');
			$action = $hasAjax ? 'dispatch' : 'commit';
			if ($vueAttributes['type'] === 'file') {
				$event['event'] = 'change';	
			}
			$vueAttributes["@{$event['event']}"] = "\$store.$action('{$event['action']}', " . ($hasAjax ? $value : "{ value: $value, res: null }") . ")";
		}
		$component['vueAttributes'] = $vueAttributes;
	}
}

function JulieFrontEnd($data) {
	transformComponentAttributes($data);
	$latte = new Latte();
	$latte->setTempDirectory(__DIR__ . '/../../latte');
	$latte->addFilter('store', function($string) {
		return transformPathToStore($string, false);
	});
	file_put_contents(__DIR__ . '/app.js', $latte->renderToString(__DIR__ . '/front.latte', $data));
	file_put_contents(__DIR__ . '/doc/components.php', $latte->renderToString(__DIR__ . '/doc/components.latte', $data));
	file_put_contents(__DIR__ . '/doc/actions.php', $latte->renderToString(__DIR__ . '/doc/actions.latte', $data));
	file_put_contents(__DIR__ . '/doc/test.js', $latte->renderToString(__DIR__ . '/doc/test.latte', $data));
}

$function = '\ZbynekRybicka\JulieFrontEnd';
