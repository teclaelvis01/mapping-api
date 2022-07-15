<?php

namespace App\Tests;

use App\Integrations\FooInsuranceApi;
use App\Utils\Reader\ReaderCsv;
use App\Utils\Xml\XmlOutput;
use PHPUnit\Framework\TestCase;

class FooInsuranceApiTest extends TestCase
{
    public function testValidateCsvInput1Ok(): void
    {

        $xmlEspected = XmlOutput::getPlainText('<?xml version="1.0" encoding="UTF-8"?>
        <TarificacionThirdPartyRequest>
            <Datos>
                <DatosGenerales>
                    <NroCondOca>0</NroCondOca>
                    <CondPpalEsTomador>YES</CondPpalEsTomador>
                    <ConductorUnico>NO</ConductorUnico>
                    <FecCot>' . date("c") . '</FecCot>
                    <AnosSegAnte>0</AnosSegAnte>
                    <SeguroEnVigor>NO</SeguroEnVigor>
                </DatosGenerales>
                <DatosTomador>
                    <CodActividad />
                    <CodDocumento>dni</CodDocumento>
                </DatosTomador>
            </Datos>
        </TarificacionThirdPartyRequest>
        ');
        $path = '/var/www/input1.csv';
        $reader = new ReaderCsv($path);
        $dataIput = $reader->readFile();

        $fooApi = new FooInsuranceApi($dataIput);
        
        $this->expectOutputString($xmlEspected);
        print XmlOutput::getPlainText($fooApi->responseAsString());
    }
    public function testValidateCsvInput2Ok(): void
    {

        $xmlEspected = XmlOutput::getPlainText('<?xml version="1.0" encoding="UTF-8"?>
        <TarificacionThirdPartyRequest>
            <Datos>
                <DatosGenerales>
                    <NroCondOca>0</NroCondOca>
                    <CondPpalEsTomador>YES</CondPpalEsTomador>
                    <ConductorUnico>NO</ConductorUnico>
                    <FecCot>' . date("c") . '</FecCot>
                    <AnosSegAnte>8</AnosSegAnte>
                    <SeguroEnVigor>NO</SeguroEnVigor>
                </DatosGenerales>
                <DatosTomador>
                    <CodActividad />
                    <CodDocumento>dni</CodDocumento>
                </DatosTomador>
            </Datos>
        </TarificacionThirdPartyRequest>
        ');
        $xmlEspected = str_replace("\n", "", $xmlEspected);
        $xmlEspected = str_replace(" ", "", $xmlEspected);
        $path = '/var/www/input2.csv';
        $reader = new ReaderCsv($path);
        $dataIput = $reader->readFile();

        $fooApi = new FooInsuranceApi($dataIput);
        
        $this->expectOutputString($xmlEspected);
        print XmlOutput::getPlainText($fooApi->responseAsString());
    }
}
