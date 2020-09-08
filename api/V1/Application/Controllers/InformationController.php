<?php

declare(strict_types = 1);

namespace Borto\Application\Controllers;

use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Order\CreateInformation;
use Borto\Domain\Order\DTOs\InformationRequestDTO;
use Borto\Domain\Order\Repositories\InformationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InformationController extends Controller
{
    use ApiResponse;

    private InformationRepository $informationRepository;
    private CreateInformation $createInformation;
    // private UpdateModel $updateModel;
    // private ReadModel $readModel;
    // private DeleteModel $deleteModel;

    public function __construct(
        InformationRepository $informationRepository,
        CreateInformation $createInformation
        // UpdateModel $updateModel,
        // ReadModel $readModel,
        // DeleteModel $deleteModel
    ) {
        $this->createInformation = $createInformation;
        // $this->updateModel = $updateModel;
        // $this->readModel = $readModel;
        // $this->deleteModel = $deleteModel;
        $this->informationRepository = $informationRepository;
    }

    public function index(int $order): JsonResponse
    {
        $informations = $this->informationRepository->getByOrderId($order);
        return $this->sendResponse($informations->toArray());
    }

    public function store(int $order, Request $request): JsonResponse
    {
        $informationData = $request->only('type', 'text');
        $informationData['order_id'] = $order;
        $informationData['user_id'] = null;

        $informationRequest = new InformationRequestDTO($informationData);
        $model = $this->createInformation->execute($informationRequest);
        return $this->sendResponse($model->toArray(), Response::HTTP_CREATED);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteInformation->handle($id);
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}
