<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\IncomeSource;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index(){

        $accounts = Account::with(['user', 'incomeSource'])->get();

        $incomeSources = IncomeSource::all();
        $users = User::all(); // Отримуємо залогіненого користувача

        return view('account.index', compact('accounts', 'incomeSources', 'users'));
    }

    public function create()
    {
        // Повертаємо в'ю для створення нового рахунку
        return view('account.create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'account_name' => 'required|max:250',
            'balance' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'income_sources_id' => 'required|exists:income_sources,id',
        ]);

        $account = Account::create($validatedData);

        if(!$account)
        {
            $err=$account->getErrors();
            return redirect()->action([IncomeSourceController::class, 'index'])->with('errors',$err)->withInput();
        }
        return redirect()->route('account.index')->with('message','Ваш гаманець успішно створено!');
    }

    public function edit($id)
    {
        $users = User::all(); // Отримуємо залогіненого користувача
        $incomeSources = IncomeSource::all();

        $account = Account::findOrFail($id);
        return view('account.edit', compact('account', 'users', 'incomeSources'));

    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'account_name' => 'required|max:250',
            'balance' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'income_sources_id' => 'required|exists:income_sources,id',
        ]);

        $account = Account::findOrFail($id);

        if(!$account->update($validatedData))
        {
            $err=$account->getErrors();
            return redirect()->action([Account::class, 'edit'])->with('errors',$err)->withInput();
        }
        return redirect()->route('account.index')->with('message', 'Гаманець успішно змінено!');

    }

    public function destroy(Account $account)
    {
        $account->delete();

        return redirect()->route('account.index')->with('message', 'Ваш гаманець успішно видалено!');
    }
}
