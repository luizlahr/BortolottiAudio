<?php

namespace Borto\Application\Controllers;

use Borto\Application\Requests\CreatePersonRequest;
use Borto\Application\Requests\UpdatePersonRequest;
use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Person\CreateSupplier;
use Borto\Domain\Person\DeleteSupplier;
use Borto\Domain\Person\Entities\PersonRequestEntity;
use Borto\Domain\Person\ListSupplier;
use Borto\Domain\Person\ReadSupplier;
use Borto\Domain\Person\Repositories\PersonRepository;
use Borto\Domain\Person\UpdateSupplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SupplierController extends Controller
{
    use ApiResponse;

    private ListSupplier $listSupplier;
    private CreateSupplier $createSupplier;
    private UpdateSupplier $updateSupplier;
    private ReadSupplier $readSupplier;
    private DeleteSupplier $deleteSupplier;
    private PersonRepository $personRepository;

    public function __construct(
        ListSupplier $listSupplier,
        CreateSupplier $createSupplier,
        UpdateSupplier $updateSupplier,
        ReadSupplier $readSupplier,
        DeleteSupplier $deleteSupplier,
        PersonRepository $personRepository
    ) {
        $this->listSupplier = $listSupplier;
        $this->createSupplier = $createSupplier;
        $this->updateSupplier = $updateSupplier;
        $this->readSupplier = $readSupplier;
        $this->deleteSupplier = $deleteSupplier;
        $this->personRepository = $personRepository;
    }

    public function index(): JsonResponse
    {
        $suppliers = $this->listSupplier->execute();
        return $this->sendResponse($suppliers->toArray());
    }

    public function store(CreatePersonRequest $request): JsonResponse
    {
        $supplierRequest = new PersonRequestEntity($request->all());
        $supplierRequest->setSupplier();

        $supplier = $this->createSupplier->execute($supplierRequest);
        return $this->sendResponse($supplier->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $supplier = $this->readSupplier->execute($id);
        return $this->sendResponse($supplier->toArray());
    }

    public function update(int $id, UpdatePersonRequest $request): JsonResponse
    {
        $supplierRequest = new PersonRequestEntity($request->all());
        $supplierRequest->setSupplier();

        $supplier = $this->updateSupplier->execute($id, $supplierRequest);
        return $this->sendResponse($supplier->toArray());
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteSupplier->execute($id);
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}
