<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getDistricts($provinceId)
    {
        $response = Http::get("https://api.example.com/provinces/{$provinceId}/districts");
        return response()->json($response->json());
    }

    public function getWards($districtId)
    {
        $response = Http::get("https://api.example.com/districts/{$districtId}/wards");
        return response()->json($response->json());
    }
}
