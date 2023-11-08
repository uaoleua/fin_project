@extends('layouts.home')
@section('title', 'IncomeSource')

@section('menu')
    @parent
@endsection

@section('content')
    <div class="container text-center" style="margin: 50px auto">
        <h4>Джерела доходів</h4>

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
            <form action="{{ route('incomeSource.store') }}"  method="POST" style=" margin: 30px auto; width: 700px">
                @csrf
                <div class="mb-3" style="text-align: start">
                    <p>Створення нового джерела доходу:</p>
                </div>
                <div class="mb-3" style="text-align: start">
                    <label for="income_sources_name">Введіть назву:</label>
                    <input type="text" name="income_sources_name" id="income_sources_name" style="width: 100%">
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
            <table class="table table-striped" style="width: 100%; margin: 0 auto">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва джерела доходу</th>
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
                        @foreach($incomeSources as $incomeSource)
                            <tr>
                                <td>{{ $incomeSource->id }}</td>
                                <td style="text-align: start">{{ $incomeSource->income_sources_name }}</td>
                                <td>{{ $incomeSource->user->user_name }}</td>
                                <td style="width: 150px">
                                    <button style="width: 100px"><a href="{{ route('incomeSource.edit', $incomeSource) }}" style="text-decoration: none; color: black">Змінити</a></button>
                                </td>
                                <td style="width: 150px">
                                    <form action="{{ route('incomeSource.destroy', $incomeSource->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="width: 100px">Видалити</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    @if(auth()->check() && auth()->user()->role == 'user')
                        @foreach($incomeSources as $incomeSource)
                            @if($incomeSource->user_id === auth()->user()->id)
                                <tr>
                                    <td>{{ $incomeSource->id }}</td>
                                    <td style="text-align: start">{{ $incomeSource->income_sources_name }}</td>
                                    <td style="width: 150px">
                                        <button style="width: 100px"><a href="{{ route('incomeSource.edit', $incomeSource) }}" style="text-decoration: none; color: black">Змінити</a></button>
                                    </td>
                                    <td style="width: 150px">
                                        <form action="{{ route('incomeSource.destroy', $incomeSource->id) }}" method="post">
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
