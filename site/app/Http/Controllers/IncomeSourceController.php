<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\IncomeSource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncomeSourceController extends Controller
{
    public function index(){

        $incomeSources = IncomeSource::all();
        $users = User::all(); // Отримуємо залогіненого користувача

        return view('incomeSource.index', compact('incomeSources','users'));
    }


    public function create() {

        return view('incomeSource.create');
    }

    public function store(Request $request, IncomeSource $incomeSource) {

        $request->validate([
            'income_sources_name' => 'required|unique:income_sources,income_sources_name|max:250',
            'user_id' => 'required|exists:users,id',
        ]);

        if(!$incomeSource->create($request->all()))
        {
            $err=$incomeSource->getErrors();
            return redirect()->action([IncomeSourceController::class, 'index'])->with('errors',$err)->withInput();
        }
        return redirect()->route('incomeSource.index')->with('message','Ваше джерело доходу було успішно створено!');
    }

    public function edit(IncomeSource $incomeSource)
    {
        $users = User::all(); // Отримуємо залогіненого користувача
        return view('incomeSource.edit', compact('incomeSource', 'users'));
    }

    public function update(Request $request, IncomeSource $incomeSource)
    {
        $request->validate([
            'income_sources_name' => 'required|unique:income_sources,income_sources_name|max:250',
            'user_id' => 'required|exists:users,id',
        ]);

        if(!$incomeSource->update($request->all()))
        {
            $err=$incomeSource->getErrors();
            return redirect()->action([IncomeSource::class, 'edit'])->with('errors',$err)->withInput();
        }
        return redirect()->route('incomeSource.index')->with('message','Джерело доходу успішно змінено!');
    }

    public function destroy(IncomeSource $incomeSource)
    {
        $incomeSource->delete();

        return redirect()->route('incomeSource.index')->with('message', 'Джерело доходу успішно видалено!');
    }
}
