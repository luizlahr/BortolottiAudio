<?php

declare(strict_types = 1);

namespace Borto\Application\Controllers;

use Borto\Application\Requests\CreateInformationRequest;
use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Order\DTOs\InformationRequestDTO;
use Borto\Domain\Order\Information\CreateInformation;
use Borto\Domain\Order\Information\DeleteInformation;
use Borto\Domain\Order\Information\Entities\InformationEntity;
use Borto\Domain\Order\Information\ListInformation;
use Borto\Domain\Order\Information\Repositories\InformationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class InformationController extends Controller
{
    use ApiResponse;

    private InformationRepository $informationRepository;
    private ListInformation $listInformation;
    private CreateInformation $createInformation;
    private DeleteInformation $deleteInformation;

    public function __construct(
        InformationRepository $informationRepository,
        ListInformation $listInformation,
        CreateInformation $createInformation,
        DeleteInformation $deleteInformation
    ) {
        $this->createInformation = $createInformation;
        $this->deleteInformation = $deleteInformation;
        $this->informationRepository = $informationRepository;
    }

    public function index(int $order): JsonResponse
    {
        $informations = $this->listInformation->execute($order);
        return $this->sendResponse($informations->toArray());
    }

    public function store(int $order, CreateInformationRequest $request): JsonResponse
    {
        $informationData = $request->only('text');
        $informationData['type'] = InformationEntity::TYPE_USER;
        $informationData['order_id'] = $order;
        $informationData['user_id'] = null;

        $informationRequest = new InformationRequestDTO($informationData);
        $model = $this->createInformation->execute($informationRequest);
        return $this->sendResponse($model->toArray(), Response::HTTP_CREATED);
    }

    public function destroy(int $order, int $information): JsonResponse
    {
        $this->deleteInformation->execute($information);
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}
