<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="{{ URL::asset('_css/tailwind.css'); }}" rel="stylesheet"/>
     
    <style>
        .snow-bg{
            background-image: url("https://img.icons8.com/external-vitaliy-gorbachev-fill-vitaly-gorbachev/60/000000/external-snowflake-winter-vitaliy-gorbachev-fill-vitaly-gorbachev.png");
            background-repeat: no-repeat;
            background-position: 10% center;
            background-size: 10%;
            padding-left: 10%
        }
        header{
            background-image: url(https://thumbs.dreamstime.com/z/%D0%B7%D0%B8%D0%BC%D0%B0-%D0%B1%D0%B5%D0%B7%D0%BC%D0%BE%D0%BB%D0%B2%D0%BD%D1%8B%D0%B9-%D1%84%D0%BE%D0%BD-%D0%BD%D0%BE%D0%B2%D0%BE%D0%B3%D0%BE%D0%B4%D0%BD%D1%8F%D1%8F-%D0%B8-%D1%80%D0%BE%D0%B6%D0%B4%D0%B5%D1%81%D1%82%D0%B2%D0%B5%D0%BD%D1%81%D0%BA%D0%B0%D1%8F-%D0%BE%D0%B1%D0%B5%D1%80%D1%82%D0%BA%D0%B0-%D1%81-%D1%81%D0%B8%D0%BC%D0%B2%D0%BE%D0%BB%D0%B0%D0%BC%D0%B8-165198273.jpg);
            background-size: 140px;
        }
    </style>
</head>
<body>
    <header class='flex w-full justify-center bg-gray-100'>
        <div class='flex flex-row w-9/12 justify-center items-center'>
            <div class='p-4 w-1/5'>
                <a href="{{ route('home') }}">
                    <img src="https://img.icons8.com/external-wanicon-lineal-color-wanicon/32/000000/external-santa-winter-wanicon-lineal-color-wanicon.png"/>
                </a>
            </div>
            <div class='p-2 w-2/5 flex flex-col items-center'>
                <div id='time-till-ny-counter' class='f1ont-semibold text-xl font-mono'>00:00:00:00</div>
                <div class='text-sm'>до нового года</div>
            </div>
            <div class='p-4 w-2/5 flex flex-col items-center'>
                <div id='letters-total' class='f1ont-semibold text-xl font-mono'>{{ $letters_numb ?? '000' }}</div>
                <div class='text-sm'>писем</div>
            </div>
            <div class='p-4 w-1/5'>
                @if( Auth::check() )
                    <!-- если авторизован -->
                    <div class='flex flex-col items-end'>
                        <a href="{{ route('letters.list.my') }}">
                            <div class='text-md font-semibold'>{{ Auth::user()->email }}</div>
                        </a>
                        <a href="{{ route('user.logout')}}">
                            <div class='flex flex-row p-2 px-4 hover:bg-blue-200'>
                                <div class='text-sm pr-4'>logout</div> 
                                <img src="https://img.icons8.com/ios/16/000000/exit.png"/>
                            </div>
                        </a>
                        </div>
                @else
                    <!-- если гость -->
                    <a href="{{ route('login') }}">
                        <div class=''>
                            <img src="https://img.icons8.com/external-dreamstale-lineal-dreamstale/32/000000/external-login-ui-dreamstale-lineal-dreamstale-2.png"/>
                        </div>
                    </a>
                @endif
            </div>
        </div>
    </header>
    <div class='flex flex-row w-full justify-center'>
        <div class='flex w-9/12 justify-center'>
            <div class='w-full'>
                @yield('main_content')
            </div>
        </div>
    </div>
    <footer class='flex w-full justify-center bg-gray-200 mt-20'>
        <div class='flex flex-row w-9/12 justify-center items-center py-12 text-gray-400'>
            by Altynbek 2021-2022
        </div>
    </footer>
    <script>
        function countDown(){
            var currentDate = new Date();
            var eventDate = new Date(2022, 0, 1); // months start from 0
            var milliseconds = eventDate.getTime() - currentDate.getTime();
            var seconds = parseInt(milliseconds / 1000);
            var minutes = parseInt(seconds / 60);
            var hours = parseInt(minutes / 60);
            var days = parseInt(hours / 24);
            var months = parseInt(days / 30);
            seconds -= minutes * 60;
            minutes -= hours * 60;
            hours -= days * 24;
            days -= months * 30;

            var countDownWrapper = document.getElementById('time-till-ny-counter');
            countDownWrapper.innerHTML = days+':'+zeroPad(hours,2)+':'+zeroPad(minutes,2)+':'+zeroPad(seconds,2);
            
        }

        const zeroPad = (num, places) => String(num).padStart(places, '0')

        setInterval(countDown, 1000)

    </script>
</body>
</html>