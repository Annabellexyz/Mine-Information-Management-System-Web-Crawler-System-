<?php
//去掉空格、去掉单引号
function new_trim($str)
{
	if(!is_array($str)) return str_replace('\'','',trim($str));
	else 
	{
		foreach ($str as $k=>$v)
		{
			$str[$k]=str_replace('\'','',trim($v));
		}
		return $str;
	}
}

//转换编码格式
function new_iconv($str)
{
	if(!is_array($str)) return iconv('UTF-8', 'gbk', $str);
	else 
	{
		foreach ($str as $k=>$v )
		{
			$str[$k]=iconv('UTF-8', 'gbk', $v);
		}
		return $str;
	}
}

//提取字符串中的子串
function new_substr($str,$head,$end)
{
	if($str=='') return $str;
	else 
	{
		return substr($str,strpos($str,$head)+strlen($head),strpos($str,$end)-strpos($str,$head)-strlen($head));
	}
}
?>