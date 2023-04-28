<?php
namespace Mpm\View;

class TemplateEngine {
  
  /** 
   * @param array $lookupDirs 
   * 
   */
  private static $lookupDirs = [];
   
  /**
   * @param array $defaultDirs 
   */
  private $defaultDirs = [];
  
  
  public static function resolve($template){
    
    $template_mining_string="";
    $i=1;
    foreach(self::$lookupDirs as $dir){
      $template_mining_string .= "$i . $dir/templates/ <br>";
      
      $a =  glob($dir."/templates/$template");
      if(count($a)>0) return $a[0];
      $i++;
    }
    return ["template_found"=>false,"template"=>null,"mining"=>$template_mining_string];
  }
  
  public static function apps(...$apps){
    self::$lookupDirs = $apps;
    return new static;
  }
  
  public function prefix($prefix){
    $lookupDirs = array_map(fn($dir)=>$prefix.$dir,self::$lookupDirs);
    self::$lookupDirs = array_map("realpath",$lookupDirs);
    return $this;
  }
  
  public function getLookups(){
    return self::$lookupDirs;
  }
  
  public function add(...$apps) {
    array_push(self::$lookupDirs,...$apps);
    return $this;
  }
  
  public static function dirs(...$dirs){
    array_push(self::$lookupDirs,...$dirs);
    return new static;
  }
}