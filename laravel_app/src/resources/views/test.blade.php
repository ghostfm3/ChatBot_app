<!-- app.blade.php -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="test.css">
  <title>ChatBot Demo</title>
</head>
<header>
@include('layouts.header')
</header>
<body>
<!-- @foreach ($errors->all() as $error)
<p> {{$error}}</p>
@endforeach   -->
<center>
    <div class="container">
        <div class="chatbox">
            @isset ($prompts)
            <div class="message outgoing">
                <div class="message-body">
                    <p>{{$prompts[0]}}</p>
                </div>
            </div>
            @endisset
            @isset ($tests)
            <div class="message incoming">
                <div ><img class="user-photo" src="sozai-rei-yumesaki-mini-close-blank.png"></div>
                <div class="message-body">
                    <p>{{$tests[0]}}</p>
                </div>
            </div>
            @endisset
        </div>
        <form method="POST" action="{{ route('test.index') }}">
        @csrf
        <div class="input-area">
            <input type="text" placeholder="Type your message..." name="prompt">
            <input class ="submit" type="submit" id="submit_button" value="投稿"/>
        </div>
        </form>
    </div>
</center>
</body>
</html>