<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<h1>Create order</h1>

<div class="col-md-12">
    <form action="/order/create" method="post">
        <div class="col-md-12">
            <label for="from">Откуда доставить</label>
            <input type="text" name="from" id="from">
        </div>
        <div class="col-md-12">
            <label for="destination">Куда доставить</label>
            <input type="text" name="destination" id="destination">
        </div>
        <div class="col-md-12">
            <label for="delivery_date">Дата</label>
            <input type="text" name="delivery_date" id="delivery_date">
        </div>
        <div class="col-md-12">
            <label for="name">Ваше имя</label>
            <input type="text" name="name" id="name">
        </div>
        <div class="col-md-12">
            <label for="phone">Ваш телефон</label>
            <input type="text" name="phone" id="phone">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
</body>
</html>
