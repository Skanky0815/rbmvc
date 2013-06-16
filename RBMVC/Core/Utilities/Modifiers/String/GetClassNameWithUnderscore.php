<?php
namespace RBMVC\Core\Utilities\Modifiers\String;

class GetClassNameWithUnderscore {
 
    /**
     * @param mixed $class
     * @return string
     */
    public function getClassName($class) {
        $reflectionClass = new \ReflectionClass($class);
        $classNameParts = explode('\\', $reflectionClass->getName());
        $camelCaseToUnderscore = new CamelCaseToUnderscore();
        return $camelCaseToUnderscore->convert(end($classNameParts));        
    }
}