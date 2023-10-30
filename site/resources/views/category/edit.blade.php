@extends('layouts.home')
@section('title', 'Category')

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
            <form method="post" action="{{route("category.update", ['category' => $category->id])}}" class="form-horizontal">
                @csrf
                @method('PUT')

                <!-- Початок блоку форми. Якщо є помилки, пов'язані з 'inputname', додає клас 'has-error' до цього блоку. -->
                <div class="form-group{{ $errors->has('inputname') ? ' has-error' : '' }}">
                    <label for="category_name" style="margin-bottom: 20px">Введіть назву категорії</label>
                    <input type="text" name="category_name" id="category_name" value="{{ $category->category_name}}" class="form-control" required>
                    <!-- Якщо є помилки, пов'язані з 'inputname', вони будуть відображатися тут у вигляді маленького червоного тексту. -->
                    @if($errors->has('inputname'))
                        <small class="text-danger">{{ $errors->first('inputname') }}</small>
                    @endif
                </div>

                <div class="btn-group pull-right" >
                    <button type="submit" class="btn btn-secondary" style="margin: 20px auto; font-weight: 600; width: 100px">Зберегти</button>
                </div>
            </form>
        </div>
    </div>
@endsection
