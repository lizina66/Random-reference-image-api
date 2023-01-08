<?php
//txt文件位置
const DBFILE = 'img.txt';

//读取数据 有SSL可＋S
$data = file(DBFILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
if (empty($data[0])){
    header('HTTP/1.1 503 Service Unavailable');
    die ('503 Service Unavailable');
}

header('Access-Control-Max-Age: 86400');
header('Access-Control-Allow-Origin: *');
$id = $_REQUEST['id'];

if(!isset($id)){
    $id = array_rand($data) + 1;
}
settype($id,'integer');
if ($id <= 0 || $id > $quantity){
    $id = array_rand($data) + 1;
}

$pic = $data[$id - 1];
switch ($type) {
    case 'quantity':
        echo $quantity;
        break;
    case 'json':
        $result = [
            'code' => 200,
            'id' => $id,
            'url' => $pic
        ];
        header('Content-Type: text');
        echo json_encode($result);
        break;
    default:
        header("Location:" . $pic);
}

?>