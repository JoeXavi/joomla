<?php
function safe_json_encode($value){
    if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
        $encoded = json_encode($value, JSON_PRETTY_PRINT);
    } else {
        $encoded = json_encode($value);
    }
    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            return $encoded;
        case JSON_ERROR_DEPTH:
            return 'Maximum stack depth exceeded'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_STATE_MISMATCH:
            return 'Underflow or the modes mismatch'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_CTRL_CHAR:
            return 'Unexpected control character found';
        case JSON_ERROR_SYNTAX:
            return 'Syntax error, malformed JSON'; // or trigger_error() or throw new Exception()
        case JSON_ERROR_UTF8:
            $clean = utf8ize($value);
            return safe_json_encode($clean);
        default:
            return 'Unknown error'; // or trigger_error() or throw new 
    Exception();
    }
    }
    
    
    function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } else if (is_string ($mixed)) {
        return utf8_encode($mixed);
    }
    return $mixed;
    }
    
if($_GET['token'] != 'Token123*')
    exit(0);

    include_once 'include/conexion.php';
    include_once 'include/funciones.php';

    if ($_GET['conexion'] == "todos") 
        $conexionReal = mysqli_connect($db_host,$db_usuario3, $db_password3, $db_nombre3);
    if ($_GET['conexion'] == "n2") 
        $conexionReal = mysqli_connect($db_host,$db_usuario2, $db_password2, $db_nombre2);

    $sql = "select id, title from gzvfr_categories where published = 1 and extension = 'com_content'";
    $rs = mysqli_query($conexionReal,$sql);
    $categories = array();

    while($row = $rs->fetch_array())
        $categories[] = $row;
    
    //$out =  $categories;
    //header('Content-Type: application/json');
    echo safe_json_encode($categories);
    //echo "Hello world"    
?>