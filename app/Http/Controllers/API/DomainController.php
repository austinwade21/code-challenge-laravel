<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Domain;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) : Response
    {
        // CODE CHALLENGE: Search Filter
        $filter = $request->get('filter');
        if(empty($filter)){
            $domains = Domain::all();
        } else {
            $domains = Domain::where('domain_name', 'like', '%'.$filter.'%')->get();
        }
        // Create HTTP response, 200 ok.
        $response = new Response($domains, Response::HTTP_OK);
        // Return HTTP response.
        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) : Response
    {
        // CODE CHALLENGE: Add Domains
        if((empty($request->post("domains")))){ 
            return new Response("Missing domains data. [domains]");
        }
        $domains = explode("\n", $request->post("domains"));
        $storedCount = 0;
        $failedCount = 0;
        foreach($domains as $domain){
            try {
                $domainObj = new Domain();
                $domainObj->domain_name = $domain;
                $domainObj->save();
                $storedCount++;
            } catch (\Throwable $th) {
                $failedCount++;
            }
        }
        $response = new Response(["stored" => $storedCount, "failed" => $failedCount], Response::HTTP_OK);
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) : Response
    {
        // CODE CHALLENGE: Toggle Imprint
        
        $domain = Domain::find($id);
        if(empty($domain)){
            return new Response('Invalid domain id!', Response::HTTP_OK);
        }
        $domain->is_imprinted = !$domain->is_imprinted;
        $domain->save();
        return new Response($domain, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id) : Response
    {
        // CODE CHALLENGE: Delete Domains
        $domain = Domain::find($id);
        if (empty($domain)) {
            return new Response('Invalid domain id!', Response::HTTP_OK);
        }
        $domain->delete();
        return new Response('Deleted successfully!');
    }
}
