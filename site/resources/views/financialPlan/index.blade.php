@extends('layouts.home')
@section('title', 'FinPlan')

@section('menu')
    @parent
@endsection

@section('content')
    <div class="container text-center" style="margin: 50px auto">

        <h4>Фінансовий план</h4>

        @if(session('errors') && count(session('errors'))>0)
            @foreach(session('errors')->all() as $err)
                <div class="alert" role="alert" style="color: #f50303; font-weight: 600; font-size: 18px">
                    {{ $err }}
                </div>
            @endforeach
        @endif

        @if(session('message'))
            <div class="alert" role="alert" style="color: #f5f103; font-weight: 600; font-size: 18px">
                {{ session('message') }}
            </div>
       @endif

        <div>
            <form action="{{ route('financialPlan.store') }}"  method="POST" style=" margin: 30px auto; width: 700px">
                @csrf
                <div class="mb-3" style="text-align: start">
                    <p>Створення фінансового плану:</p>
                </div>
                <div class="mb-3" style="text-align: start">
                    <label for="category_id">Виберіть категорію:</label>
                    <select class="form-select" aria-label="Default select example" name="category_id" style="width: 100%">
                        <option value="0" ></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3"  style="text-align: start">
                    <label for="amount">Введіть суму:</label>
                    <input type="number" name="amount" id="amount" step="0.01" style="width: 100%">
                </div>
                <div class="mb-3" style="text-align: start">
                    <label for="currency_id">Виберіть валюту:</label>
                    <select class="form-select" aria-label="Default select example" name="currency_id" style="width: 100%">
                        <option value="0" ></option>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency->id }}">{{$currency->currency_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3"  style="text-align: start">
                    <label for="date">Введіть дату:</label>
                    <input type="date" name="date" id="date" style="width: 100%">
                </div>
                @if (auth()->check() && auth()->user()->role == 'admin')
                    <div class="mb-3" style="text-align: start">
                        <label for="user_id">Виберіть користувача:</label>
                        <select class="form-select" aria-label="Default select example" name="user_id" style="width: 100%">
                            <option value="0" ></option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{$user->user_name}}</option>
                            @endforeach
                        </select>
                    </div>

                @elseif(auth()->check() && auth()->user()->role == 'user')
                    <div class="mb-3" style="text-align: start">
                        <select class="form-select" aria-label="Default select example" name="user_id" style="width: 100%">
                            <option value="{{ auth()->user()->id }}">{{auth()->user()->user_name}}</option>
                        </select>
                    </div>
                @endif
                <div class="mb-3" style="text-align: end">
                    <button type="submit" style="width: 100px">Створити</button>
                </div>
            </form>

            <div style="text-align: end">
                <button style="width: 400px; height: 50px; margin: 50px auto; background-color: gold"><a href="{{ route('financial') }}" style="text-decoration: none; color: black; font-weight: 600">Переглянути ваш баланс</a></button>
            </div>


            <table class="table table-striped" style="width: 100%; margin: 0 auto">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Категорія</th>
                    <th>Сума</th>
                    <th>Дата</th>
                    <th>Валюта</th>
                    @if(auth()->check() && auth()->user()->role == 'admin')
                        <th>Користувач</th>
                    @elseif(auth()->check() && auth()->user()->role == 'user')
                        <td></td>
                    @endif
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                @if(auth()->check() && auth()->user()->role == 'admin')
                    @foreach($financialPlans as $financialPlan)
                        <tr>

                            <td>{{ $financialPlan->id }}</td>
                            <td style="text-align: start">{{ $financialPlan->category->category_name }}</td>
                            <td>{{ $financialPlan->amount }}</td>
                            <td>{{ $financialPlan->date->format('d-m-Y') }}</td>
                            <td>{{ $financialPlan->currency->currency_name }}</td>
                            <td>{{ $financialPlan->user->user_name }}</td>
                            <td style="width: 150px">
                                <button style="width: 100px"><a href="{{ route('financialPlan.edit', $financialPlan) }}" style="text-decoration: none; color: black">Змінити</a></button>
                            </td>
                            <td style="width: 150px">
                                <form action="{{ route('financialPlan.destroy', $financialPlan->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="width: 100px">Видалити</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if(auth()->check() && auth()->user()->role == 'user')
                    @foreach($financialPlans as $financialPlan)
                        @if($financialPlan->user_id === auth()->user()->id)
                            <tr>
                                <td>{{ $financialPlan->id }}</td>
                                <td style="text-align: start">{{ $financialPlan->category->category_name }}</td>
                                <td>{{ $financialPlan->amount }}</td>
                                <td>{{ $financialPlan->date->format('d-m-Y') }}</td>
                                <td>{{ $financialPlan->currency->currency_name }}</td>
                                <td></td>
                                <td style="width: 150px">
                                    <button style="width: 100px"><a href="{{ route('financialPlan.edit', $financialPlan) }}" style="text-decoration: none; color: black">Змінити</a></button>
                                </td>
                                <td style="width: 150px">
                                    <form action="{{ route('financialPlan.destroy', $financialPlan->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="width: 100px">Видалити</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>
    </div>
@endsection
