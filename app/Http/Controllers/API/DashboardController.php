<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Domain;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stats() : Response
    {
        $stats = [
            // CODE CHALLENGE: Active Domains
            'active' => Domain::all()->count(),
            // CODE CHALLENGE: Trashed Domains
            'trash' => Domain::onlyTrashed()->count(),
            // CODE CHALLENGE: Internationalized Domains
            'internationalized' => Domain::where('is_idn', '=', 1)->count(),
            // CODE CHALLENGE: Imprinted Domains
            'imprinted' => Domain::where('is_imprinted', '=', 1)->count(),
        ];
        // Create HTTP response, 200 ok.
        $response = new Response($stats, Response::HTTP_OK);
        // Return HTTP response.
        return $response;
    }
}
