<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ricoschulz
 * Date: 03.08.13
 * Time: 16:37
 * To change this template use File | Settings | File Templates.
 */

namespace RBMVC\Core;

use RBMVC\Core\Utilities\Exception\ClassLoadingException;

/**
 * Class ClassLoader
 * @package RBMVC\Core
 */
class ClassLoader {

    /**
     * @var array
     */
    private $classes = array();

    /**
     * @var array
     */
    private $namespaces = array();

    /**
     * @ return void
     */
    public function __construct() {
        set_include_path(ROOT_DIR);
        spl_autoload_extensions('.php');
        spl_autoload_register(array($this, 'load'));
    }

    /**
     * @param string $namespace
     *
     * @return void
     */
    public function addNamespace($namespace) {
        $this->namespaces[] = $namespace;
    }

    /**
     * @param array $namespaces
     *
     * @return void
     */
    public function addNamespaces(array $namespaces) {
        $this->namespaces = array_merge($this->namespaces, $namespaces);
    }

    /**
     * @param string|array $dirs
     *
     * @return array
     */
    public function getAllClassesFromDir($dirs) {
        if (is_string($dirs)) {
            $dirs = array($dirs);
        }

        $classes = array();
        foreach ($dirs as $dir) {
            if (!file_exists($dir)) {
                continue;
            }

            $dirIterator = new \DirectoryIterator($dir);
            /** @var \DirectoryIterator $item */
            foreach ($dirIterator as $item) {
                if (!$item->isFile() || !strstr($item->getFilename(), '.php')) {
                    continue;
                }
                $className = str_replace('.php', '', $item->getFilename());
                $classes[] = $this->getClassInstance($className);
            }
        }

        return $classes;
    }

    /**
     * @param string $class
     *
     * @return Object
     * @throws ClassLoadingException
     */
    public function getClassInstance($class) {
        try {
            if (!class_exists($class)) {
                $class = $this->load($class);
            }

            return new $class();
        } catch (ClassLoadingException $e) {
            throw $e;
        }
    }

    /**
     * @return array
     */
    public function getClasses() {
        return $this->classes;
    }

    /**
     * @param string $class
     *
     * @return string
     * @throws ClassLoadingException
     */
    private function getClassNamespace($class) {
        if ((bool) strstr($class, '\\') && $this->includeClassFile($class)) {
            return $class;
        }

        foreach ($this->namespaces as $namespace) {
            $classNamespace = $namespace . $class;
            if ($this->includeClassFile($classNamespace)) {
                return $classNamespace;
            }
        }

        throw new ClassLoadingException('Class ' . $class . ' not found!');
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    private function includeClassFile($class) {
        $path = ROOT_DIR . str_replace('\\', '/', $class) . '.php';
        if (file_exists($path)) {
            include_once($path);

            return true;
        }

        return false;
    }

    /**
     * @param $class
     *
     * @return string
     * @throws ClassLoadingException
     */
    private function load($class) {
        try {
            $path            = $this->getClassNamespace($class);
            $this->classes[] = $path;

            return $path;
        } catch (ClassLoadingException $e) {
            throw $e;
        }
    }

}