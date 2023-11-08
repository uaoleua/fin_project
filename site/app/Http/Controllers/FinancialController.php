<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FinancialPlan;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialController extends Controller
{
    public function index(Request $request){

        $user = Auth::user();
$categories = Category::all();
        $startDate = Carbon::parse($request->input('start_date', Carbon::now()->startOfMonth()));
        $endDate = Carbon::parse($request->input('end_date', Carbon::now()));

        $incomes = Transaction::where('type', 'plus')
            ->where('user_id', $user->id)
            ->whereBetween('timestamp', [$startDate, $endDate])
            ->with('category')
            ->get()
            ->groupBy('category_id');

        $expenses = Transaction::where('type', 'minus')
            ->where('user_id', $user->id)
            ->whereBetween('timestamp', [$startDate, $endDate])
            ->with('category')
            ->get()
            ->groupBy('category_id');

        $financialPlans = FinancialPlan::where('user_id', $user->id)
            ->whereBetween('date', [$startDate, $endDate])
            ->with('category')
            ->get()
            ->groupBy('category_id');

        return view('financial.index', compact('incomes', 'categories', 'expenses', 'startDate', 'endDate', 'financialPlans'));

    }

}
