<!DOCTYPE html>
<html>
<head>
  <title>test</title>
  <script
    defer
    src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
  ></script>
</head>
    <div x-data="{message: 'Hello World'}">
        <h1 x-text="message"></h1>
        <h1 x-text="message"></h1>
    </div>
    <div x-data="{isShow: false}">
  <h1 x-show="isShow">Hello World</h1>
  <button @click="isShow = !isShow">表示・非表示</button>
</div>
</html>