<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Form Test - <?= $name ?></h1>
    <form action="/handler" method="post">
        <input type="hidden" name'_METHOD' value="PUT">
        <input type="text" name="test">
        <button type="submit">submit</button>
    </form>
</body>

</html>