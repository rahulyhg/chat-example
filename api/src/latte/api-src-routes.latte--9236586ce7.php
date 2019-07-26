<?php
// source: /Users/zbynekrybicka/www/Magdalena/applications/SolarWindsChat/app/api/src/routes.latte

use Latte\Runtime as LR;

class Template9236586ce7 extends Latte\Runtime\Template
{

	function main()
	{
		extract($this->params);
		?><<?php ?>?php // Julie automatic generated file

use Slim\Http\Request;
use Slim\Http\Response;
use App\Service\LoginService;
use Firebase\JWT\JWT;

$app->add(function (Request $request, Response $response, $next) {
	return $next($request, $response)
		->withHeader("Access-Control-Allow-Origin", "*")
        ->withHeader("Access-Control-Allow-Headers", "X-Requested-With, Content-Type, Accept, Origin, Authorization")
        ->withHeader("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE, PATCH, OPTIONS");	
});

<?php
		$iterations = 0;
		foreach ($ajax as $request) {
			?>$app-><?php echo LR\Filters::escapeHtmlText($request['method']) /* line 16 */ ?>('<?php echo LR\Filters::escapeHtmlText($request['url']) /* line 16 */ ?>', function (Request $request, Response $response, array $args) {
	$roles = ['<?php echo LR\Filters::escapeHtmlText(implode("', '", $request['roles'])) /* line 17 */ ?>'];
	if ($request->getHeader('Authorization')) {
		$authorization = end($request->getHeader('Authorization'));
		if ($authorization) {
			$user = (array) JWT::decode($authorization, LoginService::JWT_KEY, ['HS256']);
		} else {
		$user = (array) [];
		}
	} else {
		$user = (array) [];
	}
	if (!$user && !in_array('guest', $roles)) {
		return $response->withStatus(401);
	}
	if ($user && !in_array($user['role'], $roles)) {
		return $response->withStatus(401);
	}
	$params = (array) $args;
	$body = $request->getParsedBody() ?: [];
<?php
			if ($request['mock'] === "true") {
				?>	return $response->withStatus(200)->withJson(json_decode('<?php echo LR\Filters::escapeHtmlText($request['mockData']) /* line 37 */ ?>'));
<?php
			}
			elseif ($request['entity']) {
				?>	$<?php echo LR\Filters::escapeHtmlText($request['service']) /* line 39 */ ?>Entity = $this->MF-><?php
				echo LR\Filters::escapeHtmlText($request['service']) /* line 39 */ ?>Service()->newEntity($params + $body);
	$result = $this->MF-><?php echo LR\Filters::escapeHtmlText($request['service']) /* line 40 */ ?>Service()-><?php
				echo LR\Filters::escapeHtmlText($request['title']) /* line 40 */ ?>($<?php echo LR\Filters::escapeHtmlText($request['service']) /* line 40 */ ?>Entity, $user);
<?php
			}
			else {
				?>	$result = $this->MF-><?php echo LR\Filters::escapeHtmlText($request['service']) /* line 42 */ ?>Service()-><?php
				echo LR\Filters::escapeHtmlText($request['title']) /* line 42 */ ?>(<?php
				$iterations = 0;
				foreach ($request['params']['user'] as $user) {
					?>$user['<?php echo LR\Filters::escapeHtmlText($user) /* line 43 */ ?>'], <?php
					$iterations++;
				}
				$iterations = 0;
				foreach ($request['params']['params'] as $param) {
					?>$params['<?php echo LR\Filters::escapeHtmlText($param) /* line 44 */ ?>'], <?php
					$iterations++;
				}
				$iterations = 0;
				foreach ($request['params']['body'] as $body) {
					?>$body['<?php echo LR\Filters::escapeHtmlText($body) /* line 45 */ ?>'], <?php
					$iterations++;
				}
?>$isForOwner, $isForManager);
<?php
			}
			?>	$status = <?php
			if ($request['method'] === 'get') {
				?>!!$result ? 200 : 400<?php
			}
			elseif ($request['method'] === 'post') {
				?>!!$result ? 201 : 400<?php
			}
			elseif ($request['method'] === 'put') {
				?>!!$result ? 400 : 204<?php
			}
			elseif ($request['method'] === 'delete') {
				?>!! $result ? 400 : 204<?php
			}
?>;
	return $response->withStatus($status)->withJson($result);
});

<?php
			$iterations++;
		}
?>
$app->post('/files', function (Request $request, Response $response, array $args) {
	$uploadedFiles = $request->getUploadedFiles();
	$file = $uploadedFiles['file'];
	$directory = __DIR__ . '/files/';
	$file->moveTo($directory . $uploadedFile->getClientFilename());
	return $response->withStatus(201)->withJson($filename);
});<?php
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (!$this->getReferringTemplate() || $this->getReferenceType() === "extends") {
			if (isset($this->params['user'])) trigger_error('Variable $user overwritten in foreach on line 42');
			if (isset($this->params['param'])) trigger_error('Variable $param overwritten in foreach on line 43');
			if (isset($this->params['body'])) trigger_error('Variable $body overwritten in foreach on line 44');
			if (isset($this->params['request'])) trigger_error('Variable $request overwritten in foreach on line 15');
		}
		
	}

}
