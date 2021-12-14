@extends('app_main')

<!--//stack -->

@section('main_content')
    
    <div class='flex py-2 text-sm text-gray-400'>
        <a href="{{ route('home') }}">Главная</a>
        <span class='px-2'>></span>
        <a href="{{ route('letters.list.my') }}">Список моих писем</a>
        <span class='px-2'>></span>
        <span>Редактировать письмо</span>
    </div>

    @if( $errors->any() )
        <div>
            @foreach( $errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    
    <div class='text-3xl py-4'>Редактировать письмо</div>

    <form method=post class='w-1/2' action="{{ route( 'letter.update', ['id' => $letter->id ] )}}">
        @csrf
        <div>
            <textarea name='body' class='w-full h-60 border-2 rounded-md border-blue-400 py-2 px-4' placeholder='Что же вы хотите сказать Дедушке Морозу?'>{{ $letter->body }}</textarea>
        </div>
        <div>
            <select name='is_private' class='py-2 px-4 border-2 border-blue-400 rounded-md'>
                <option value='1' @if($letter->is_private == 1) selected @endif>Лично Дедушке</option>
                <option value='0' @if($letter->is_private == 0) selected @endif>Публично, будет видно всем</option>
            </select>
        </div>
        <div>
            <input class='bg-blue-400 text-white py-2 px-6 rounded-md shadow-md snow-bg' type='submit' name='save_letter' value='Отредактировать письмо'/>
        </div>
    </form>
@endsection