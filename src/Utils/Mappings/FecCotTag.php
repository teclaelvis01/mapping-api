<?php

namespace App\Utils\Mappings;

class FecCotTag extends BaseTag
{
    
    const TAG_NAME = "FecCot";

    public function __construct($data = [], $tagName = null) {
        parent::__construct($data);
        $this->tagName = $tagName ?? self::TAG_NAME;
    }

    public function getMap(): array
    {
        $this->item[$this->tagName] = date("c");
        return $this->item;
    }
}