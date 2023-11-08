@extends('layouts.home')
@section('title', 'Category')

@section('menu')
    @parent
@endsection

@section('content')
    <div class="container text-center" style="margin: 50px auto">
        <h4>Категорії для користувача</h4>

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
            <form action="{{ route('category.store') }}"  method="POST" style=" margin: 30px auto">
                @csrf
                <label for="category_name">Створюємо нову категорію:</label>
                <input type="text" name="category_name" id="category_name" required style="width: 400px">
                <button type="submit" style="width: 100px">Створити</button>
            </form>
            <table class="table table-striped" style="width: 100%; margin: 0 auto">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Назва категорії</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td style="text-align: start">{{ $category->category_name }}</td>
                            <td style="width: 150px">
                                <button style="width: 100px"><a href="{{ route('category.edit', $category) }}" style="text-decoration: none; color: black">Змінити</a></button>
                            </td>
                            <td style="width: 150px">
                                <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="width: 100px">Видалити</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
