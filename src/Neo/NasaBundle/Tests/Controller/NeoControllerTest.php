<?php

namespace Neo\NasaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NeoControllerTest extends WebTestCase
{
    public function testHazardous()
    {
        $client = static::createClient();
        $client->request('GET', '/neo/hazardous');

        $content = $client->getResponse()->getContent();

        if ($content == "[]") {
            $this->markTestSkipped("Data not added yet");
        }

        $this->assertJson($content);
        $this->assertContains('"is_potentially_hazardous_asteroid":true', $content);
        $this->assertNotContains('"is_potentially_hazardous_asteroid":false', $content);
        $this->assertContains('neo_reference_id', $content);
        $this->assertContains('date', $content);
        $this->assertContains('name', $content);
        $this->assertContains('kilometers_per_hour', $content);
    }

    public function testFastest()
    {
        $client = static::createClient();
        $client->request('GET', '/neo/fastest');

        $content = $client->getResponse()->getContent();

        if ($content == "[]") {
            $this->markTestSkipped("Data not added yet");
        }

        $this->assertJson($content);
        $this->assertEquals(1, substr_count($content, 'is_potentially_hazardous_asteroid'));
        $this->assertEquals(1, substr_count($content, 'neo_reference_id'));
        $this->assertEquals(1, substr_count($content, 'date'));
        $this->assertEquals(1, substr_count($content, 'name'));
        $this->assertEquals(1, substr_count($content, 'kilometers_per_hour'));
    }
}
