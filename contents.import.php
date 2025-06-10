<?php

require_once("inc/db.php");

$result =db_select("select * from contents");

$result_price_H = db_select("select * from contents order by content_price desc"); //높은가격순
$result_price_L = db_select("select * from contents order by content_price "); //낮은가격순
?>