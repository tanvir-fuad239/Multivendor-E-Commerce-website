<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cupon;
use Carbon\Carbon;
use App\Http\Requests\Cupon\CuponStoreRequest;
use App\Http\Requests\Cupon\CuponUpdateRequest;


class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cupons = Cupon::latest()->get();
        return view('backend.cupon.list', compact('cupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.cupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CuponStoreRequest $request)
    {
     
        $valid_from             =       Carbon::parse($request->valid_from)->format('Y-m-d H:i:s');
        $expire_at              =       Carbon::parse($request->expire_at)->format('Y-m-d H:i:s');

        $cupon = new Cupon([
            'code'              =>      $request->cupon_code,
            'amount'            =>      $request->cupon_amount,
            'type'              =>      $request->cupon_type,
            'minimum_amount'    =>      $request->min_amount,
            'usage_limit'       =>      $request->usage_limit,
            'used'              =>      $request->used_limit,
            'valid_from'        =>      $valid_from,
            'expires_at'        =>      $expire_at,
            'status'            =>      1
        ]);

        if($cupon->save()){
            return redirect()->route('admin.cupons.index')->with('message', "Cupon created successfully");
        }
        else{
            return back()->with('error', "Cupon couldn't be created.Please try again later.");
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cupon = Cupon::findOrFail($id);

        return view('backend.cupon.edit', compact('cupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CuponUpdateRequest $request, string $id)
    {
        
        $cupon                  =           Cupon::where('id', $id)->firstOrFail();
        $valid_from             =           Carbon::parse($request->valid_from)->format('Y-m-d H:i:s');
        $expire_at              =           Carbon::parse($request->expire_at)->format('Y-m-d H:i:s');

        $updatedCupon           =           $cupon->update([
                                                'code'              =>      $request->cupon_code,
                                                'amount'            =>      $request->cupon_amount,
                                                'type'              =>      $request->cupon_type,
                                                'minimum_amount'    =>      $request->min_amount,
                                                'usage_limit'       =>      $request->usage_limit,
                                                'used'              =>      $request->used_limit,
                                                'valid_from'        =>      $valid_from,
                                                'expires_at'        =>      $expire_at,
                                                'updated_at'        =>      now()
                                            ]);

        if($updatedCupon){
            return redirect()->route('admin.cupons.index')->with('message', "Cupon updated successfully");
        }
        else{
            return back()->with('error', "Cupon couldn't be updated.Please try again later.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $cupon = Cupon::findOrFail($id);

        if($cupon->delete()){
            return redirect()->route('admin.cupons.index')->with('message', "Cupon deleted successfully.");
        }
        else{
            return back()->with('error', "Cupon couldn't be deleted.Please try again later.");
        }

    }

    // cupon active inactive toggle 
    public function cuponToggle($cuponId){

        $cupon                          =       Cupon::findOrFail($cuponId);
        $cupon->status                  =       $cupon->status == 1 ? 0 : 1;

        if($cupon->save()){
            $data['status']             =       $cupon->status;
            return  $data;
        }
        else{
            $data['error']              =       "There occurs an error.Please try again later.";
            return  $data;
        }
    }
}
