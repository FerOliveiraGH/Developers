<?php

namespace Developers;

use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DevelopersTest extends TestCase
{
    public function testGetAllDevelopers()
    {
        $responseCreated = $this->post('/api/developers', [
            'nivel_id' => 1,
            'nome' => 'Developers Test',
            'sexo' => 'M',
            'data_nascimento' => '1990-01-01',
            'idade' => 32,
            'hobby' => 'Gamer',
        ]);
        $created = json_decode($responseCreated->getContent(), true);

        $response = $this->get('/api/developers');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertArrayHasKey('meta_data', $content);
        $this->assertIsNumeric($content['meta_data']['current_page']);
        $this->assertIsNumeric($content['meta_data']['total']);

        $this->delete('/api/developers/' . $created["data"]["id"]);
    }

    public function testGetOneDeveloper()
    {
        $responseCreated = $this->post('/api/developers', [
            'nivel_id' => 1,
            'nome' => 'Developers Test',
            'sexo' => 'M',
            'data_nascimento' => '1990-01-01',
            'idade' => 32,
            'hobby' => 'Gamer',
        ]);
        $created = json_decode($responseCreated->getContent(), true);

        $response = $this->get('/api/developers/' . $created['data']['id']);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertEquals($created["data"]["id"], $content['data']['id']);
        $this->assertArrayNotHasKey('meta_data', $content);

        $this->delete('/api/developers/' . $created["data"]["id"]);
    }

    public function testGetInvalidDeveloper()
    {
        $response = $this->get('/api/developers/0');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertEmpty($content['data']);
        $this->assertArrayNotHasKey('meta_data', $content);
    }

    public function testCreateDeveloper()
    {
        $response = $this->post('/api/developers', [
            'nivel_id' => 1,
            'nome' => 'Developers Test',
            'sexo' => 'M',
            'data_nascimento' => '1990-01-01',
            'idade' => 32,
            'hobby' => 'Gamer',
        ]);

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertArrayNotHasKey('meta_data', $content);

        $this->delete('/api/developers/' . $content["data"]["id"]);
    }

    public function testUpdateDeveloper()
    {
        $responseCreated = $this->post('/api/developers', [
            'nivel_id' => 1,
            'nome' => 'Developers Test',
            'sexo' => 'M',
            'data_nascimento' => '1990-01-01',
            'idade' => 32,
            'hobby' => 'Gamer',
        ]);
        $created = json_decode($responseCreated->getContent(), true);

        $response = $this->patch('/api/developers/' . $created['data']['id'], [
            'nome' => 'Developers Test 2',
        ]);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertEquals('Developers Test 2', $content['data']['nome']);
        $this->assertArrayNotHasKey('meta_data', $content);

        $this->delete('/api/developers/' . $created["data"]["id"]);
    }

    public function testDeleteDeveloper()
    {
        $responseCreated = $this->post('/api/developers', [
            'nivel_id' => 1,
            'nome' => 'Developers Test',
            'sexo' => 'M',
            'data_nascimento' => '1990-01-01',
            'idade' => 32,
            'hobby' => 'Gamer',
        ]);
        $created = json_decode($responseCreated->getContent(), true);

        $response = $this->delete('/api/developers/' . $created["data"]["id"]);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);
        $this->assertNotEmpty($content['message']);
        $this->assertEquals('Developer deleted with success.', $content['message']);
        $this->assertArrayNotHasKey('meta_data', $content);
    }

    public function testDeleteInvalidDeveloper()
    {
        $response = $this->delete('/api/developers/0');

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $content);
        $this->assertNotEmpty($content['message']);
        $this->assertEquals('Error delete developer.', $content['message']);
        $this->assertArrayNotHasKey('meta_data', $content);
    }
}
