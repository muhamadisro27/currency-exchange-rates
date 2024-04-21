<?php

namespace App\Http\Controllers;

use App\Models\CurrencyRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    //

    public function index()
    {
        // if(auth()->user()->roles->pluck('name')[0] == 'admin') {
        //     $this->fetch_data();
        // }

        $rates = CurrencyRate::query()->orderBy('rate', 'desc')->get();

        return view('dashboard', compact('rates'));
    }

    public function data_table()
    {

    }

    public function fetch_data()
    {
        $response = [];
        try {

            $rates = Http::get(env('CREDENTIAL_API_CURRENCY'));

            switch ($rates->status()) {
                case 200:
                    $response = [
                        'status' => 200,
                        'message' => 'Success fetching data !'
                    ];

                    DB::beginTransaction();

                    foreach(json_decode($rates->body(),true)['rates'] as $currency => $rate) {
                        CurrencyRate::updateOrCreate([
                            'currency' => $currency,
                            'rate' => $rate
                        ]);
                    }

                    DB::commit();

                    break;
                case 401:
                    $response = [
                        'status' => 401,
                        'message' => 'Unauthorized !'
                    ];

                    break;
                default:
                    DB::rollBack();
                    $response = [
                        'status' => 400,
                        'message' => 'Error while fetching data !'
                    ];
                    break;
            }

        } catch (\Throwable $th) {
            $response = [
                'status' => 400,
                'message' => $th->getMessage()
            ];
        }
    }
}
