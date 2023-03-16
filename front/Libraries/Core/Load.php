<?php
    $controller = ucwords($controller);
    $controllerFile ="./Controllers/".$controller.".php";
    if(file_exists($controllerFile)){
        require_once($controllerFile);
        $controller = new $controller();
        if(method_exists($controller, $method)){
            $controller->{$method}($params);
        }else{
            require_once("Controllers/Errors.php");
        }
    }else{
        require_once("Controllers/Errors.php");
    }

    try{
    
    } catch (Exception $e){
        echo "excepcion capturada",$e->getMessage(),"\n";
    }
?>