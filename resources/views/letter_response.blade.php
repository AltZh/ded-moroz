@extends('app_main')

<!--//stack -->

@section('main_content')
    <div class='flex py-2 text-sm text-gray-400'>
        <a href="{{ route('home') }}">Главная</a>
        <span class='px-2'>></span>
        <a href="{{ route('letters.list') }}">Список всех писем</a>
        <span class='px-2'>></span>
        <span>Написать ответ</span>
    </div>
    @if( $errors->any() )
        <div>
            @foreach( $errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    
    <div class='text-3xl py-4'>Написать ответ на письмо</div>

    <div class='py-4'>{{ $letter->body }}</div>

    <form method=post class='w-1/2' action="{{ route( 'letter.response.send', ['id' => $letter->id ] )}}">
        @csrf
        <div>
            <textarea name='response' class='w-full h-60 border-2 rounded-md border-blue-400 py-2 px-4' placeholder='Ответ от дедушки'>{{ $letter->response }}</textarea>
        </div>
        <div>
            <input class='bg-blue-400 text-white py-2 px-6 rounded-md shadow-md snow-bg' type='submit' name='save_letter' value='Ответить на письмо'/>
        </div>
    </form>

    <div class='flex flex-row w-full'>
        @foreach($letter->gifts as $gift)
            <div class='w-1/5 p-2'>
                <div class='py-2'><img src='{{ $gift->img_url }}' class='w-10/12'/></div>
                <div class='pt-2'>{{ $gift->title }}</div>
                <div class='pb-2 text-sm'>{{ $gift->description }}</div>
            </div>
        @endforeach
    </div>

    <form method=post class='w-1/2' action="{{ route('letter.add_gift', ['id' => $letter->id]) }}">
        @csrf
        <select name='gift_id'>
            @foreach( $gifts_all as $gift )
            <option value='{{ $gift->id }}'>{{ $gift->title }}</option>
            @endforeach
        </select>
        <select name='is_public'>
            <option value='1' selected>Да</option>
            <option value='0'>Нет</option>
        </select>
        <div>
            <input class='bg-blue-400 text-white py-2 px-6 rounded-md shadow-md snow-bg' type='submit' value='Подарить подарок'/>
        </div>

    </form>
@endsection