<?php
function getRandomFileNm($fileName) {
    return gen_uuid_v4() . "." . getExt($fileName);
}

function getExt($fileName) {
    return pathinfo($fileName, PATHINFO_EXTENSION);
}

function gen_uuid_v4() { 
    return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x'
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0x0fff) | 0x4000
        , mt_rand(0, 0x3fff) | 0x8000
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff)
        , mt_rand(0, 0xffff) 
    ); 
}

function rmdirAll($dir) {
    $dirs = dir($dir);
    while(false !== ($entry = $dirs->read())) {
        if(($entry != '.') && ($entry != '..')) {
            if(is_dir($dir.'/'.$entry)) {
                rmdirAll($dir.'/'.$entry);
            } else {
                @unlink($dir.'/'.$entry);
            }
        }
    }
    $dirs->close();
    @rmdir($dir);
}

function rmdir_all($dir) {
    if (!file_exists($dir)) {
      return;
    }
    $dhandle = opendir($dir);
    if ($dhandle) {
      while (false !== ($fname = readdir($dhandle))) {
         if (is_dir( "{$dir}/{$fname}" )) {
            if (($fname != '.') && ($fname != '..')) {
               $this->rmdir_all("$dir/$fname");
            }
         } else {
            unlink("{$dir}/{$fname}");
         }
      }
      closedir($dhandle);
    }
    rmdir($dir);
}
