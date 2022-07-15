# mapping-api
ck24 mapping

## Comand to use api

```bash
php bin/console app:foo-mapping </path/url/file.csv>
```

If the file csv path is incorrect trigger response error exception of file not found

Response xml as string:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<TarificacionThirdPartyRequest>
    <Datos>
        <DatosGenerales>
            <NroCondOca>0</NroCondOca>
            <CondPpalEsTomador>YES</CondPpalEsTomador>
            <ConductorUnico>NO</ConductorUnico>
            <FecCot>2022-07-15T13:40:01+00:00</FecCot>
            <AnosSegAnte>8</AnosSegAnte>
            <SeguroEnVigor>NO</SeguroEnVigor>
        </DatosGenerales>
        <DatosTomador>
            <CodActividad />
            <CodDocumento>dni</CodDocumento>
        </DatosTomador>
    </Datos>
</TarificacionThirdPartyRequest>
```

## run tests
```bash
php bin/phpunit
```