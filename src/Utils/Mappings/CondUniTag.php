<?php

namespace App\Utils\Mappings;

class CondUniTag extends BaseTag
{
    
    const TAG_NAME = "ConductorUnico";

    public function __construct($data = [], $tagName = null) {
        parent::__construct($data);
        $this->tagName = $tagName ?? self::TAG_NAME;
    }

    public function getMap(): array
    {
        $this->item[$this->tagName] = self::VALUE_NO;
        
        if (isset($this->data['driver_children']) && $this->data['driver_children'] == self::VALUE_YES) {
            $this->item[$this->tagName] = self::VALUE_YES;
        }
        return $this->item;
    }
}