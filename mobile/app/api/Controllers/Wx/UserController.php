<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Api\Controllers\Wx;

class UserController extends \App\Api\Controllers\Controller
{
	private $userService;
	private $authService;

	public function __construct(\App\Services\UserService $userService, \App\Services\AuthService $authService)
	{
		$this->userService = $userService;
		$this->authService = $authService;
	}

	public function login(\Illuminate\Http\Request $request)
	{
		$userInfo = $request->get('userinfo');
		$this->validate($request, array('code' => 'required|string'));

		if (false === ($result = $this->authService->loginMiddleWare($request->all()))) {
			return array('登录失败', 1);
		}

		return $this->apiReturn($result);
	}

	public function index(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array());
		$uid = $this->authService->authorization();
		$args['uid'] = $uid;
		$userCenterData = $this->userService->userCenter($args);
		return $this->apiReturn($userCenterData);
	}

	public function orderList(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('page' => 'required|integer', 'size' => 'required|integer', 'status' => 'required|integer'));
		$res = $this->authService->authorization();
		$orderList = $this->userService->orderList(array_merge(array('uid' => $res), $request->all()));
		return $this->apiReturn($orderList);
	}

	public function orderDetail(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required|integer'));
		$args['goods_id'] = $request->get('id');
		$args['uid'] = $this->authService->authorization();
		$order = $this->userService->orderDetail($args);
		return $this->apiReturn($order);
	}

	public function orderAppraise(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array());
		$args = $request->all();
		$args['uid'] = $this->authService->authorization();
		$order = $this->userService->orderAppraise($args);
		return $this->apiReturn($order);
	}

	public function orderAppraiseDetail(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('oid' => 'required|integer', 'gid' => 'required|integer'));
		$args = $request->all();
		$args['uid'] = $this->authService->authorization();
		$order = $this->userService->orderAppraiseDetail($args);
		return $this->apiReturn($order);
	}

	public function orderAppraiseAdd(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('gid' => 'required|integer', 'oid' => 'required|integer', 'content' => 'required', 'rank' => 'required|integer'));
		$args = $request->all();
		$args['uid'] = $this->authService->authorization();
		$res = $this->userService->orderAppraiseAdd($args);
		return $this->apiReturn($res);
	}

	public function orderCancel(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required|integer'));
		$args['goods_id'] = $request->get('id');
		$args['uid'] = $this->authService->authorization();
		$res = $this->userService->orderCancel($args);
		return $this->apiReturn($res);
	}

	public function orderPay(\Illuminate\Http\Request $request)
	{
	}

	public function addressList(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array());
		$uid = $this->authService->authorization();
		$address = $this->userService->userAddressList($uid);
		return $this->apiReturn($address);
	}

	public function addressChoice(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required|integer'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['uid'] = $uid;
		$res = $this->userService->addressChoice($args);
		return $this->apiReturn($res, $res ? 0 : 1);
	}

	public function addressAdd(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('consignee' => 'required|string', 'country' => 'required|integer', 'province' => 'required|integer', 'city' => 'required|integer', 'district' => 'required|integer', 'address' => 'required|string', 'mobile' => 'required|size:11'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['uid'] = $uid;
		$address = $this->userService->addressAdd($args);
		return $this->apiReturn($address);
	}

	public function addressDetail(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required|integer'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['uid'] = $uid;
		$address = $this->userService->addressDetail($args);
		return $this->apiReturn($address);
	}

	public function addressUpdate(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required|integer', 'consignee' => 'required|string', 'country' => 'required|integer', 'province' => 'required|integer', 'city' => 'required|integer', 'district' => 'required|integer', 'address' => 'required|string', 'mobile' => 'required|integer'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['uid'] = $uid;
		$address = $this->userService->addressUpdate($args);
		return $this->apiReturn($address);
	}

	public function addressDelete(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required|integer'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['uid'] = $uid;
		$address = $this->userService->addressDelete($args);
		return $this->apiReturn($address);
	}

	public function account(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array());
		$uid = $this->authService->authorization();
		$userInfo = $this->userService->userAccount($uid);
		return $this->apiReturn($userInfo);
	}

	public function accountDetail(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('page' => 'required|integer', 'size' => 'required|integer'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['user_id'] = $uid;
		$list = $this->userService->accountDetail($args);
		return $this->apiReturn($list);
	}

	public function deposit(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('amount' => 'required|integer', 'user_note' => 'required|string'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['uid'] = $uid;
		$args['payment'] = '微信';
		$res = $this->userService->deposit($args);
		return $this->apiReturn($res);
	}

	public function accountLog(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('page' => 'required|integer', 'size' => 'required|integer'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['user_id'] = $uid;
		$list = $this->userService->accountLog($args);
		return $this->apiReturn($list);
	}

	public function collectGoods(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('page' => 'required|integer', 'size' => 'required|integer'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['user_id'] = $uid;
		$list = $this->userService->collectGoods($args);
		return $this->apiReturn($list);
	}

	public function collectAdd(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('id' => 'required|integer'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['uid'] = $uid;
		$res = $this->userService->collectAdd($args);
		return $this->apiReturn($res, $res == 1 ? 0 : 1);
	}

	public function conpont(\Illuminate\Http\Request $request)
	{
		$this->validate($request, array('page' => 'required|integer', 'size' => 'required|integer', 'type' => 'required|integer'));
		$uid = $this->authService->authorization();
		$args = $request->all();
		$args['user_id'] = $uid;
		$list = $this->userService->myConpont($args);
		return $this->apiReturn($list);
	}
}

?>
