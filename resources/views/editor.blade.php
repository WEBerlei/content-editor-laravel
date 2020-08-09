<html>
<head>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="app">
    <h1>Content Editor</h1>
    <content-editor mode="data" id="{{ $content_id  }}"></content-editor>
</div>

<script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>

