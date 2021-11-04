<!DOCTYPE html>
<html>
<head>
    <title>How to send mail using queue in Laravel 6? - ItSolutionStuff.com</title>
</head>
<body>
<center>
    <h2 style="padding: 23px;background: #b3deb8a1;border-bottom: 6px green solid;">
        {{$data['subject']}}
    </h2>
</center>
<div style="padding: 23px;background: #b3deb8a1;">

    <p>Dear {{$data['name'] ?? "Sir/Ma'am"}}, </p>
    {!!$data['message']!!}
    <div style="text-align:right">
        <p> from :</p>
        {!!get_meta_by_key('site_name')!!}
    </div>
</div>
</body>
</html>