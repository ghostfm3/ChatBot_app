<!DOCTYPE html>
<html>
<head>
    <title>AI文生成・チャットアプリ</title>
    <link rel="stylesheet" href="login.css">
</head>
<header>@include('layouts.header')</header>
<body>
    <h1>ログイン画面</h1>
    <form action="http://localhost:8090" method="POST">
        <!-- CSRF対策を行う -->
        @csrf
        <p>
            <dd>
                <label for="uid">ID:</label>
                <input type="text" name="userid" id="uid" />
                <!-- @if ($errors->has('userid'))
                <div class="p-contact__error" style="font-size:xx-small;"><font color="#FF0000">{{ $errors->first('userid') }}</font></div>
                @endif -->
            </dd>
        </p>

        <p>
            <dd>
                <label for="pwd">パスワード:</label>
                <input type="password" name="password" id="pwd" />
                <!-- @if ($errors->get('password'))
                <div class="p-contact__error" style="font-size:xx-small;"><font color="#FF0000">{{ $errors->first('password') }}</font></div>
                @endif -->
            </dd>
        </p>

        <br />

        <p><button type="submit" id="submit_button" class="btn btn-success btn-sm">ログイン</button><p>

        <br />
        <br />

        <p><a href="http://localhost:8090/test" class="btn btn-link">サインアップはこちら</a><p>

    </form>
</body>

</html>