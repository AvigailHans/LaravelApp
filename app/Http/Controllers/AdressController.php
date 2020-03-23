<?php

namespace App\Http\Controllers;
use App\Http\Resources\Address as AddressResource;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\address;
use DB;
class AdressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $data= address::whereNotNull('street')->get();
        return  AddressResource::collection($data);
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
       
       $data=address::findOrFail($request->input('id'));
       $data->fill($request->all());
       $data->save();
       return $data;
       
    }
    
}
