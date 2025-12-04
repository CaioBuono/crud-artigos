<?php

spl_autoload_register(
  function($classe){
    $base = __DIR__ . '/../classes/';
    $arquivo = $base . str_replace('\\', '/', $classe) . '.class' . '.php';
    
    if(file_exists($arquivo)){
      require $arquivo;
    }
  }
);