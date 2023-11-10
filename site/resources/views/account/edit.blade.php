@extends('layouts.home')
@section('title', 'Account')

@section('menu')
    @parent
@endsection

@section('content')
    <div class="container" style="margin: 50px auto">

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
                <form method="post" action="{{route("account.update", ['account' => $account->id])}}" class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <!-- Початок блоку форми. Якщо є помилки, пов'язані з 'inputname', додає клас 'has-error' до цього блоку. -->
                    <div class="form-group{{ $errors->has('inputname') ? ' has-error' : '' }}" style="margin-bottom: 30px">
                        <label for="account_name" style="margin-bottom: 10px">Введіть назву гаманця:</label>
                        <input type="text" name="account_name" id="account_name" value="{{$account->account_name}}" class="form-control">
                        <!-- Якщо є помилки, пов'язані з 'inputname', вони будуть відображатися тут у вигляді маленького червоного тексту. -->
                        @if($errors->has('inputname'))
                            <small class="text-danger">{{ $errors->first('inputname') }}</small>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('inputname') ? ' has-error' : '' }}">
                        <label for="balance" style="margin-bottom: 10px">Введіть баланс гаманця:</label>
                        <input type="number" name="balance" id="balance" step="0.01" value="{{$account->balance}}" class="form-control">
                        <!-- Якщо є помилки, пов'язані з 'inputname', вони будуть відображатися тут у вигляді маленького червоного тексту. -->
                        @if($errors->has('inputname'))
                            <small class="text-danger">{{ $errors->first('inputname') }}</small>
                        @endif
                    </div>

                    @if (auth()->check() && auth()->user()->role == 'admin')
                        <div class="mb-3" style="margin-top: 30px">
                            <label for="income_sources_id" style="margin-bottom: 10px">Виберіть джерело доходу:</label>
                            <select class="form-select" aria-label="Default select example" name="income_sources_id" style="width: 100%">
                                <option value="{{$account->incomeSource->id }}" >{{$account->incomeSource->income_sources_name}}</option>
                                @foreach($incomeSources as $incomeSource)
                                    <option value="{{ $incomeSource->id }}">{{$incomeSource->income_sources_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" style="margin-top: 30px">
                            <label for="user_id" style="margin-bottom: 10px">Виберіть користувача:</label>
                            <select class="form-select" aria-label="Default select example" name="user_id" style="width: 100%">
                                <option value="{{$account->user->id }}" >{{$account->user->user_name}}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{$user->user_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    @elseif(auth()->check() && auth()->user()->role == 'user')
                        <div class="mb-3" style="margin-top: 30px">
                            <label for="income_sources_id" style="margin-bottom: 10px">Виберіть джерело доходу:</label>
                            <select class="form-select" aria-label="Default select example" name="income_sources_id" style="width: 100%">
                                <option value="{{$account->incomeSource->id }}" >{{$account->incomeSource->income_sources_name}}</option>
                                @foreach($incomeSources as $incomeSource)
                                    @if($incomeSource->user_id === auth()->user()->id)
                                        <option value="{{ $incomeSource->id }}">{{$incomeSource->income_sources_name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3" style="margin-top: 30px">
                            <label for="user_id" style="margin-bottom: 10px">Користувач:</label>
                            <select class="form-select" aria-label="Default select example" name="user_id" style="width: 100%">
                                <option value="{{ auth()->user()->id }}">{{auth()->user()->user_name}}</option>
                            </select>
                        </div>
                    @endif
                    <div class="btn-group pull-right" >
                        <button type="submit" class="btn btn-secondary" style="margin: 20px auto; font-weight: 600">Зберегти зміни</button>
                    </div>
                </form>
            </div>
    </div>
@endsection

