@extends('app_main')

<!--//stack -->

@section('main_content')
    <div class='flex py-2 text-sm text-gray-400'>
        <a href="{{ route('home') }}">Главная</a>
        <span class='px-2'>></span>
        <span>Список писем</span>
    </div>
    <div class='flex flex-col w-full'>
        <div class='text-3xl py-4 font-pacifico'>Список писем</div>

        @if( Auth::user()->role != 'admin' )
            <div class='flex items-center py-2'>
                <a href="{{ route('letter.compose') }}" class='flex items-center bg-red-400 text-white py-2 px-6 rounded-md border-b-2 border-red-800'>
                    <img src="https://img.icons8.com/ios-glyphs/24/000000/edit.png" class='h-4 mr-4'/>
                    Написать письмо дедушке
                </a>
            </div>
        @endif
        
        <div class='flex flex-wrap justify-between text-2xl italic'>
            @foreach( $letters_all as $letter)
                @if( $letter->author_id == Auth::user()->id )
                    @if( $letter->response == null)
                        <div class='p-8 w-1/3'>
                            <div class='bg-white flex items-center w-full p-8'>
                                <a href="{{ route('letter.edit', [ 'id' => $letter->id ]) }}">{{ $letter->body }}</a>
                                <img src="https://img.icons8.com/ios-glyphs/24/000000/edit.png" class='h-4 ml-4'/>
                            </div>
                        </div>
                    @else 
                        <div class='p-8 w-1/3'>
                            <div class='bg-white flex items-center w-full p-8'>
                                <a href="{{ route('letter.view', [ 'id' => $letter->id ]) }}">{{ $letter->body }}</a>
                                <img src="https://img.icons8.com/material-outlined/24/000000/response.png" class='h-4 ml-4' alt='Есть ответ'/>
                            </div>
                        </div>
                    @endif
                @else
                    @if( Auth::user()->role == 'admin')
                        @if( $letter->response == null)
                            <div class='p-8 w-1/3'>
                                <div class='bg-white flex items-center w-full p-8'>
                                    <a href="{{ route('letter.response', [ 'id' => $letter->id ]) }}">{{ $letter->body }}</a>
                                </div>
                            </div>
                        @else
                            <div class='p-8 w-1/3'>
                                <div class='bg-white flex items-center w-full p-8'>
                                    <a href="{{ route('letter.response', [ 'id' => $letter->id ]) }}">{{ $letter->body }}</a>
                                    <img src="https://img.icons8.com/material-outlined/24/000000/response.png" class='h-4 ml-4' alt='Есть ответ'/>
                                </div>
                            </div>
                        @endif
                    @else
                        @if( $letter->is_private == 0)
                            <div class='p-8 w-1/3'>
                                <div class='bg-white flex items-center w-full p-8'>
                                <img src="https://img.icons8.com/material-outlined/24/000000/guest-male.png" class='h-4 mr-4' />
                                <a href="{{ route('letter.view', [ 'id' => $letter->id ]) }}">{{ $letter->body }}</a>
                            </div>
                        </div>
                        @endif
                    @endif
                @endif
            @endforeach
        </div>
    </div>
@endsection