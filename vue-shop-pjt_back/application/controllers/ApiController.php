<?php
namespace application\controllers;

class ApiController extends Controller{
  public function categoryList(){
    return $this->model->getCategoryList();
  }

  public function productInsert() {
    $json = getJson();
    print_r($json);
    return [_RESULT => $this->model->productInsert($json)];
  }

  public function productList2() {
    $result = $this->model->productList2();
    return $result === false ? [] : $result;
  }

  public function delProduct() {
    $json = getJson();
    return [_RESULT => $this->model->delProduct($json)];
  }

  public function productDetail() {
    $urlPaths = getUrlPaths();
    if(!isset($urlPaths[2])) {
      exit();
    }
    $param = [
      'product_id' => intval($urlPaths[2])
    ];
    return $this->model->productDetail($param);
  }

  public function upload() {
    $urlPaths = getUrlPaths();//주소값을 / 단위로 쪼갬
    if(!isset($urlPaths[2]) || !isset($urlPaths[3])) {
        exit();
    }
    $productId = intval($urlPaths[2]); //url path로 들어온 id pk값
    $type = intval($urlPaths[3]); //상품이미지 유형
    $json = getJson(); //이미지에대한 배열
    $image_parts = explode(";base64,", $json["image"]); //;base64기분으로 둘로나눔
    $image_type_aux = explode("image/", $image_parts[0]);      
    $image_type = $image_type_aux[1];      //jpeg,png등 이미지타입
    $image_base64 = base64_decode($image_parts[1]); //이미지문자열을 이미지파일로디코딩
    $dirPath = _IMG_PATH . "/" . $productId . "/" . $type; //이미지폴더경로
    $fileNm = uniqid() . "." . $image_type;
    $filePath = $dirPath . "/" . $fileNm; //이미지경로파일
    if(!is_dir($dirPath)) {
        mkdir($dirPath, 0777, true);//이미지폴더경로에 폴더를만들어줌
    }
    $result = file_put_contents($filePath, $image_base64); //파일경로이름에 파일을 넣어줌
    if($result){
      $param = [
        "product_id" => $productId,
        "type" => $type,
        "path" => $fileNm
      ];
      $this->model->productImageInsert($param);
      return [_RESULT => 1];
    }
  }

  public function productImageList() {
    $urlPaths = getUrlPaths();
    if(!isset($urlPaths[2])) {
        exit();
    }
    $productId = intval($urlPaths[2]);
    $param = [
        "product_id" => $productId
    ];
    return $this->model->productImageList($param);
  }

  public function productImageDelete() {
    $urlPaths = getUrlPaths();
    if(count($urlPaths) !== 6) {
      exit();
    }
    $result = 0;
    $id = intval($urlPaths[2]);
    $productId = intval($urlPaths[3]);
    $type = intval($urlPaths[4]);
    $fileNm = $urlPaths[5];
    switch(getMethod()) {
      case _DELETE:
        $filePath = _IMG_PATH . "/" . $productId . "/" . $type . "/" . $fileNm;
        if(unlink($filePath)){
          $param = ["product_image_id" => $id];
          $result = $this->model->productImageDelete($param);
        };
        break;
    }
    return [_RESULT => $result];
  }
}