<?php
namespace App\Integrations;

use App\Utils\Reader\BaseReader;

class FooInsuranceApi implements BaseApi
{
    /**
     * @var BaseReader $reader
     */
    private $reader;

    public function __construct(BaseReader $reader) {
        $this->reader = $reader;
    }
    public function excecute(){
       $data = $this->reader->readFile();
       return $data;
    }

    
}
