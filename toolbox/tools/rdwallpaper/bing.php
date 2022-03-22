<?php
//读取文本
$str = explode("\n", file_get_contents('bsing.txt'));//使用一个字符串分割另一个字符串，并返回由字符串组成的数组。
$k = rand(0,count($str));
$sina_img = str_re($str[$k]);
$size_arr = array('large', 'mw1024', 'mw690', 'bmiddle', 'small', 'thumb180', 'thumbnail', 'square');
$size = !empty($_GET['size']) ? $_GET['size'] : 'large' ;
$server = rand(1,4);
$isize=$_GET['imgsize'];

switch($isize)
{
    case 'mw1024':
        $size = 'mw1024';
        break;
    case 'mw690':
        $size = 'mw690';
        break;
    case 'bmiddle':
        $size = 'bmiddle';
        break;
    case 'small':
        $size = 'small';
        break;
    case 'thumb180':
        $size = 'thumb180';
        break;
    case 'thumbnail':
        $size = 'thumbnail';
        break;
    case 'square':
        $size = 'square';
        break;
    default:
        $size = 'large';  
        break;
}
if(!in_array($size, $size_arr)){
    $size = 'large';
}

$url = 'https://tva'.$server.'.sinaimg.cn/'.$size.'/'.$sina_img.'.jpg';
//解析结果
$result=array("code"=>"200","imgurl"=>"$url");
//Type Choose参数代码
$type=$_GET['return'];
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