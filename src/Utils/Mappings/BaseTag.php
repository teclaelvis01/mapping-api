<?php

namespace App\Utils\Mappings;

abstract class BaseTag
{
    const VALUE_YES = "YES";
    const VALUE_NO = "NO";
    protected string $tagName;
    protected array $data;
    protected mixed $value;
    protected array $item = [];

    public function __construct($data = [], string $tagName = null, $keyValue = null)
    {
        $this->data = $data;
    }

    abstract public function getMap(): array;
    
    
}