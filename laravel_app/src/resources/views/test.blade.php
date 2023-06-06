<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="test.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src="add_prompt.js"></script>
  <title>ChatBot Demo</title>
</head>
<header>
@include('layouts.header')
</header>
<body>
<center>
    <div class="container">
        <div class="chatbox" id="add_tag">
            <div class="message incoming">
                <div ><img class="user-photo" src="sozai-rei-yumesaki-hyokkori-1.png"></div>
                <div class="message-body">
                    <p>こんにちは！<br>ChatBot Demoアプリです。</p>
                </div>
            </div>
            @foreach ($chatreses as $chatres)
            <div class="message outgoing">
                <div class="message-body">
                    <p>{{$chatres->prompt}}</p>
                </div>
            </div>
            <div class="message incoming">
                <div ><img class="user-photo" src="sozai-rei-yumesaki-hyokkori-1.png"></div>
                <div class="message-body">
                    <p>{{$chatres->response}}</p>
                </div>
            </div>
            @endforeach
            @foreach ($errors->all() as $error)
            <div class="message incoming">
                <div ><img class="user-photo" src="sozai-rei-yumesaki-hyokkori-1.png"></div>
                <div class="message-body">
                    <p>{{$error}}</p>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</center>
</body>
<fooder>
<center>
<form method="POST" action="{{ route('test.index') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="input-area">
        <input type="text" id="text" placeholder="Type your message..." name="prompt">
        <input class ="submit" type="submit" id="submit_button" value="投稿"/>
    </div>
</form>
<form action="{{ route('test.destroy') }}" method="POST" onsubmit="return confirm('本当に削除しますか？')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-link">
        <i class="fa fa-trash">トーク履歴削除</i> 
    </button>
</form>
</center>
</fooder>

</html>