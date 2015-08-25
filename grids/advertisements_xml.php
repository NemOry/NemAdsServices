<?php

require_once("../includes/initialize.php");

global $session;

$page       = $_GET['page'];
$limit      = $_GET['rows'];
$sidx       = $_GET['sidx'];
$sord       = $_GET['sord'];

$advertisements_count = Advertisement::get_all_by_userid($session->userid);

$count = count($advertisements_count);

if( $count > 0 && $limit > 0) 
{ 
	$total_pages = ceil($count / $limit); 
} 
else 
{ 
	$total_pages = 0; 
} 
 
if ($page > $total_pages) $page = $total_pages;
 
$start = $limit * $page - $limit;
 
if($start <0) $start = 0; 
if(!$sidx) $sidx = 1;

$ops = array(
        'eq'=>'=', 
        'ne'=>'<>',
        'lt'=>'<', 
        'le'=>'<=',
        'gt'=>'>', 
        'ge'=>'>=',
        'bw'=>'LIKE',
        'bn'=>'NOT LIKE',
        'in'=>'LIKE', 
        'ni'=>'NOT LIKE', 
        'ew'=>'LIKE', 
        'en'=>'NOT LIKE', 
        'cn'=>'LIKE', 
        'nc'=>'NOT LIKE' 
    );

if(isset($_GET['searchString']) && isset($_GET['searchField']) && isset($_GET['searchOper']))
{
    $searchString = $_GET['searchString'];
    $searchField = $_GET['searchField'];
    $searchOper = $_GET['searchOper'];

    foreach ($ops as $key=>$value)
    {
        if ($searchOper==$key)
        {
            $ops = $value;
        }
    }

    if($searchOper == 'eq' ) $searchString = $searchString;
    if($searchOper == 'bw' || $searchOper == 'bn') $searchString .= '%';
    if($searchOper == 'ew' || $searchOper == 'en' ) $searchString = '%'.$searchString;
    if($searchOper == 'cn' || $searchOper == 'nc' || $searchOper == 'in' || $searchOper == 'ni') $searchString = '%'.$searchString.'%';

    $where = "$searchField $ops '$searchString'"; 

    $advertisements = Advertisement::get_by_sql("SELECT * FROM ".T_ADVERTISEMENTS." WHERE ".$where." AND userid = ".$session->userid." ORDER BY $sidx $sord LIMIT $start , $limit");
}
else
{
    $advertisements = Advertisement::get_by_sql("SELECT * FROM ".T_ADVERTISEMENTS." WHERE userid = ".$session->userid." ORDER BY $sidx $sord LIMIT $start , $limit");
}

header("Content-type: text/xml;charset=utf-8");
 
$s = "<?xml version='1.0' encoding='utf-8'?>";
$s .=  "<rows>";
$s .= "<page>".$page."</page>";
$s .= "<total>".$total_pages."</total>";
$s .= "<records>".$count."</records>";

foreach($advertisements as $advertisement)
{
    $s .= "<row id='". $advertisement->id."'>";
    $s .= "<cell></cell>"; // action
    $s .= "<cell>". $advertisement->appname."</cell>";
    $s .= "<cell>". $advertisement->image."</cell>";
    $s .= "<cell>". $advertisement->text."</cell>";
    $s .= "<cell>". $advertisement->url."</cell>";
    $s .= "<cell>". $advertisement->timer."</cell>";
    $s .= "<cell>". $advertisement->launchin."</cell>";
    $s .= "<cell>". $advertisement->appversion."</cell>";
    $s .= "<cell>". $advertisement->clicked."</cell>";
    $s .= "<cell>". $advertisement->bgcolor."</cell>";
    $s .= "<cell>". $advertisement->textcolor."</cell>";
    $s .= "<cell></cell>";
    $s .= "</row>";
}

$s .= "</rows>"; 
 
echo $s;
?>