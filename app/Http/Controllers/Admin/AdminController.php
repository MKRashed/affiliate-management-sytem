<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $affiliate_user_commition = Affiliate::whereHas('commitions')
        ->get()
        ->map(function ($user) {
            $total_amount = $user->commitions->sum('amount'); 
            $user->total_amount = $total_amount;
            return $user;
        });

        $user_add_money = User::whereHas('addMoney')
        ->get()
        ->map(function ($user) {
            $total_amount = $user->addMoney->sum('amount'); 
            $user->total_amount = $total_amount;
            return $user;
        });

       return view('admin.dashboard', compact(['user_add_money','affiliate_user_commition']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
