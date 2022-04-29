<?php

namespace Developers;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class LevelsTest extends TestCase
{
    public function testGetAllLevels()
    {
        $responseCreated = $this->post('/api/levels', [
            'nivel' => 'Junior',
        ]);
        $created = json_decode($responseCreated->getContent(), true);

        $response = $this->get('/api/levels');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertArrayHasKey('meta_data', $content);
        $this->assertIsNumeric($content['meta_data']['current_page']);
        $this->assertIsNumeric($content['meta_data']['total']);

        $this->delete('/api/levels/' . $created["data"]["id"]);
    }

    public function testGetOneLevel()
    {
        $responseCreated = $this->post('/api/levels', [
            'nivel' => 'Junior',
        ]);
        $created = json_decode($responseCreated->getContent(), true);

        $response = $this->get('/api/levels/' . $created['data']['id']);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertEquals($created["data"]["id"], $content['data']['id']);
        $this->assertArrayNotHasKey('meta_data', $content);

        $this->delete('/api/levels/' . $created["data"]["id"]);
    }

    public function testGetInvalidLevel()
    {
        $response = $this->get('/api/levels/0');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertEmpty($content['data']);
        $this->assertArrayNotHasKey('meta_data', $content);
    }

    public function testCreateLevel()
    {
        $response = $this->post('/api/levels', [
            'nivel' => 'Junior',
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertArrayNotHasKey('meta_data', $content);

        $this->delete('/api/levels/' . $content["data"]["id"]);
    }

    public function testUpdateLevel()
    {
        $responseCreated = $this->post('/api/levels', [
            'nivel' => 'Junior',
        ]);
        $created = json_decode($responseCreated->getContent(), true);

        $response = $this->patch('/api/levels/' . $created['data']['id'], [
            'nivel' => 'Junior 2',
        ]);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertEquals('Junior 2', $content['data']['nivel']);
        $this->assertArrayNotHasKey('meta_data', $content);

        $this->delete('/api/levels/' . $created["data"]["id"]);
    }

    public function testDeleteLevel()
    {
        $responseCreated = $this->post('/api/levels', [
            'nivel' => 'Junior',
        ]);
        $created = json_decode($responseCreated->getContent(), true);

        $response = $this->delete('/api/levels/' . $created["data"]["id"]);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);
        $this->assertNotEmpty($content['message']);
        $this->assertEquals('Level deleted with success.', $content['message']);
        $this->assertArrayNotHasKey('meta_data', $content);
    }

    public function testDeleteInvalidLevel()
    {
        $response = $this->delete('/api/levels/0');

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);
        $this->assertNotEmpty($content['message']);
        $this->assertEquals('Error delete level.', $content['message']);
        $this->assertArrayNotHasKey('meta_data', $content);
    }
}
