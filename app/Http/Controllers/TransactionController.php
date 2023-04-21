<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\AccountHolders;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'AccountHolders' => Transaction::get()
        ]);
    }

    public function getAccountHolders() {
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
       
        // Validate the request data
        $validatedData = $request->validate([
            'account_number' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'amount' => 'required|integer',
            'transaction_type' => 'required',
        ]);
       

        // Get the account holder by account number
        $accountHolder = AccountHolders::where('account_number', $validatedData['account_number'])->first();

        // Throw an error if the account holder is not found
        if (!$accountHolder) {
            return response()->json(['error' => 'Account holder not found'], 404);
        }
        // dd($validatedData);
        // Update the balance based on transaction type
        if ($validatedData['transaction_type'] == 1) {
            // dd("deposite");
            $accountHolder->amount_balance += $validatedData['amount'];
        } else if ($validatedData['transaction_type'] == 2) {
            // dd("withdraw");
            $accountHolder->amount_balance -= $validatedData['amount'];
            // Throw an error if the account holder has insufficient balance for a withdrawal
            if ($accountHolder->amount_balance < $validatedData['amount']) {
                return response()->json(['error' => 'Insufficient Balance'], 422);
            }
        } else {
            // dd("Please Enter valid Transaction Type");
            // Throw an error if transaction type is invalid
            return response()->json(['error' => 'Please Enter valid Transaction Type'], 422);
        }
        

        // Update the account holder's balance
        $accountHolder->save();


        // Create the transaction record
        $transaction = new Transaction;

        $transaction->account_number = $validatedData['account_number'];
        $transaction->date = $validatedData['date'];
        $transaction->amount = $validatedData['amount'];
        $transaction->transaction_type = $validatedData['transaction_type'];
        // dd($transaction);
        $transaction->save();
        // dd('hi');

        // Return the transaction as a response
        return response()->json([
            'message' => 'Balance Updated successfully',
            'status' => 'Success',
            'account_number' => $transaction
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
