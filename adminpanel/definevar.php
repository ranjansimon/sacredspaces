<?php
$mtype=array("S"=>"Sell","R"=>"Rent","P"=>"Paying Guest");
define('MTYPE',serialize($mtype));
$rmtype=array("S"=>"Purchase","R"=>"Rent","P"=>"Paying Guest");
define('RMTYPE',serialize($rmtype));

$ptyp=array("1"=>"New Property","2"=>"Resale Property");
define('PTYP',serialize($ptyp));
$ownership=array("B"=>"Builder","I"=>"Individual Owned","J"=>"Jointly Owned","C"=>"Co-operative Housing Society","O"=>"Others");
define('OWNERSHIP',serialize($ownership));
$age=array("0"=>"Not Define",""=>"Not Define","UC"=>"Under Construction","1Y"=>"0 - 1 year","3Y"=>"1 - 3 years","10Y"=>"4 - 10 years","11Y"=>"Above 10 years");
define('AGE',serialize($age));

$areaunit=array("NVL"=>"Net Value","SQF"=>"Sq. Feet","SQM"=>"Sq. mtr","SQY"=>"Sq. Yards","ACR"=>"Acre","CNT"=>"Cents");
define('AREAUNIT',serialize($areaunit));
$contactby=array("","All","Agents/Brokers","Individuals","Builder");
define('CONTACTBY',serialize($contactby));
$furnished=array("Not define","Fully Furnished","Semi Furnished","Unfurnished");
define('FURNISHED',serialize($furnished));
$requiretime=array("Not Preffer","Urgent","3months","6months");
define('REQUIRETIME',serialize($requiretime));
?>