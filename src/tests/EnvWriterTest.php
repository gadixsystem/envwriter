<?php

namespace gadixsystem\envwriter\tests;

use Tests\TestCase;
use gadixsystem\envwriter\EnvWriter;


class EnvWriterTest extends TestCase
{

    public function testChange(){

        $this->assertTrue(EnvWriter::change('new value','1234 58'));

        $this->assertFalse(EnvWriter::change('key',NULL));

        $this->assertFalse(EnvWriter::change(NULL,'value'));



    }

    public function testExists(){

        $this->assertTrue(EnvWriter::exists('new value'));

        $this->assertTrue(EnvWriter::exists('APP_KEY'));

        $this->assertFalse(EnvWriter::exists(NULL));

        $this->assertFalse(EnvWriter::exists('FAKE_KEY'));


    }

    public function testDelete(){

        $this->assertTrue(EnvWriter::delete('new value'));

        $this->assertFalse(EnvWriter::delete('new value'));

    }






}
