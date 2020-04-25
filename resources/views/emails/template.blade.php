<html>
<body>
<img src="{{ URL('assets/app-assets/images/adobe/logo.png') }}" alt="" width="70px">
<br>
<h3>{!! $data["salute"] !!}</h3>

<p>{!! $data["message"] !!}</p>

@if(isset($data['targetUrl']))
    <br>
    <a href="{!! $data['targetUrl'] !!}">{!! $data["buttonTitle"] !!}</a>
@endif
</body>
</html>
