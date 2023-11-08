@extends('layouts.home')
@section('title', 'FinPlan')

@section('menu')
    @parent
@endsection

@section('content')
    <div class="container text-center" style="margin: 50px auto">

        <h4>Операції</h4>

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

        <div class="row m-3" >
            <form action="{{ route('transaction.store') }}"  method="POST" style=" margin: 30px auto; width: 700px">
                @csrf
                <div class="mb-3" style="text-align: start">
                    <p>Створення нової операції:</p>
                </div>
                <div class="mb-3" style="text-align: start">
                    <label for="description">Введіть назву (опис) вашої операції:</label>
                    <input type="text" name="description" id="description" style="width: 100%">
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
                    <label for="timestamp">Введіть дату:</label>
                    <input type="date" name="timestamp" id="timestamp" style="width: 100%">
                </div>
                <div class="mb-3"  style="text-align: start">
                    <label for="type">Виберіть тип (дохід, витрати):</label>
                    <select class="form-select" aria-label="Default select example" name="type" style="width: 100%">
                        <option value="0" ></option>
                        <option value="plus">Дохід</option>
                        <option value="minus">Витрати</option>
                    </select>
                </div>
                <div class="mb-3"  style="text-align: start">
                    <label for="category_id">Виберіть категорію:</label>
                    <select class="form-select" aria-label="Default select example" name="category_id" style="width: 100%">
                        <option value="0" ></option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>

                @if (auth()->check() && auth()->user()->role == 'admin')
                    <div class="mb-3" style="text-align: start">
                        <label for="account_id">Виберіть гаманець:</label>
                        <select class="form-select" aria-label="Default select example" name="account_id" style="width: 100%">
                            <option value="0" ></option>
                            @foreach($accounts as $account)
                                <option value="{{ $account->id }}">{{$account->account_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" style="text-align: start">
                        <label for="income_source_id">Виберіть джерело доходу (при витратах необхідно вибрати - не вибрано):</label>
                        <select class="form-select" aria-label="Default select example" name="income_source_id" style="width: 100%">
                            <option value="">Не вибрано</option>
                            @foreach($incomeSources as $incomeSource)
                                <option value="{{ $incomeSource->id }}">{{$incomeSource->income_sources_name}}</option>
                            @endforeach
                        </select>
                    </div>
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
                        <label for="account_id">Виберіть гаманець:</label>
                        <select class="form-select" aria-label="Default select example" name="account_id" style="width: 100%">
                            <option value="0" ></option>
                            @foreach($accounts as $account)
                                @if($account->user_id === auth()->user()->id)
                                    <option value="{{ $account->id }}">{{$account->account_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" style="text-align: start">
                        <label for="income_sources_id">Виберіть джерело доходу:</label>
                        <select class="form-select" aria-label="Default select example" name="income_sources_id" style="width: 100%">
                            <option value="0" ></option>
                            @foreach($incomeSources as $incomeSource)
                                @if($incomeSource->user_id === auth()->user()->id)
                                    <option value="{{ $incomeSource->id }}">{{$incomeSource->income_sources_name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
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

            <table class="table table-striped" style="width: 100%; margin: 0 auto">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва (опис) операції</th>
                    <th>Сума</th>
                    <th>Валюта</th>
                    <th>Дата</th>
                    <th>Тип</th>
                    <th>Категорія</th>
                    <th>Гаманець</th>
                    <th>Джерело доходу</th>
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
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td style="text-align: start">{{ $transaction->description }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->currency->currency_name }}</td>
                            <td>{{ $transaction->timestamp }}</td>
                                @if($transaction->type == 'minus')
                                    <td> Витрати </td>
                                @else
                                    <td> Дохiд </td>
                                @endif
                            <td>{{$transaction->category->category_name}}</td>
                            <td>{{ $transaction->account->account_name }}</td>
                                @if($transaction->incomeSource)
                                    <td>{{ $transaction->incomeSource->income_sources_name }}</td>
                                @else
                                    <td>Не вказано</td>
                                @endif
                            <td>{{ $transaction->user->user_name }}</td>
                            <td style="width: 150px">
                                <button style="width: 100px"><a href="{{ route('transaction.edit', $transaction) }}" style="text-decoration: none; color: black">Змінити</a></button>
                            </td>
                            <td style="width: 150px">
                                <form action="{{ route('transaction.destroy', $transaction->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="width: 100px">Видалити</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if(auth()->check() && auth()->user()->role == 'user')
                    @foreach($transactions as $transaction)
                        @if($transaction->user_id === auth()->user()->id)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td style="text-align: start">{{ $transaction->description }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->currency->currency_name }}</td>
                                <td>{{ $transaction->timestamp}}</td>
                                    @if($transaction->type == 'minus')
                                        <td> Витрати </td>
                                    @else
                                        <td> Дохiд </td>
                                    @endif
                                <td>{{$transaction->category->category_name}}</td>
                                <td>{{ $transaction->account->account_name }}</td>
                                    @if($transaction->incomeSource)
                                        <td>{{ $transaction->incomeSource->income_sources_name }}</td>
                                    @else
                                        <td>Не вказано</td>
                                    @endif
                                <td></td>
                                <td style="width: 150px">
                                    <button style="width: 100px"><a href="{{ route('transaction.edit', $transaction) }}" style="text-decoration: none; color: black">Змінити</a></button>
                                </td>
                                <td style="width: 150px">
                                    <form action="{{ route('transaction.destroy', $transaction->id) }}" method="post">
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
