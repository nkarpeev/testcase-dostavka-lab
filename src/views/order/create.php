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
<div class="wrap">
    <div class="container">
        <h1>Заполните заявку и мы подберем вам курьера!</h1>
        <div class="col-md-10 col-md-offset-2">
            <form action="/" method="post">
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="from">Откуда доставить</label>
                        <input type="text" class="form-control" name="orders[from]" id="from"
                               placeholder="Откуда доставить"
                               required value="{{orders.from}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="destination">Куда доставить</label>
                        <input class="form-control" type="text" name="orders[destination]" id="destination"
                               value="{{orders.destination}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="delivery_date">Дата</label>
                        <input class="form-control" type="text" name="orders[delivery_date]" id="delivery_date"
                               value="{{orders.delivery_date}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="name">Ваше имя</label>
                        <input type="text" class="form-control" name="orders[name]" id="name" value="{{orders.name}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <label for="phone">Ваш телефон</label>
                        <input type="text" class="form-control" name="orders[phone]" id="phone"
                               value="{{orders.phone}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-7 form-group">
                        <select class="custom-select" name="add_services[]" multiple>
                            {% for service in addServicesData %}
                            <option value="{{service.id}}">{{service.label}}</option>
                            {% endfor %}
                        </select>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="geo_coordinates[longitude]" id="longitude"
                       value="56.84845">
                <input type="hidden" class="form-control" name="geo_coordinates[latitude]" id="latitude"
                       value="35.15484">

                <hr>
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">Отправить</button>
                </div>
            </form>
        </div>
    </div>

</div>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
</body>
</html>
