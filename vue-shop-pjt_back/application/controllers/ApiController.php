<?php
namespace application\controllers;
use Exception;

class ApiController extends Controller{
  public function categoryList(){
    return $this->model->getCategoryList();
  }

  public function productInsert() {
    $json = getJson();
    print_r($json);
    return [_RESULT => $this->model->productInsert($json)];
  }

  public function productList() {
    $param = [];

    if(isset($_GET["cate3"])) {
        $cate3 = intval($_GET["cate3"]);
        if($cate3 > 0) {
            $param["cate3"] = $cate3;
        }
    } else {
        if(isset($_GET["cate1"])) {
            $param["cate1"] = $_GET["cate1"];
        }
        if(isset($_GET["cate2"])) {
            $param["cate2"] = $_GET["cate2"];
        }
    }                 
    return $this->model->productList($param);         
  }

  public function productList2() {
    return $this->model->productList2();
  }

  public function cate1List() {
    return $this->model->cate1List();
  }

  public function cate2List() {
    $urlPaths = getUrlPaths();
    if(count($urlPaths) !== 3) {
        exit();
    }        
    $param = [ "cate1" => $urlPaths[2] ];
    return $this->model->cate2List($param);
  }

  public function cate3List() {
    $urlPaths = getUrlPaths();
    if(count($urlPaths) !== 4) {
        exit();
    }        
    $param = [ 
        "cate1" => $urlPaths[2], 
        "cate2" => $urlPaths[3]
    ];
    return $this->model->cate3List($param);
  }

  public function delProduct() {
    $urlPaths = getUrlPaths();//주소값을 / 단위로 쪼갬
    if(count($urlPaths) !== 3){
      exit();
    }
    try {
      $id = $urlPaths[2];
      $this->model->beginTransaction();
      $this->model->delProductImg($id);
      $result =  $this->model->delProduct($id);
      if($result === 1) {
          //이미지 삭제
          $dirPath = _IMG_PATH . "/" . $id;
          rmdirAll($dirPath);   
          $this->model->commit();
      } else {
          $this->model->rollback();    
      }
    } catch(Exception $e) {
        print "에러발생<br>";
        print $e . "<br>";
        $this->model->rollback();
    }    
    return [_RESULT => $result];
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
    $dirPath1 =  _IMG_PATH . "/" . $productId . "/" . "1";
    if(intval($urlPaths[3]) === 1 && $urlPaths[4] !== "null"){
      rmdir_all($dirPath1);
    }
    if(!is_dir($dirPath)) {
      mkdir($dirPath, 0777, true);
    }
    $result = file_put_contents($filePath, $image_base64); //파일경로이름에 파일을 넣어줌
    if($result){
      $param = [
        "product_id" => $productId,
        "type" => $type,
        "path" => $fileNm
      ];
      if(intval($urlPaths[3]) === 1 && $urlPaths[4] !== "null"){
        $this->model->productImageUpdate($param);
      } else{
        $this->model->productImageInsert($param);
      }
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
  
  // public function productMainImages() {
  //   $urlPaths = getUrlPaths();

  //   $result = $this->model->productMainImages($param);
    
  // }

  public function productUpdate() {
    $json = getJson();
    print_r($json);
    return [_RESULT => $this->model->productUpdate($json)];
  }
}