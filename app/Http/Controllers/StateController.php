<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\State;


class StateController extends Controller
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
            'states' => State::get()
        ]);
    }

    public function store(Request $request)
    {
        dd($request);

        $validator = Validator::make($request->all(), [
            'state_name' => 'required|regex:/^[a-zA-Z\s]*$/ | regex:/^[a-zA-Z ]+$/',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation Error',
                'status' => 'Error',
                'errors' => $validator->errors()
            ], 422);
        }

        $state = new State;
        $state->state_name = $request->state_name;
        $state->save();

        return response()->json([
            'message' => 'State Created Successfully',
            'status' => 'Success',
            'data' => $state
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        return response()-> json(['post'=> $state]);
    }
}
