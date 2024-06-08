<?php

namespace App\Http\Controllers\DataDigitalization\BookKeeping;

use App\Http\Controllers\Controller;
use App\Models\AccountModel;
use App\Models\CashMutationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CashMutationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('data-digitalization.book-keeping.cash-mutation.index');
    }

    public function archived()
    {
        return view('data-digitalization.book-keeping.cash-mutation.archived');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cash_mutation_code = "CM-" . date('Ymd') . "-" . str_pad(CashMutationModel::count() + 1, 4, '0', STR_PAD_LEFT);
        $account = AccountModel::all();
        return view('data-digitalization.book-keeping.cash-mutation.create', ['account' => $account, 'cash_mutation_code' => $cash_mutation_code]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cash_mutation_code' => 'required',
            'account_sender_id' => 'required',
            'amount' => 'required',
            'account_receiver_id' => 'required',
            'description' => 'required',
        ]);

        AccountModel::find($request->account_sender_id)->update([
            'balance' => AccountModel::find($request->account_sender_id)->balance - $request->amount
        ]);

        AccountModel::find($request->account_receiver_id)->update([
            'balance' => AccountModel::find($request->account_receiver_id)->balance + $request->amount
        ]);

        CashMutationModel::create([
            'cash_mutation_code' => $request->cash_mutation_code,
            'account_sender_id' => $request->account_sender_id,
            'amount' => $request->amount,
            'account_receiver_id' => $request->account_receiver_id,
            'description' => $request->description,
            'is_archived' => false
        ]);
        return redirect('/data/bookkeeping/cash')->with('success', 'Cash Mutation has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cashMutation = CashMutationModel::find($id);
        return Aview('data-digitalization.book-keeping.cash-mutation.show', compact('cashMutation'));
    }
}
