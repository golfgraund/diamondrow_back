<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CustomerCreateRequest;
use App\Http\Requests\API\CustomerVerifyRequest;
use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    protected string $repositoryClass = CustomerRepository::class;

    protected CustomerRepository $repository;

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function verify(CustomerVerifyRequest $request)
    {
        $validatedFields = $request->validated();

        $customer = Customer::query()->where('mail_code', $validatedFields['mail_code'])->first();

        if ($customer) {
            $customer->update(['published' => true]);

            return [
                'status' => 'success',
                'response' => ['mail_code' => ['Введен правильный код']],
                'customer_id' => $customer->id,
                'puzzle_route' => route('api.puzzle.create'),
            ];
        }

        return response([
            'status' => 'error',
            'response' => ['mail_code' => ['Введен неверный код']]
        ], 422);
    }

    public function create(CustomerCreateRequest $request)
    {
        $validatedFields = $request->validated();

        $customer = Customer::firstOrCreate(['email' => $validatedFields['email']]);

        $customer->update(['mail_code' => $this->repository->getUniquesCode()]);

        return response()->noContent(Response::HTTP_CREATED);
    }

    public function isJsonResult(): bool
    {
        return true;
    }

    public function extractJsonData($data)
    {
        return $data;
    }
}
