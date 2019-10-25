<?php

namespace App\Http\Controllers;

use App\Orders;
use App\UsersAnn;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Order = Orders::paginate(5);
        $json = [];
        foreach ($Order as $data) {
            //    var_dump($data['id']);
            $name = $data->user()->first()->name;
            $data->name = $name;
            // $json[]=$data;
            // $data->name=UsersAnn::find($data['id'])->name;
        }
        return $Order;
        // $Order->username=$Order->user()->get();
        // $Order= $Order->find(2)->user()->get();
        // return  $json;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $Order = Orders::find($id);
        $status = $request->status;
        if ($status != $Order->status) { 
            $Order->status=$status;
            $Order->save();
        }
        return redirect()->intended('/admin/home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
