<?php
//ȥ���ո�ȥ��������
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

//ת�������ʽ
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

//��ȡ�ַ����е��Ӵ�
function new_substr($str,$head,$end)
{
	if($str=='') return $str;
	else 
	{
		return substr($str,strpos($str,$head)+strlen($head),strpos($str,$end)-strpos($str,$head)-strlen($head));
	}
}
?>