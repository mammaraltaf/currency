<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banks\DeleteBankRequest;
use App\Http\Requests\Admin\Banks\StoreBankRequest;
use App\Http\Requests\Admin\Banks\UpdateBankRequest;
use App\Models\Bank;
use App\Models\Country;
use Inertia\Inertia;
use Inertia\Response;

class BankController extends Controller
{
    public function index(): Response
    {
        $query = Bank::whereNotNull('country_id');

        if (request()->has('q') && !empty(request('q'))) {
            $search = request('q');
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->whereHas('country', function ($countryQuery) use ($search) {
                    $countryQuery->where('label', 'like', '%' . $search . '%');
                })
                ->orWhere('label', 'like', '%' . $search . '%');
            });
        }

        $banks = $query->paginate(50);

        return Inertia::render('Admin/Banks/Index', [
            'banks' => $banks,
            'countries' => Country::supportedCountries(),
        ]);
    }

    public function store(StoreBankRequest $request)
    {
        return Bank::create($request->validated());
    }

    public function update(UpdateBankRequest $request, Bank $bank): bool
    {
        return $bank->update($request->validated());
    }

    public function delete(DeleteBankRequest $request, Bank $bank): array | bool
    {
        if ($bank->delete()) {
            return ['id' => $bank->id];
        }

        return false;
    }

}
