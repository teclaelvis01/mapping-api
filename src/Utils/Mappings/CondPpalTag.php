<?php

namespace App\Utils\Mappings;

class CondPpalTag extends BaseTag
{
    
    const TAG_NAME = "CondPpalEsTomador";
    const CONDUCTOR_PRINCIPAL = "CONDUCTOR_PRINCIPAL";

    public function __construct($data = [], $tagName = null) {
        parent::__construct($data);
        $this->tagName = $tagName ?? self::TAG_NAME;
    }

    public function getMap(): array
    {
        $this->item[$this->tagName] = self::VALUE_NO;
        if (isset($this->data['holder']) && $this->data['holder'] == self::CONDUCTOR_PRINCIPAL) {
            $this->item[$this->tagName] = self::VALUE_YES;
        }
        return $this->item;
    }
}