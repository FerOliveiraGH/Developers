<?php

namespace App\Http\Controllers;

use App\Business\DevelopersBusiness;
use App\Exceptions\BusinessException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class DevelopersController extends BaseController
{
    protected DevelopersBusiness $business;

    public function __construct(DevelopersBusiness $business)
    {
        $this->business = $business;
    }

    public function getAll(): JsonResponse
    {
        return $this->createResponse('Developers get with success.', $this->business->getAll());
    }

    public function get(int $id): JsonResponse
    {
        return $this->createResponse('Developer get with success.', $this->business->get($id));
    }

    public function create(Request $request): JsonResponse
    {
        try {
            $this->validate($request,[
                'nivel_id' => 'required|integer|exists:levels,id',
                'nome' => 'required|string',
                'sexo' => 'required|string|in:F,M,O',
                'data_nascimento' => 'required|date',
                'idade' => 'required|numeric',
                'hobby' => 'required|string',
            ]);

            return $this->createResponse(
                'Developer created with success.',
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
                'nivel_id' => 'numeric|exists:levels,id',
                'nome' => 'string',
                'sexo' => 'string|in:F,M,O',
                'data_nascimento' => 'date',
                'idade' => 'numeric',
                'hobby' => 'string',
            ]);

            return $this->createResponse(
                'Developer updated with success.',
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

            return $this->createResponse('Developer deleted with success.');
        } catch (Exception $e) {
            return $this->createResponseErrors($e->getMessage(), [], Response::HTTP_BAD_REQUEST);
        }
    }
}
