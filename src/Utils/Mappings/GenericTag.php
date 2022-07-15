<?php

namespace App\Utils\Mappings;

class GenericTag extends BaseTag
{
    

    public function __construct($data = [], string $tagName = null, $keyValue = null) {
        parent::__construct($data);
        $this->tagName = $tagName;
        $this->value = $data[$keyValue] ?? null;
    }

    public function getMap(): array
    {
        $this->item[$this->tagName] = $this->value;
        return $this->item;
    }
}