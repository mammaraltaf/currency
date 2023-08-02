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
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function countriesPage(Request $request): Response
    {
        $sort = $request->get('column')!=null ? $request->get('column') : 'id';
        $sortType = $request->get('type')!=null ? $request->get('type') : 'asc';
        if ($sort != 'name') {
            $query = Country::orderBy($sort, $sortType);
        } else {
            $query = Country::join('currencies', 'countries.currency_id', '=', 'currencies.id')
                ->orderBy('currencies.name', $sortType)
                ->select('countries.*');
        }
        $countries = $query->paginate(25);

        return Inertia::render('Admin/Countries/Index', [
            'countries' => $countries,
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
