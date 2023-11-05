@extends('layouts.home')
@section('title', 'FinPlan')

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
                <form method="post" action="{{route("financialPlan.update", ['financialPlan' => $financialPlan->id])}}" class="form-horizontal">
                    @csrf
                    @method('PUT')

                    <div class="mb-3" style="margin-top: 30px">
                        <label for="category_id" style="margin-bottom: 10px">Ввиберіть категорію:</label>
                        <select class="form-select" aria-label="Default select example" name="category_id" style="width: 100%">
                            <option value="{{$financialPlan->category->id }}" >{{$financialPlan->category->category_name}}</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Початок блоку форми. Якщо є помилки, пов'язані з 'inputname', додає клас 'has-error' до цього блоку. -->
                    <div class="form-group{{ $errors->has('inputname') ? ' has-error' : '' }}">
                        <label for="amount" style="margin-bottom: 10px">Введіть суму:</label>
                        <input type="number" name="amount" id="amount" step="0.01" value="{{$financialPlan->amount}}" class="form-control">
                        <!-- Якщо є помилки, пов'язані з 'inputname', вони будуть відображатися тут у вигляді маленького червоного тексту. -->
                        @if($errors->has('inputname'))
                            <small class="text-danger">{{ $errors->first('inputname') }}</small>
                        @endif
                    </div>

                    <div class="mb-3" style="margin-top: 30px">
                        <label for="currency_id" style="margin-bottom: 10px">Виберіть валюту:</label>
                        <select class="form-select" aria-label="Default select example" name="currency_id" style="width: 100%">
                            <option value="{{$financialPlan->currency->id }}" >{{$financialPlan->currency->currency_name}}</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">{{$currency->currency_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group{{ $errors->has('inputname') ? ' has-error' : '' }}">
                        <label for="date" style="margin-bottom: 10px">Введіть дату:</label>
                        <input type="date" name="date" id="date" value="{{$financialPlan->date}}" class="form-control">
                        <!-- Якщо є помилки, пов'язані з 'inputname', вони будуть відображатися тут у вигляді маленького червоного тексту. -->
                        @if($errors->has('inputname'))
                            <small class="text-danger">{{ $errors->first('inputname') }}</small>
                        @endif
                    </div>

                    @if (auth()->check() && auth()->user()->role == 'admin')
                        <div class="mb-3" style="margin-top: 30px">
                            <label for="user_id" style="margin-bottom: 10px">Ввиберіть користувача:</label>
                            <select class="form-select" aria-label="Default select example" name="user_id" style="width: 100%">
                                <option value="{{$financialPlan->user->id }}" >{{$financialPlan->user->user_name}}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{$user->user_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    @elseif(auth()->check() && auth()->user()->role == 'user')
                        <div class="mb-3" style="margin-top: 30px">
                            <label for="user_id" style="margin-bottom: 10px">Користувач</label>
                            <select class="form-select" aria-label="Default select example" name="user_id" style="width: 100%">
                                <option value="{{ auth()->user()->id }}">{{auth()->user()->user_name}}</option>
                            </select>
                        </div>
                    @endif
                    <div class="btn-group pull-right" >
                        <button type="submit" class="btn btn-secondary" style="margin: 20px auto; font-weight: 600">Зберегти міни</button>
                    </div>
                </form>
            </div>
    </div>
@endsection
