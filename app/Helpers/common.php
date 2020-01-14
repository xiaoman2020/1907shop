<?php

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
//function showMsg($status,$message = '',$data = array()){
//    $result = array(
//        'status' => $status,
//        'message' =>$message,
//        'data' =>$data
//    );
//    exit(json_encode($result));
//}

function createTree($data,$parent_id=0,$level=1){

    static $new_array = [];

    if(!$data){

        return;

    }

    foreach($data as $k => $v){

        if($v -> parent_id == $parent_id){

           $v -> level = $level;

            $new_array[] = $v;

            createTree($data,$v->cate_id,$level+1);
        }

    }

    return $new_array;

}

//单文件上传
 function upload($goods_logo){

    if (request()->file($goods_logo)->isValid()) {

        //接收文件
        $photo = request()->file($goods_logo);

        //上传文件
        $store_result = $photo->store('uploads');

        return $store_result;
    }
    exit('没有文件上传或文件上传出错');

}

//多文件上传
function moreuploads($goods_logo){

    if(is_array($goods_logo)){
        return;
    }

    $img = request()->file($goods_logo);

    $result = [];

    foreach($img as $v){

        $result[] = $v -> store('uploads');


    }
    return $result;

}