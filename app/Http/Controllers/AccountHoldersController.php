<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AccountHolders;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;



class AccountHoldersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd("Index");
        return response()->json([
            'AccountHolders' => AccountHolders::get()
        ]);
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
        dd($request);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required| regex:/^[a-zA-Z\s]*$/ | regex:/^[a-zA-Z ]+$/ ',
            'last_name' => 'required|numeric',
            'middle_name' => 'nullable|alpha_num',
            'contact_number' => 'required|digits:10|unique:account_holders,contact_number',
            'email' => 'required|email|unique:account_holders,email',
            'address' => 'required',
            'pin_code' => 'required|digits:6',
            'state_id' => 'required|exists:states,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'status' => 'Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $accountHolder = new AccountHolders;
        $accountHolder->first_name = $request->first_name;
        $accountHolder->last_name = $request->last_name;
        $accountHolder->middle_name = $request->middle_name;
        $accountHolder->contact_number = $request->contact_number;
        $accountHolder->email = $request->email;
        $accountHolder->address = $request->address;
        $accountHolder->pin_code = $request->pin_code;
        $accountHolder->state_id = $request->state_id;

        $accountHolder->save();
        // dd($accountHolder);

        return response()->json([
            'message' => 'Account created successfully',
            'status' => 'Success',
            'account_number' => $accountHolder
        ], 201);
        
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
    public function edit($id)
    {
        //
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
