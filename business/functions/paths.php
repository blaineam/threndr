<?php
	//function to handle requested uri values
function parse_path() {
	//delcare defualt empty array
  $path = array();
  //check if a uri is set
  if (isset($_SERVER['REQUEST_URI'])) {
	  //seperate query data from the rest of the uri
    $request_path = explode('?', $_SERVER['REQUEST_URI']);
	//declare script name
    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    //declare uri between the script name and the rest of the path in utf8 encoding
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    //decode value
    $path['call'] = utf8_decode($path['call_utf8']);
    //check if default value set to emptiness
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
    //build array from every section of the remaing path
    $path['call_parts'] = explode('/', $path['call']);
    //parse query data
if(isset($request_path[1])){
	//get query in utf8 encoding
    $path['query_utf8'] = urldecode($request_path[1]);
    //decode query
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    //vuild array from each query variable
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
	    //build array from the query variable names and values
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
    }
  }
  //return generated array
return $path;
}

//do a run through of the function
$path_info = parse_path();

?>