<?php

namespace App\Utils\Mappings;

class Mapper
{

    /**
     * 
     * @param BaseTag[] $data 
     * @return array 
     */
    public function generateMap($data): array
    {
        $mappings = [];
        foreach ($data as $key => $value) {
            $mappings[] = $value->getMap();
        }
        // join all arrays
        return  array_merge(...$mappings);
    }
}
