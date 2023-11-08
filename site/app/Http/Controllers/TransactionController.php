<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use App\Models\FinancialPlan;
use App\Models\IncomeSource;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        $users = User::all();
        $categories = Category::all();
        $accounts = Account::all();
        $incomeSources = IncomeSource::all();
        $currencies = Currency::all();

        return view('transaction.index', compact('transactions', 'users', 'categories', 'accounts', 'incomeSources', 'currencies'));
    }

    public function create()
    {
        return view('transaction.create');
    }

    public function store(Request $request, Transaction $transaction)
    {
        $request->validate([
            'description' => 'required|string|max:250',
            'timestamp' => 'required|date',
            'amount' => 'required|numeric',
            'type' => 'required|in:plus,minus', //  'in' - перевіряє, чи введене значення знаходиться серед переліку дозволених значень.
            'user_id' => 'required|exists:users,id',
            'account_id' => 'required|exists:accounts,id',
            'category_id' => 'required|exists:categories,id',
            'income_source_id' => 'nullable|exists:income_sources,id',
            'currency_id' => 'required|exists:currencies,id',
        ]);

        if(!$transaction -> create($request->all()))
        {
            $err=$transaction->getErrors();
            return redirect()->action([Transaction::class, 'index'])->with('errors',$err)->withInput();
        }
        return redirect()->route('transaction.index')->with('message','Ваша транзакцію успішно створено!');

    }

    public function edit(Transaction $transaction)
    {
        $users = User::all();
        $categories = Category::all();
        $accounts = Account::all();
        $incomeSources = IncomeSource::all();
        $currencies = Currency::all();

        return view('transaction.edit', compact('transaction', 'users', 'categories', 'accounts', 'incomeSources', 'currencies'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'description' => 'required|string|max:250',
            'timestamp' => 'required|date',
            'amount' => 'required|numeric',
            'type' => 'required|in:plus,minus', //  'in' - перевіряє, чи введене значення знаходиться серед переліку дозволених значень.
            'user_id' => 'required|exists:users,id',
            'account_id' => 'required|exists:accounts,id',
            'category_id' => 'required|exists:categories,id',
            'income_source_id' => 'nullable|exists:income_sources,id',
            'currency_id' => 'required|exists:currencies,id',
        ]);

        if(!$transaction->update($request->all()))
        {
            $err=$transaction->getErrors();
            return redirect()->action([Transaction::class, 'edit'])->with('errors',$err)->withInput();
        }
        return redirect()->route('transaction.index')->with('message', 'Дану операцію успішно змінено!');
    }


    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transaction.index')
            ->with('message', 'Вашу операцію успішно видалено!');
    }
}
