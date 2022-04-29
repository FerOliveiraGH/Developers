<?php

namespace App\Http\Controllers;

use App\Business\LevelsBusiness;
use App\Exceptions\BusinessException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LevelsController extends BaseController
{
    private LevelsBusiness $business;

    public function __construct(LevelsBusiness $business)
    {
        $this->business = $business;
    }

    public function getAll(Request $request): JsonResponse
    {
        $response = $this->business->getAll($request->all());

        return $this->createResponse('Levels get with success.', $response);
    }

    public function get(int $id): JsonResponse
    {
        $response = $this->business->get($id);

        return $this->createResponse('Level get with success.', $response);
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $this->validate($request,[
                'nivel' => 'required|string'
            ]);

            return $this->createResponse(
                'Level created with success.',
                $this->business->create($request->all()),
                Response::HTTP_CREATED
            );
        } catch (ValidationException $e) {
            return $this->createResponseErrors($e->getMessage(), $e->errors(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $this->validate($request,[
                'nivel' => 'string'
            ]);

            return $this->createResponse(
                'Level updated with success.',
                $this->business->update($id, $request->all())
            );
        } catch (BusinessException $e) {
            return $this->createResponseErrors($e->getMessage(), [], Response::HTTP_BAD_REQUEST);
        } catch (ValidationException $e) {
            return $this->createResponseErrors($e->getMessage(), $e->errors(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function delete(int $id): JsonResponse
    {
        try {
            $this->business->delete($id);

            return $this->createResponse('Level deleted with success.');
        } catch (Exception $e) {
            return $this->createResponseErrors($e->getMessage(), [], Response::HTTP_BAD_REQUEST);
        }
    }
}
