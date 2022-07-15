<?php

namespace App\Utils\Mappings;

class SegVigTag extends BaseTag
{
    
    const TAG_NAME = "SeguroEnVigor";

    public function __construct($data = [], $tagName = null) {
        parent::__construct($data);
        $this->tagName = $tagName ?? self::TAG_NAME;
    }

    public function getMap(): array
    {
        $this->item[$this->tagName] = self::VALUE_NO;

        if (isset($this->data['prevInsurance_exists']) && $this->data['prevInsurance_exists'] == self::VALUE_YES) {
            if (isset($this->data['prevInsurance_expirationDate'])) {
                if ($this->dateIsValid($this->data['prevInsurance_expirationDate'])) {
                    $this->item[$this->tagName] = self::VALUE_YES;
                }
            }
        }
        return $this->item;
    }

    private function dateIsValid(string $strDate) {
        $date = new \DateTime($strDate);
        return $date->format('Y-m-d') > date('Y-m-d');
    }
}