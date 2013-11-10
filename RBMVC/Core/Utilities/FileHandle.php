<?php
/**
 * Created by PhpStorm.
 * User: ricoschulz
 * Date: 02.11.13
 * Time: 03:01
 */

namespace RBMVC\Core\Utilities;

/**
 * Class FileHandle
 * @package RBMVC\Core\Utilities
 */
class FileHandle {

    /**
     * @var string
     */
    private $path = '';

    /**
     * @param string $path
     *
     * @return FileHandle
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return bool
     */
    public function existsFile($path = '') {
        if (empty($path)) {
            $path = $this->path;
        }

        return file_exists($path);
    }

    /**
     * @param string $fullPath
     * @param string $content
     *
     * @return void
     */
    public function createFile($fullPath = '', $content = '') {
        if (empty($fullPath)) {
            $fullPath = $this->path;
        }

        $path    = explode('/', $fullPath);
        $dirPath = str_replace(end($path), '', $fullPath);

        if (!$this->existsFile($dirPath)) {
            mkdir($dirPath, 0777, true) or error_log(__METHOD__ . '::> ' . print_r('Could not create dirs: ', $dirPath, 1));
        }

        if (!$this->existsFile($fullPath)) {
            $fileHandle = fopen($fullPath, 'w+');
            fwrite($fileHandle, $content);
            fclose($fileHandle);
        }

    }

    /**
     * @param string $path
     *
     * @return void
     */
    public function deleteFile($path = '') {
        if (empty($path)) {
            $path = $this->path;
        }
        unlink($path);
    }
}