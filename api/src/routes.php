<?php // Julie automatic generated file

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

$app->post('/login', function (Request $request, Response $response, array $args) {
	$roles = ['guest'];
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
	$result = $this->MF->userAuthService()->postLogin($body['username'], $body['password'], $isForOwner, $isForManager);
	$status = !!$result ? 201 : 400;
	return $response->withStatus($status)->withJson($result);
});

$app->post('/users', function (Request $request, Response $response, array $args) {
	$roles = ['guest'];
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
	$result = $this->MF->userHelperService()->postUser($body['email'], $body['username'], $body['nickname'], $body['password'], $body['retype'], $isForOwner, $isForManager);
	$status = !!$result ? 201 : 400;
	return $response->withStatus($status)->withJson($result);
});

$app->post('/messages', function (Request $request, Response $response, array $args) {
	$roles = ['owner'];
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
	$messageEntity = $this->MF->messageService()->newEntity($params + $body);
	$result = $this->MF->messageService()->postMessage($messageEntity, $user);
	$status = !!$result ? 201 : 400;
	return $response->withStatus($status)->withJson($result);
});

$app->get('/messages', function (Request $request, Response $response, array $args) {
	$roles = ['owner'];
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
	$result = $this->MF->messageService()->getAllMessage($isForOwner, $isForManager);
	$status = !!$result ? 200 : 400;
	return $response->withStatus($status)->withJson($result);
});

$app->post('/files', function (Request $request, Response $response, array $args) {
	$uploadedFiles = $request->getUploadedFiles();
	$file = $uploadedFiles['file'];
	$directory = __DIR__ . '/files/';
	$file->moveTo($directory . $uploadedFile->getClientFilename());
	return $response->withStatus(201)->withJson($filename);
});