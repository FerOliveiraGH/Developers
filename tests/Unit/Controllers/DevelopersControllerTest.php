<?php

namespace Controllers;

use App\Business\DevelopersBusiness;
use App\Http\Controllers\DevelopersController;
use App\Http\Models\Developers\DevelopersModel;
use App\Http\Repositories\Developers\DevelopersRepository;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DevelopersControllerTest extends TestCase
{
    public function testGetAllDevelopers()
    {
        $controller = $this->makeController();
        $response = $controller->getAll();

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertArrayHasKey('meta_data', $content);
        $this->assertIsNumeric($content['meta_data']['current_page']);
        $this->assertIsNumeric($content['meta_data']['total']);
    }

    public function testGetOneDevelopers()
    {
        $controller = $this->makeController();

        $response = $controller->get(1);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertNotEmpty($response->getContent());

        $content = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('data', $content);
        $this->assertNotEmpty($content['data']);
        $this->assertArrayNotHasKey('meta_data', $content);
    }

    private function makeController(): DevelopersController
    {
        return new DevelopersController(new DevelopersBusiness(new DevelopersRepository(new DevelopersModel())));
    }
}
