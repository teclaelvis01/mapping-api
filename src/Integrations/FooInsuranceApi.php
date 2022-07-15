<?php

namespace App\Integrations;

use App\Utils\Interfaces\ApiInterface;
use App\Utils\Mappings\CondPpalTag;
use App\Utils\Mappings\AnosSegTag;
use App\Utils\Mappings\CondUniTag;
use App\Utils\Mappings\FecCotTag;
use App\Utils\Mappings\GenericTag;
use App\Utils\Mappings\Mapper;
use App\Utils\Mappings\NroCondOcaTag;
use App\Utils\Mappings\SegVigTag;
use App\Utils\Xml\XmlOutput;

/** @package App\Integrations */
class FooInsuranceApi implements ApiInterface
{
    /**
     * @var array $data
     */
    private $data;

    public $tags = [];

    public function __construct(array $inputs)
    {
        $this->data = $inputs;
        $this->factoryData();
    }

    private function factoryData(): array
    {
        $this->tags[] = new NroCondOcaTag($this->data);
        $this->tags[] = new CondPpalTag($this->data);
        $this->tags[] = new CondUniTag($this->data);
        $this->tags[] = new FecCotTag($this->data);
        $this->tags[] = new AnosSegTag($this->data);
        $this->tags[] = new SegVigTag($this->data);

        $mapper = new Mapper();
        $arrayMap = $mapper->generateMap($this->tags);

        $array = [
            "TarificacionThirdPartyRequest" => [
                "Datos" => [
                    "DatosGenerales" => $arrayMap,
                    "DatosTomador" => $mapper->generateMap([
                        new GenericTag($this->data,'CodActividad'),
                        new GenericTag($this->data,'CodDocumento', 'driver_idType'),
                    ])
                ]
            ]
        ];

        return $array;
    }

    public function responseAsString(): string
    {
        $output = new XmlOutput($this->factoryData());
        return $output->getXml();
    }
}
