<?php

namespace App\Tests;

use App\Utils\Reader\ReaderCsv;
use PHPUnit\Framework\TestCase;

class ReaderCsvTest extends TestCase
{
    public function testValidateCsvWrongPath(): void
    {
        $this->expectException(\Exception::class);
        $path = '/var/www/csv-notexits.csv';
        $reader = new ReaderCsv($path);
        $this->assertSame(true,$reader->validateFileExist());
    }

    public function testValidateCsvCorrectPath(): void
    {
        $path = '/var/www/input1.csv';
        $reader = new ReaderCsv($path);
        $this->assertSame(true,$reader->validateFileExist());
    }
}
