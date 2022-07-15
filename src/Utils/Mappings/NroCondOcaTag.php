<?php

namespace App\Utils\Mappings;

class NroCondOcaTag extends BaseTag
{
    
    const TAG_NAME = "NroCondOca";

    public function __construct($data = [], $tagName = null) {
        parent::__construct($data);
        $this->tagName = $tagName ?? self::TAG_NAME;
    }

    public function getMap(): array
    {
        $this->item[$this->tagName] = 0;
        
        if (isset($this->data['occasionalDriver']) && $this->data['occasionalDriver'] == self::VALUE_YES) {
            $this->item[$this->tagName] = 1;
        }
        return $this->item;
    }
}