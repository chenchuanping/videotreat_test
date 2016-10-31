<?php

function daddslashes($str)
{
	return (!get_magic_quotes_gpc())?addslashes($str):$str;
}