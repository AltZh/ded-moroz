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
    
    <div class='text-3xl py-4'>Подаренные подарки</div>

    @if( $letter->gifts()->count() > 0 )
    <div class='flex flex-row w-full'>
        @foreach($letter->gifts as $gift)
            <div class='w-1/5 p-2'>
                <div class='py-2'><img src='{{ $gift->img_url }}' class='w-10/12'/></div>
                <div class='pt-2'>{{ $gift->title }}</div>
                <div class='pb-2 text-sm'>{{ $gift->description }}</div>
            </div>
        @endforeach
    </div>
    @else
    <div class='py-6'>У письма пока нет подарков</div>
    @endif
    
    <div class='text-3xl py-4'>Подарить подарок</div>

    <form method=post class='w-1/2 flex items-center' action="{{ route('letter.add_gift', ['id' => $letter->id]) }}">
        @csrf
        <select name='gift_id' class='py-2 px-4 border-2 border-blue-400 rounded-md'>
            @foreach( $gifts_all as $gift )
                @if($gift->is_one == 1 && $gift->letters()->count() < 1)
                    <option value='{{ $gift->id }}'>{{ $gift->gifts_max_numb }} {{ $gift->title }}</option>
                @elseif($gift->is_one == 0 && $gift->letters()->count() < $gift->gifts_max_numb)
                    <option value='{{ $gift->id }}'>{{ $gift->gifts_max_numb - $gift->letters()->count() }} {{ $gift->title }}</option>
                @endif
            @endforeach
        </select>
        <select name='is_public' class='py-2 px-4 border-2 border-blue-400 rounded-md'>
            <option value='1' selected>Да</option>
            <option value='0'>Нет</option>
        </select>
        <div>
            <input class='bg-blue-400 text-white py-2 px-6 pl-8 rounded-md shadow-md' type='submit' value='Подарить подарок'/>
        </div>

    </form>
@endsection