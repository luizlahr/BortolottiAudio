<?php

namespace Borto\Application\Controllers;

use Borto\Application\Requests\CreatePersonRequest;
use Borto\Application\Requests\UpdatePersonRequest;
use Borto\Application\Traits\ApiResponse;
use Borto\Domain\Person\CreateCustomer;
use Borto\Domain\Person\DeleteCustomer;
use Borto\Domain\Person\Entities\PersonRequestEntity;
use Borto\Domain\Person\ReadCustomer;
use Borto\Domain\Person\Repositories\PersonRepository;
use Borto\Domain\Person\UpdateCustomer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    use ApiResponse;

    private CreateCustomer $createCustomer;
    private UpdateCustomer $updateCustomer;
    private ReadCustomer $readCustomer;
    private DeleteCustomer $deleteCustomer;
    private PersonRepository $personRepository;

    public function __construct(
        CreateCustomer $createCustomer,
        UpdateCustomer $updateCustomer,
        ReadCustomer $readCustomer,
        DeleteCustomer $deleteCustomer,
        PersonRepository $personRepository
    ) {
        $this->createCustomer = $createCustomer;
        $this->updateCustomer = $updateCustomer;
        $this->readCustomer = $readCustomer;
        $this->deleteCustomer = $deleteCustomer;
        $this->personRepository = $personRepository;
    }

    public function index(): JsonResponse
    {
        $customers = $this->personRepository->getAll();
        return $this->sendResponse($customers->toArray());
    }

    public function store(CreatePersonRequest $request): JsonResponse
    {
        $customerRequest = new PersonRequestEntity($request->all());

        $customer = $this->createCustomer->execute($customerRequest);
        return $this->sendResponse($customer->toArray(), Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        $customer = $this->readCustomer->execute($id);

        return $this->sendResponse($customer->toArray());
    }

    public function update(int $id, UpdatePersonRequest $request): JsonResponse
    {
        $customerRequest = new PersonRequestEntity($request->all());

        $customer = $this->updateCustomer->execute($id, $customerRequest);
        return $this->sendResponse($customer->toArray());
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteCustomer->execute($id);
        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}
