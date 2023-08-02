<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Countries\DeleteCountryRequest;
use App\Http\Requests\Admin\Countries\StoreCountryRequest;
use App\Http\Requests\Admin\Countries\UpdateCountryRequest;
use App\Models\Country;
use App\Models\Currency;
use Inertia\Inertia;
use Inertia\Response;
use PHPUnit\Framework\Constraint\Count;

class CountriesController extends Controller
{
    public function countriesPage(): Response
    {
        return Inertia::render('Admin/Countries/Index', [
            'countries' => Country::paginate(30),
            'currencies' => Currency::all(),
        ]);
    }


    public function store(StoreCountryRequest $request){
        return Country::create($request->validated());
    }

    public function update(UpdateCountryRequest $request): bool
    {
        $country = Country::find($request->id);

        return $country->update($request->validated());
    }

}
