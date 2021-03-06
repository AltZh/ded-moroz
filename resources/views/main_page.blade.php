@extends('app_main')

@section('main_content')
    <div class='flex flex-col items-center pb-40' style=''>
        <div class='text-3xl pt-12 pb-4 font-pacifico'>
            Напиши письмо Дедушке Морозу - получи подарок!
        </div>
        <div class='text-xl pb-12'>
            Подарочки, которые можно получить за письмо:
        </div>
        <div class='flex flex-row w-full justify-center flex-wrap'>
            @foreach($gifts_all as $gift)
                <div class='w-1/5 p-2'>
                    <div class='py-2'><img src='{{ $gift->img_url }}' class='w-10/12 rounded-lg'/></div>
                    <div class='pt-2'>{{ $gift->title }}</div>
                    @if( $gift->is_one == 1 && $gift->letters()->count() < 1 )
                        <div class='text-sm'>еще не подарен</div>
                    @elseif( $gift->is_one == 1 && $gift->letters()->count() > 0 )
                        <div class='text-sm'>уже подарено</div>    
                    @elseif( $gift->is_one == 0 && $gift->letters()->count() < $gift->gifts_max_numb  )
                        <div class='text-sm'>осталось: {{ $gift->gifts_max_numb - $gift->letters()->count() }}</div>
                    @endif
                </div>
            @endforeach
        </div>
        <div class='text-xl p-12'>
            Количество подарков ограничено, успей получить свой!
        </div>
        <div class='text-2xl p-4'>
            <a href='{{ route('letter.compose') }}' class='bg-red-400 text-white py-2 px-6 rounded-md border-b-2 border-red-800'>Написать письмо</a>
        </div>
        <div class='text-3xl pt-12 pb-4 font-pacifico'>
            Новый Год случается только с тем, кто в него верит!
        </div>
        <div class='text-3xl pt-12 pb-4 font-mono flex flex-col items-center'>
            <div class='text-5xl rounded-md bg-white p-6'>{{ $letters_numb }}</div>
            <div class='text-xl'>уже написали дедушке</div>
        </div>
        <!--
        <div class='flex flex-col w-full'>
            <h1 class='text-3xl py-4'>Hello Laravel</h1>

            <div class='py-4'>
                <h3>Пользователи/Все</h3>
                <ul class='pl-4'>
                    <li>Счетчик до Нового Года</li>
                    <li>Счетчик количества писем</li>
                    <li>Счетчик количества оставшихся подарков</li>
                </ul>
            </div>
            <div class='py-4'>
                <h3>Пользователь/Ребенок</h3>
                <ul class='pl-4'>
                    <li><a href="{{ route('letter.compose') }}">Написать письмо</a></li>
                    <li>- проверка на слова из черного списка</li>
                    <li>Отредактировать свое письмо</li>
                    <li>Посмотреть ответ от Деда мороза</li>
                    <li><a href="{{ route('letters.list.my') }}">Список моих написанных писем</a></li>
                    <li><a href="{{ route('letters.list') }}">Список написанных писем, без содержимого</a></li>
                    <li>Голосование за другие письма</li>
                </ul>
            </div>
            <div class='py-4'>
                <h3>Пользователь/Дед Мороз</h3>
                <ul class='pl-4'>
                    <li>Посмотреть список написанных писем</li>
                    <li>Посмотреть выбранное письмо с содержанием</li>
                    <li>Написать ответ на выбранное письмо</li>
                    <li>Дед мороз может подарить подарок</li>
                    <li>? Рейтинг писем по категориям: самое длинное</li>
                </ul>
            </div>
        </div>
        -->
    </div>
@endsection