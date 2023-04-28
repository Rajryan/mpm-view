<?php
namespace Mpm\View;
use Mpm\View\TemplateEngine;
use Mpm\View\TemplateNotExistsException;
use Mpm\Http\Request;

/**
 * Renders Templates with logic applied .
 * @param array $server 
 * @param string $template_name 
 * @param array $vars Default null 
 * @return string 
 */
function render(Request $request,$template_name, $vars = null) {
  try {
    $filename = TemplateEngine::resolve($template_name); //gets first matched template name
  
    if(is_array($filename) && $filename["template"]==null) {
      throw new TemplateNotExistsException($template_name);
    }
  } catch(TemplateNotExistsException $e){
      http_response_code(500);
      exit();
  }
  
  
  if (is_array($vars) && !empty($vars)) {
    extract($vars); //now these variable can be used in template by there key 
 }
  //starts buffering 
  ob_start();
  require($filename);
  return ob_get_clean();//return buffer 
}
