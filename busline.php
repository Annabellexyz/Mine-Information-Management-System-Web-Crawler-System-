<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>

<?php
$BusLine["581"] = array("荣军医院", "小河村", "虎泉", "卓刀泉", "广埠屯", "街道口");
$BusLine["601"] = array("荣军医院", "小河村", "广埠屯", "街道口");
$BusLine["586"] = array("荣军医院", "小河村", "东村", "武汉理工大学", "街道口", "中南");
$BusLine["411"] = array("民族大学", "中南", "付家坡", "十五中", "长江大桥");

$stationA = isset($_GET['A']) ? trim($_GET['A']) : '';
$stationB = isset($_GET['B']) ? trim($_GET['B']) : '';

$stationA = iconv("gb2312", "utf-8", $stationA);
$stationB = iconv("gb2312", "utf-8", $stationB);
// 直达

function ZhiDa($addressA, $addressB)
{
	global $BusLine;
	$methodArray = array();
	$find = false;
	foreach ($BusLine as $busNo => $line)
	{
		if ($sortNoA = array_search($addressA, $line) && $sortNoB = array_search($addressB, $line))
		{
			$find = true;
			$TwoStation = $sortNoB - $sortNoA;
			$aspect = $TwoStation > 0 ? 'up' : 'down';
			$TwoStation = abs($TwoStation) - 1;
			$methodArray[] = array($busNo, $aspect, $TwoStation);
			$sortNoA = 0;
			$sortNoB = 0;
		}
	}
	if (!$find)
		return false;
	return $methodArray;
}

// print_r(ZhiDa($stationA, $stationB));

// 广埠屯口到中南
function YiChiHuan($stationA, $stationB)
{
	global $BusLine;
	$stationLineA = array();
	$stationLineB = array();
	foreach ($BusLine as $busNo => $line)
	{
		if ($station = array_search($stationA, $line))
			$stationLineA[] = $busNo;
		
		if ($station = array_search($stationB, $line))
			$stationLineB[] = $busNo;
	}
	// print_r($stationLineA);print_r($stationLineB);
	$arrayResult = array();
	$hasLine = false;
	foreach($stationLineA as $busRoadA) {
		foreach($stationLineB as $busRoadB)
		{
			$roadLineA = $BusLine[$busRoadA];
			$roadLineB = $BusLine[$busRoadB];
			if ($intersect = array_intersect($roadLineA, $roadLineB))
			{
				$roadAStart = array_search($stationA, $roadLineA);
				$roadBStart = array_search($stationB, $roadLineB);
				foreach ($intersect as $stationTemp)
				{
					$roadAEnd = array_search($stationTemp, $roadLineA);
					$roadAFar = $roadAEnd - $roadAStart;
					$aspectA = $roadAFar > 0 ? 'up' : 'down';
					$roadAFar = abs($roadAFar) - 1;
					
					$roadBEnd = array_search($stationTemp, $roadLineB);
					$roadBFar = $roadBStart - $roadBEnd;
					$aspectB  = $roadBFar > 0 ? 'up' : 'down';
					$roadBFar = abs($roadBFar) - 1;
					
					$hasLine = true;
					$arrayResult[] = array($busRoadA, $aspectA, $roadAFar, $stationTemp, $busRoadB, $aspectB, $roadBFar);	
				}
			}
		}
	}
	
	if ($hasLine)
		return $arrayResult;
	else
		return false;
}

	
 print_r(YiChiHuan($stationA, $stationB));
?>
</body>
</html>