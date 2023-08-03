<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Countries\StoreCountryRequest;
use App\Http\Requests\Admin\Countries\UpdateCountryRequest;
use App\Models\Country;
use App\Models\Currency;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    public function countriesPage(Request $request): Response
    {
        // $query = Country::query();
        $sort = $request->get('column')!=null ? $request->get('column') : 'id';
        $sortType = $request->get('type')!=null ? $request->get('type') : 'asc';
        if ($sort != 'name') {
            $query = Country::orderBy($sort, $sortType);
        } else {
            $query = Country::join('currencies', 'countries.currency_id', '=', 'currencies.id')
                ->orderBy('currencies.name', $sortType)
                ->select('countries.*');
        }
        if (request()->has('q') && !empty(request('q'))) {
            $search = request('q');
            $query->where(function ($innerQuery) use ($search) {
                $innerQuery->where('label', 'like', '%' . $search . '%')
                    ->orWhere('can_send', 'like', '%' . $search . '%')
                    ->orWhere('can_receive', 'like', '%' . $search . '%');
            });
        }

        $countries = $query->paginate(30);

        return Inertia::render('Admin/Countries/Index', [
            'countries' => $countries,
            'currencies' => Currency::all(),
        ]);
    }

    public function store(StoreCountryRequest $request)
    {
        return Country::create($request->validated());
    }

    public function update(UpdateCountryRequest $request): bool
    {
        $country = Country::find($request->id);

        return $country->update($request->validated());
    }

}
