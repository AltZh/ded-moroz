@extends('app_main')

<!--//stack -->

@section('main_content')
    @if( $errors->any() )
        <div>
            @foreach( $errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    
    <div class='flex py-2 text-sm text-gray-400'>
        <a href="{{ route('home') }}">Главная</a>
        <span class='px-2'>></span>
        <a href="{{ route('letters.list.my') }}">Список моих писем</a>
        <span class='px-2'>></span>
        <span>Просмотр письма</span>
    </div>

    <div class='text-3xl py-4'>Просмотр письма</div>
    <div>Автор: {{ $letter->author->name }}</div>
    <div>{{ $letter->body }}</div>
    
    @if( $letter->response != null )
        <div class='text-3xl py-4'>Ответ от Дедушки</div>
        <div>{{ $letter->response }}</div>
    @endif

    @if($letter->gifts()->count() > 0)
        <div class='text-3xl py-4'>Подарки от Дедушки</div>
        <div class='flex flex-row w-full'>
            @foreach($letter->gifts as $gift)
                <div class='w-1/5 p-2'>
                    <div class='py-2'><img src='{{ $gift->img_url }}' class='w-10/12'/></div>
                    <div class='pt-2'>{{ $gift->title }}</div>
                    <div class='pb-2 text-sm'>{{ $gift->description }}</div>
                </div>
            @endforeach
        </div>
    @endif

@endsection