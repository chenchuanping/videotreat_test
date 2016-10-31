<?php
function truncate($title)
{
	$len=mb_strlen($title,"utf-8");
	if($len>16)
	{
		$title = mb_substr($title,0,15,"utf-8")."...";
	}
	return $title;
}
function daddslashes($str)
{
	return (!get_magic_quotes_gpc())?addslashes($str):$str;
}