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
use Illuminate\Http\Request;


class BankController extends Controller
{
    public function index(Request $request): Response
    {
        $sort =  $request->get('column')?$request->get('column') : 'id';
        $sortType =$request->get('type')?$request->get('type') : 'asc';
        if ($sort != 'country') {

            $query = Bank::orderBy($sort, $sortType);
        } else {
            $query = Bank::join('countries', 'banks.country_id', '=', 'countries.id')
                ->orderBy('countries.label', $sortType)
                ->select('banks.*');
        }

        $banks = $query->paginate(25);
        return Inertia::render('Admin/Banks/Index', [
            'banks' => $banks,
            'countries' => Country::supportedCountries(),
        ]);
    }

    public function store(StoreBankRequest $request){
        return Bank::create($request->validated());
    }

    public function update(UpdateBankRequest $request, Bank $bank): bool
    {
        return $bank->update($request->validated());
    }

    public function delete(DeleteBankRequest $request, Bank $bank): array|bool
    {
        if($bank->delete()){
            return ['id' => $bank->id];
        }

        return false;
    }

}
