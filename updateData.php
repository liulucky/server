<?php



	require_once('./SSE.class.php');

	$sse = new \SSE\ServerSentEvent;

	//检查数据库是否有新的公告
	$result = $sse->checkHaveNewData();

	//有新公告
	if ($result !== false) {

		//将新的公告推送给客户端
		$sse->sendDataToClient( $result );

	}

	