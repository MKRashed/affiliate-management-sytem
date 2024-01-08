<?php

namespace App\Http\Controllers\Affiliate;

use App\Constants\UserType;
use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\Commition;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

     $own_commitions = Affiliate::findOrFail(auth()->user()->id)->load('commitions:id,commitionable_id,amount,created_at');

     $data = [];

     if($own_commitions->role === 'affiliate'){

        $childs = Promocode::where('assignable_id' , $own_commitions->id)
        ->with('providerPromo.commitions:id,commitionable_id,amount,created_at')
        ->get()->toArray();

        foreach($childs  as $child)
        {
           $data[] = $child['provider_promo'];
        }
     }
     return view('affiliate.dashboard', compact(['own_commitions','data']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('affiliate.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Affiliate::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::transaction(function () use ( $data ) {

            $auth_affiliate = Affiliate::findOrFail(auth()->user()->id);

            $affiliate  = Affiliate::create([
                'name'           => $data['name'],
                'email'          => $data['email'],
                'role'           => UserType::SUBAFFILIATE,
                'password'       => Hash::make($data['password']),
            ]);

    
            if( $affiliate ) {
                $promocode              = new Promocode();
                $promocode->affiliate_id = $affiliate->id;
                $promocode->code          = $this->generateRandomCode(8);
                $auth_affiliate->promocodes()->save($promocode);
            }
        }, 5);

        return response()->json([ 'message' => 'Successfully Created a record !!']);
    
        // $affiliate = Affiliate::create([
        //     'name'              => $request->name,
        //     'email'             => $request->email,
        //     'role'              => UserType::SUBAFFILIATE,
        //     'password'          => Hash::make($request->password),
        // ]);

        // if( $affiliate ) {
        //     Promocode::create([
        //         'created_by'    => auth()->user()->id,
        //         'affiliate_id'  => $affiliate->id,
        //         'code'          => $this->generateRandomCode(8),
        //     ]);

           
        // }

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

    private function generateRandomCode($length = 8) {

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $code = '';
        $charLength = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, $charLength - 1)];
        }
    
        return $code;
    }
}
