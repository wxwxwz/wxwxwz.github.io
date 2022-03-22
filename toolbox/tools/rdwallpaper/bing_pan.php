<?php
$img_array = glob('Picture/bing/*.{gif,jpg,png,jpeg,webp,bmp}', GLOB_BRACE);
if(count($img_array) == 0) die('没找到图片文件。请联系网站管理员！');

$img = array_rand($img_array);
$address = $img_array[$img];
$type=$_GET['return'];
$url = 'https://pan.wxwz.xyz/AliYun/'.$address;
//解析结果
$result=array("code"=>"200","imgurl"=>"$url");

switch ($type)
{   
    
//Json格式解析
case 'json':
$imageInfo = getimagesize($url);  
$result['width']="$imageInfo[0]";  
$result['height']="$imageInfo[1]";  
header('Content-type:text/json');
echo json_encode($result);  
break;
//IMG
default:
header("Location:".$result['imgurl']);
break;
}
function str_re($str){
  $str = str_replace(' ', "", $str);
  $str = str_replace("\n", "", $str);
  $str = str_replace("\t", "", $str);
  $str = str_replace("\r", "", $str);
  return $str;
}
?>