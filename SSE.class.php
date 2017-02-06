<?php

	namespace SSE;

	class ServerSentEvent
	{

		//设置头信息，SSE规定必须这样
		public function __construct()
		{
			session_start();
			header('Content-Type: text/event-stream');
			header('Cache-Control: no-cache');
		}


		public function sendDataToClient($data, $retryTime=1500)
		{

	    	echo 'retry:'.$retryTime.PHP_EOL;

	    	echo 'data:'.$data.PHP_EOL.PHP_EOL;

	    	ob_end_flush();
	  		flush();

		}

		//检查数据库中是否有新发布的公告
		public function checkHaveNewData()
		{
			$mysqli = new \mysqli('localhost', 'root', 'root', 'demo');

			$mysqli->set_charset( "utf8" );

			$sql = "select id,title,content from news where status=1 order by id desc limit 1";

			$res = $mysqli->query($sql);

			if ($res && $mysqli->affected_rows > 0 ) {

				$list = [];

				while ( $row = $res->fetch_assoc() ) {

					$list[] = $row;
					
				}

				if ( $_SESSION['newdata'] != json_encode($list) ) {

					unset($_SESSION['newdata']);

					$_SESSION['newdata'] = json_encode($list);
					return $_SESSION['newdata'];
				}

				// echo '<pre>';
				// print_r($list);
			} else {

				return false;
			}
		}

	}