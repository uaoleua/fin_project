@extends('layouts.home')
@section('title', 'Financial')

@section('menu')
    @parent
@endsection

@section('content')
    <div class="container text-center" style="margin: 50px auto">
        <h4>Фінансовий звіт</h4>
        <form action="{{ url('/financial') }}" method="GET" style=" margin: 30px 0; text-align: start; width: 400px">
            <div style="margin-bottom: 30px; width: 100%">
                <label for="start_date">Виберіть період:</label>
                <input type="date" name="start_date" value="{{ $startDate->toDateString() }}">
                <input type="date" name="end_date" value="{{ $endDate->toDateString() }}">
            </div>
            <div style="margin-bottom: 30px; width: 100%">
                <label for="currency_id">Виберіть валюту:</label>
                <select class="form-select" aria-label="Default select example" name="currency_id" style=" width: 100%">
                    <option value="0"></option>
                    @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}" {{ (int) old('currency_id', $currencyId) === $currency->id ? 'selected' : '' }}>
                            {{$currency->currency_name}}
                        </option>
                    @endforeach
                </select>
            </div>
            <button style="width: 100%; height: 40px" type="submit">Фільтрувати</button>
        </form>
        <div class="row">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Категорія</th>
                            <th>Витрати</th>
                            <th>Доходи</th>
                            <th>План</th>
                            <th style="width: 15%">Виконання плану по категорії</th>
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
                            <td style="text-align: start; padding-left: 30px">{{ $category->category_name }}</td>
                            <td>{{ $categoryExpenses->sum('amount') }}</td>
                            <td>{{ $categoryIncomes->sum('amount') }}</td>
                            <td>{{ $categoryPlans->sum('amount') }}</td>
                            <td>
                                @if($categoryPlans->sum('amount') > 0)
                                    @if($categoryIncomes->sum('amount') > 0)
                                        {{number_format($categoryIncomes->sum('amount') / $categoryPlans->sum('amount') * 100, 2)}}
                                    @endif
                                    @if($categoryExpenses->sum('amount') >0)
                                            {{number_format($categoryExpenses->sum('amount') / $categoryPlans->sum('amount') * 100, 2)}}
                                        @endif
                                    @if($categoryIncomes->sum('amount') == 0 && $categoryExpenses->sum('amount') == 0)
                                            {{'0'}}
                                    @endif
                                @elseif($categoryPlans->sum('amount') === 0 ) {{'-'}}
                                @else{{'0'}}
                                @endif</td>
                        </tr>
                    @endforeach
                    @php
                        $totalExpenses = $expenses->reduce(function ($carry, $item) { return $carry + $item->sum('amount'); }, 0);
                        $totalIncomes = $incomes->reduce(function ($carry, $item) { return $carry + $item->sum('amount'); }, 0);
                        $profit = $totalIncomes - $totalExpenses;
                    @endphp
                        <tr>
                            <td><strong>Баланс </strong></td>
                            <td><strong>{{ $totalExpenses }}</strong></td>
                            <td><strong>{{ $totalIncomes }}</strong></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <div style="margin-top: 50px; font-size: 20px">

                <p><strong>Ваш фінансовий звіт {{ $profit >= 0 ? 'прибутковий' : 'збитковий' }}</strong> {{ number_format(abs($profit), 2) }} {{ $selectedCurrencyCode ?? '' }}
                    </p>

        </div>
    </div>
@endsection

