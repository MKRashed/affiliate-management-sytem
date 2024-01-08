<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Affiliate;
use App\Models\Commition;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $userId = auth()->user()->id;

        $transactions =  Transaction::where('user_id', $userId)->get();

        // TransactionResource::wrap('transactions');

        // $data = TransactionResource::collection($transactions);

        return view('transaction.list', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
        
    public function store(Request $request)
    {

        $user = User::findOrFail(auth()->user()->id)->load('promocode.providerPromo');

        $data = $request->validate([
            'amount'        => ['required'],
            'transaction'   => ['required', 'string', 'uppercase', 'max:20'],
        ]);

        DB::transaction(function () use ( $data, $user ) {

            $transaction = Transaction::create([
                'user_id'           =>$user->id,
                'amount'           => $data['amount'],
                'transaction'      => $data['transaction'],
            ]);

            $amount = intval($data['amount']);

            if( $transaction ) {

                $affiliate =  $user->promocode->providerPromo ?? '';

                if( $affiliate && $affiliate->role === 'subaffiliate')
                {
                    $ten_percent = $amount * (10 / 100);

                    $twenty_percent = $amount * (20 / 100);


                    if($ten_percent){
                        $commition = new Commition();
                        $commition->amount = $ten_percent;
                        Affiliate::findOrFail($user->promocode->assignable_id)->commitions()->save( $commition);
                    }

                    if($twenty_percent){
                        $commition = new Commition();
                        $commition->amount = $twenty_percent;
                        $affiliate->commitions()->save($commition);
                    }


                }
                 
                if($affiliate) {
                    
                    $commition = new Commition();

                    $commition->amount = $amount * (30 / 100);

                    $affiliate->commitions()->save($commition);
                }
            }

        }, 5);

        return redirect()->back()->with([ '' => 'Money added successfully!!!' ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
