<?php

class Config {
  public static function get($path = null) {
    if($path) {
      $config = $GLOBALS['config'];
 
      $path = explode('.', $path);
      
     
      foreach ($path as $item) {
        if(isset($config[$item])) {
          $config = $config[$item];
          //var_dump($config);
        }
      }
      return $config;
    }
    return false;
  }

  
}
