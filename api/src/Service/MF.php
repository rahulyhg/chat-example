<?php // Julie automatic generated file
namespace App\Service;

class MF {

	public static $instance = null;

	public static function create() {
		if (!self::$instance) {
			self::$instance =  new self();
		}
		return self::$instance;
	}

	public function userAuthService() {
		return UserAuthService::create();
	}
	
	public function userHelperService() {
		return UserHelperService::create();
	}
	
	public function messageService() {
		return MessageService::create();
	}
	
	public function userService() {
		return UserService::create();
	}
	
	public function groupService() {
		return GroupService::create();
	}
	
	public function group_memberService() {
		return Group_memberService::create();
	}
	


}
