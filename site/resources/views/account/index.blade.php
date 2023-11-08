@extends('layouts.home')
@section('title', 'Account')

@section('menu')
    @parent
@endsection

@section('content')
    <div class="container text-center" style="margin: 50px auto">

        <h4>Гаманці</h4>

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
            <form action="{{ route('account.store') }}"  method="POST" style=" margin: 30px auto; width: 700px">
                @csrf
                <div class="mb-3" style="text-align: start">
                    <p>Створення нового гаманця:</p>
                </div>
                <div class="mb-3"  style="text-align: start">
                    <label for="account_name">Введіть назву:</label>
                    <input type="text" name="account_name" id="account_name" style="width: 100%">
                </div>
                <div class="mb-3"  style="text-align: start">
                    <label for="balance">Введіть баланс:</label>
                    <input type="number" name="balance" id="balance" step="0.01" style="width: 100%">
                </div>
                @if (auth()->check() && auth()->user()->role == 'admin')
                    <div class="mb-3" style="text-align: start">
                        <label for="user_id">Виберіть:</label>
                        <select class="form-select" aria-label="Default select example" name="user_id" style="width: 100%">
                            <option value="0" >Користувач</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{$user->user_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" style="text-align: start">
                        <select class="form-select" aria-label="Default select example" name="income_sources_id" style="width: 100%">
                            <option value="0" >Джерело доходу</option>
                            @foreach($incomeSources as $incomeSource)
                                <option value="{{ $incomeSource->id }}">{{$incomeSource->income_sources_name}}</option>
                            @endforeach
                        </select>
                    </div>
                @elseif(auth()->check() && auth()->user()->role == 'user')
                    <div class="mb-3" style="text-align: start">
                        <select class="form-select" aria-label="Default select example" name="user_id" style="width: 100%">
                            <option value="{{ auth()->user()->id }}">{{auth()->user()->user_name}}</option>
                        </select>
                    </div>
                    <div class="mb-3" style="text-align: start">
                        <label for="user_id">Виберіть:</label>
                        <select class="form-select" aria-label="Default select example" name="income_sources_id" style="width: 100%">
                            <option value="0" >Джерело доходу</option>
                            @foreach($incomeSources as $incomeSource)
                                @if($incomeSource->user_id === auth()->user()->id)
                                <option value="{{ $incomeSource->id }}">{{$incomeSource->income_sources_name}}</option>
                                @endif
                            @endforeach
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
                    <th>Назва гаманця</th>
                    <th>Баланса</th>
                    @if(auth()->check() && auth()->user()->role == 'admin')
                        <th>Користувач</th>
                    @elseif(auth()->check() && auth()->user()->role == 'user')
                        <td></td>
                    @endif
                    <th>Джерело доходу</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                @if(auth()->check() && auth()->user()->role == 'admin')
                    @foreach($accounts as $account)
                        <tr>
                            <td>{{ $account->id }}</td>
                            <td style="text-align: start">{{ $account->account_name }}</td>
                            <td>{{ $account->balance }}</td>
                            <td>{{ $account->user->user_name }}</td>
                            <td>{{$account->incomeSource->income_sources_name}}</td>
                            <td style="width: 150px">
                                <button style="width: 100px"><a href="{{ route('account.edit', $account) }}" style="text-decoration: none; color: black">Змінити</a></button>
                            </td>
                            <td style="width: 150px">
                                <form action="{{ route('account.destroy', $account->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="width: 100px">Видалити</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
                @if(auth()->check() && auth()->user()->role == 'user')
                    @foreach($accounts as $account)
                        @if($account->user_id === auth()->user()->id)
                            <tr>
                                <td>{{ $account->id }}</td>
                                <td style="text-align: start">{{ $account->account_name }}</td>
                                <td>{{ $account->balance }}</td>
                                <td></td>
                                <td>{{$account->incomeSource->income_sources_name}}</td>
                                <td style="width: 150px">
                                    <button style="width: 100px"><a href="{{ route('account.edit', $account) }}" style="text-decoration: none; color: black">Змінити</a></button>
                                </td>
                                <td style="width: 150px">
                                    <form action="{{ route('account.destroy', $account->id) }}" method="post">
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
