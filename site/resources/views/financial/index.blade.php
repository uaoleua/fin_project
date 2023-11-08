@extends('layouts.home')
@section('title', 'Financial')

@section('menu')
    @parent
@endsection

@section('content')
    <div class="container text-center" style="margin: 50px auto">
        <h4>Фінансовий звіт</h4>
        <form action="{{ url('/financial') }}" method="GET" style=" margin: 50px auto">
            <input type="date" name="start_date" value="{{ $startDate->toDateString() }}">
            <input type="date" name="end_date" value="{{ $endDate->toDateString() }}">
            <button type="submit">Фільтрувати</button>
        </form>
        <div class="row">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Категорія</th>
                            <th>Витрати</th>
                            <th>Доходи</th>
                            <th>План</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        @php
                            $categoryIncomes = $incomes[$category->id] ?? collect();
                            $categoryExpenses = $expenses[$category->id] ?? collect();
                            $categoryPlans = $financialPlans[$category->id] ?? collect();
                        @endphp
                        <tr>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $categoryExpenses->sum('amount') }}</td>
                            <td>{{ $categoryIncomes->sum('amount') }}</td>
                            <td>{{ $categoryPlans->sum('amount') }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <td><strong>Баланс </strong></td>
                            <td><strong>{{ $expenses->reduce(function ($carry, $item) {
                                            return $carry + $item->sum('amount');
                                            }, 0) }}</strong></td>
                            <td><strong>{{ $incomes->reduce(function ($carry, $item) {
                                            return $carry + $item->sum('amount');
                                            }, 0) }}</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
@endsection

