<!DOCTYPE html>
<html>
<head>
    <title>Webstorming Admin</title>
</head>
<body>
    <h1 class="font-light text-red-800">{{ $data['subject'] }}</h1>
    <p class="font-light">A new report has been submitted for the post http://webstorming.test/posts/{{ $data['post_id']}}</p>
    <p class="text-red-800">The report was submitted by {{ $data['name'] }}.</p>
   
    <p>Thank you</p>
</body>
</html>