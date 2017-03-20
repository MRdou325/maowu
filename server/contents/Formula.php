<?php

namespace formula;

// 卖价
function Sell($unit, $level)
{
	require (DATA_ROOT . "/Fomulation.php");
	require (DATA_ROOT . "/Synthesis.php");
	$rare = (int) ($unit["Rare"]);
	$price_rare = 1;
	if(isset($Synthesis["CardRareInfo"][$unit["Rare"]]))
	{
		$price_rare = $Synthesis["CardRareInfo"][$unit["Rare"]]["Price"];
	}
	$price = ($price_rare * (1 + (int) ($unit["Cost"]) / 30)) * (1 + $level / 20);
	return (int) ($price);
}

// 強化耗金
function SynthesisCost($base, $material)
{
	$BasePrice = 100;
	$cost = ceil((1 + ($base['Rare'] / 10)) * (1 + ($base['Level'] / 5)) * (1 + ($base['Cost'] / 100)) * (1 + ($material['Rare'] / 10)) * (1 + ($material['Cost'] / 100)) * $BasePrice);
	return $cost;
}

// 经验值
function SynthesisExp($base, $material)
{
	require (DATA_ROOT . "/Fomulation.php");
	require (DATA_ROOT . "/Synthesis.php");
	$master = 100;
	if(isset($Synthesis["CardRareInfo"][$material['Rare']]))
	{
		$master = $Synthesis["CardRareInfo"][$material['Rare']]["SynthesisParam"];
	}
	$bonus = 1.0;
	if($base['UnitID'] == $material['UnitID'])
	{
		$bonus = 1.15;
	}
	else if($base['Type'] == $material['Type'])
	{
		$bonus = 1.05;
	}
	return round($master * (1.0 + $material['Level'] / 2) * $bonus);
}

?>