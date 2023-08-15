<?php

namespace App\Http\Controllers;

use App\Classes\GeoLocation;
use App\Classes\Twilio;
use App\Classes\UniqueNumberGenerator;
use App\Http\Requests\UserInfoRequest;
use App\Mail\EmailCodeGenerated;
use App\Models\Commission;
use App\Models\Country;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;
use JetBrains\PhpStorm\ArrayShape;
use App\Http\Requests\PaymentInformationRequest;

class UsersController extends Controller
{

    public function userInfoPage()
    {
        $locationDetails = GeoLocation::getCurrentUserLocationDetails();
        $commissions = Commission::all();

        if (!Country::isSupportingSending($locationDetails['country_code'])) {
            return redirect(route('available.posts.page'));
        }
        $receivingCountries = Country::receivingCountries();
        return Inertia::render('Transaction/UserInfo', compact('receivingCountries', 'commissions'));
    }

    #[ArrayShape(['status' => "string", 'user' => "\App\Http\Requests\UserInfoRequest"])]
    public function validateUserInfo(UserInfoRequest $userInfoRequest): array
    {
        $verificationCode = UniqueNumberGenerator::generate();

        Cache::put("{$userInfoRequest->ip()}_email_code", $verificationCode, now()->addMinutes(10));

        Mail::to($userInfoRequest->email)->queue(new EmailCodeGenerated($verificationCode));

        if (app()->environment() === 'production') Twilio::sendVerificationCode($userInfoRequest->phone);

        Log::info($verificationCode);

        User::putUserIntoSession($userInfoRequest->toArray());
        return [
            'status' => 'success',
            'user' => $userInfoRequest
        ];
    }

}
