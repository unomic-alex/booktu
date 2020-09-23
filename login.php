<?php
	//쿼리
	$query = "select * from moviestar";
	$conn = mysql_connect("booktu-db.mariadb.database.azure.com","oneso@booktu-db","1little_0714");
	mysql_select_db("booktu", $conn);

	//한글 깨짐문제 해결방법.
	/*
	mysql_query("set session character_set_connection=utf8;");
	mysql_query("set session character_set_results=utf8;");
	mysql_query("set session character_set_client=utf8;");
	*/
	mysql_query("set names utf8"); //간단히 이거 한줄이면 되네

	$result = mysql_query($query, $conn);

	while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$res['id'] = $row["id"];
		$res['password'] = urlencode($row["password"]);
		$res['nickname'] = urlencode($row["nickname"]);
		$res['email'] =urlencode($row["email"]);
		$arr["result"][] = $res;
	}

	$json = json_encode ($arr);
	$json = urldecode ($json);
	print $json;
	mysql_close($conn);
?>
