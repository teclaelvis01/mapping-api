<?php
namespace App\Utils\Reader;

use Exception;

abstract class BaseReader
{
    protected $filePath;
    /**
     * constructor
     * @param mixed $filePath 
     * @return void 
     */
    public function __construct($filePath) 
    {
        $this->filePath = $filePath;
    }
    abstract public function readFile(): array;
    
    /**
     * validateFileExist
     * @return $this 
     * @throws Exception 
     */
    public function validateFileExist()
    {
        if (!file_exists($this->filePath)) {
            throw new \Exception('[BaseReader] File not found with path ' . $this->filePath);
        }
        return $this;
    }
}