<?php
namespace App\Utils\Reader;


class ReaderCsv extends BaseReader
{
    
    /**
     * constructor
     * @param string $filePath 
     * @return void 
     */
    public function __construct(string $filePath)
    {
        parent::__construct($filePath);
    }
     
    public function readFile(): array
    {
        $data = [];
        $file = fopen($this->filePath, 'r');
        while (($line = fgetcsv($file)) !== false) {
            if (!isset($line[0]) || !isset($line[1])) {
                $msgError = "Remember csv file must have two columns and comma separated.";
                throw new \Exception("[ReaderCsv] Invalid line: " . implode(",", $line) . ". " . $msgError);
            }
            $data[$line[0]] = $line[1];
        }
        fclose($file);
        return $data;
    }


}