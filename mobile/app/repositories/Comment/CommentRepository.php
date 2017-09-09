<?php
//zend by 旺旺ecshop2012所有 禁止倒卖 一经发现停止任何服务
namespace App\Repositories\Comment;

class CommentRepository implements \App\Contracts\Repository\Comment\CommentRepositoryInterface
{
	public function orderAppraiseAdd($args)
	{
		$commemt = new \App\Models\Comment();

		foreach ($args as $k => $v) {
			$commemt->$k = $v;
		}

		return $commemt->save();
	}
}

?>
