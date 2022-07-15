<?php

namespace App\Utils\Mappings;

class AnosSegTag extends BaseTag
{
    
    const TAG_NAME = "AnosSegAnte";

    public function __construct($data = [], $tagName = null) {
        parent::__construct($data);
        $this->tagName = $tagName ?? self::TAG_NAME;
    }

    public function getMap(): array
    {
        // ????
        $this->item[$this->tagName] = 0;
        $dateFrom = $this->data['prevInsurance_contractDate'] ?? null;
        $dateTo = $this->data['prevInsurance_expirationDate'] ?? null;
        if(isset($dateFrom) && $this->strIsDate($dateFrom) && isset($dateTo) && $this->strIsDate($dateTo)) {
            $yearFrom = (new \DateTime($dateFrom))->y;
            $yearTo = (new \DateTime($dateTo))->y;
            $years = range($yearFrom, $yearTo);
            
            $this->item[$this->tagName] = count($years) > 0 ? count($years) - 1 : 0;
        }


        return $this->item;
    }

    /**
     * check if string is a date
     */
    private function strIsDate(string $strDate) {
        return \DateTime::createFromFormat('Y-m-d', $strDate) !== false;
    }

}