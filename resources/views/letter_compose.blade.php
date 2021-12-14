@extends('app_main')

<!--//stack -->

@section('main_content')

    <div class='flex py-2 text-sm text-gray-400'>
        <a href="{{ route('home') }}">Главная</a>
        <span class='px-2'>></span>
        <a href="{{ route('letters.list.my') }}">Список моих писем</a>
        <span class='px-2'>></span>
        <span>Написать письмо</span>
    </div>

    @if( $errors->any() )
        <div>
            @foreach( $errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    
    <div class='text-3xl py-4'>Напишите Дедушке Морозу свое письмо</div>

    <form method=post class='w-1/2' action="{{ route('letter.send')}}">
        @csrf
        <div>
            <textarea name='body' class='w-full h-60 border-2 rounded-md border-blue-400 py-2 px-4' placeholder='Что же вы хотите сказать Дедушке Морозу?'>{{ old('body') }}</textarea>
        </div>
        <div>
            <input class='bg-blue-400 text-white py-2 px-6 rounded-md shadow-md' type='submit' name='send_letter' value='Отправить письмо'/>
        </div>
    </form>
@endsection