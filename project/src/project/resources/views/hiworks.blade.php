<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
{{$data}}
<script>
    let data = document.body.innerText;
    window.opener.postMessage(`${document.body.innerText}`);
    window.close();
</script>
</body>
