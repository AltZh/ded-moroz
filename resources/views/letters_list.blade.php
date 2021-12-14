@extends('app_main')

<!--//stack -->

@section('main_content')
    <div class='flex py-2 text-sm text-gray-400'>
        <a href="{{ route('home') }}">Главная</a>
        <span class='px-2'>></span>
        <span>Список писем</span>
    </div>
    <div class='flex flex-col w-full'>
        <div class='text-3xl py-4'>Список писем</div>

        @if( Auth::user()->role != 'admin' )
            <div class='flex items-center py-2'>
                <a href="{{ route('letter.compose') }}">Написать письмо дедушке</a>
            </div>
        @endif

        @foreach( $letters_all as $letter)
            @if( $letter->author_id == Auth::user()->id )
                @if( $letter->response == null)
                    <div class='flex items-center py-2'>
                        <a href="{{ route('letter.edit', [ 'id' => $letter->id ]) }}">{{ $letter->body }}</a>
                    </div>
                @else 
                    <div class='flex items-center py-2'>
                        <a href="{{ route('letter.view', [ 'id' => $letter->id ]) }}">{{ $letter->body }}</a>
                        <img src="https://img.icons8.com/material-outlined/24/000000/response.png" class='h-4 ml-4'/>
                    </div>
                @endif
            @else
                @if( Auth::user()->role == 'admin')
                    <div class='flex items-center py-2'>
                        <a href="{{ route('letter.response', [ 'id' => $letter->id ]) }}">{{ $letter->body }}</a>
                    </div>
                @else
                    <div class='py-2'>{{ $letter->body }}</div>
                @endif
            @endif
        @endforeach
    </div>
@endsection