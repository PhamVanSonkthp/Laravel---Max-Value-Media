<html>
<head>
    <meta charset="UTF-8">
    <style></style>
</head>

<body>

<div>
    {!! optional(\App\Models\Setting::first())->privacy_policy_html !!}
</div>


</body>
<div style="position: absolute; top: 0px;"></div>
</html>
