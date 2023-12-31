@extends('layouts.home')
@section('title', 'Home page')

@section('menu')
    @parent
@endsection

@section('content')
<div class="container text-center" style="margin: 50px auto">
    <div class="row" style="width: 100%; margin: 0 auto">
        <h2 style="font-size: 28px; font-weight: 600; margin-bottom: 30px">Як правильно вести свої фінанси</h2>
        <h5 style="font-weight: 500; margin-bottom: 50px"><em>“Ви маєте навчитись управляти власними грошима, або їх нестача буде до кінця життя управляти вами” - Роберт Кійосакі</em></h5>
        <div class="col" style="font-size: 18px">
            <p style="text-align: start">
                У веденні будь-якого бюджету, найголовніше — це вміння довгостроково мислити.
                Відсутність цього досвіду є коренем усіх проблем.
                За своєю природою люди погано вміють планувати, тому що звикли жити в сьогоденні.
                Однак виправити це не так складно, адже зараз є безліч готових, перевірених підходів і методик.
            </p>
            <p style="text-align: start">
                Перед початком записів ви визначаєте для себе 10-12 категорій витрат,
                в розрізі яких по закінченню місяця сформуєте звіт.
                Не створюйте занадто багато категорій і підкатегорій!
                Ви прийдете до цього в процесі, якщо вам дійсно це потрібно.
                Більше того, структура вашого бюджету буде адаптовуватись до вашої життєвої ситуації і
                корегуватись не один раз.
            </p>
            <p style="text-align: start">
                Створення плану бюджетування для вас може здаватися дуже великим і важким,
                але ми допоможе вам упорядкуватися. Чітке фіксування своїх грошових надходжень і витрат
                допоможе вам правильно розподіляти і витрачати свої фінансові ресурси та
                краще розуміти свої фінансові можливості.
            </p>
        </div>
        <div class="col">
            <div>
                <img class="img-fluid" src="/images/micheile-henderson-ZVprbBmT8QA-unsplash.jpg" alt="image">
            </div>
        </div>
        <div style="text-align: start; font-size: 18px; margin: 30px 0">
            <p>Якщо вас зацікавило, тоді реєструємось і починаємо працювати</p>
        </div>
        <div style="text-align: start">
            <button style="width: 250px; height: 50px"><a href="{{ url('/register') }}" style="text-decoration: none; color: black; font-weight: 600">Реєстрація</a></button>
        </div>
    </div>
</div>
@endsection
