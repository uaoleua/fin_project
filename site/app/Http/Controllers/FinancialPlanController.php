<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Currency;
use App\Models\FinancialPlan;
use App\Models\User;
use Illuminate\Http\Request;

class FinancialPlanController extends Controller
{
    public function index()
    {
        $financialPlans = FinancialPlan::all();

        $users = User::all();
        $categories = Category::all();
        $currencies = Currency::all();

        return view('financialPlan.index', compact('financialPlans', 'users', 'categories', 'currencies'));
    }

    public function create()
    {
        // Повертаємо в'ю для створення нового рахунку
        return view('financialPlan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'currency_id' => 'required|exists:currencies,id',
        ]);

        $financialPlan = FinancialPlan::create($validatedData);

        if(!$financialPlan)
        {
            $err=$financialPlan->getErrors();
            return redirect()->action([FinancialPlan::class, 'index'])->with('errors',$err)->withInput();
        }
        return redirect()->route('financialPlan.index')->with('message','Ваш фінансовий план успішно створено!');

    }

    public function edit(FinancialPlan $financialPlan)
    {
        $users = User::all();
        $categories = Category::all();
        $currencies = Currency::all();

        return view('financialPlan.edit', compact('financialPlan', 'users', 'categories', 'currencies'));
    }

    public function update(Request $request, FinancialPlan $financialPlan)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'currency_id' => 'required|exists:currencies,id',
        ]);

        if(!$financialPlan->update($validatedData))
        {
            $err=$financialPlan->getErrors();
            return redirect()->action([FinancialPlan::class, 'edit'])->with('errors',$err)->withInput();
        }

        return redirect()->route('financialPlan.index')->with('message', 'Фінансовий план успішно змінено!');
    }

    public function destroy(FinancialPlan $financialPlan)
    {
        $financialPlan->delete();
        return redirect()->route('financialPlan.index')->with('message', 'Ваш фінансовий план успішно видалено!');;
    }
}
