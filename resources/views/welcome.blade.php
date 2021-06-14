<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/app.css" rel="stylesheet">
</head>
<body class="py-5">

<div class="container">
    <div class="card">
        <div class="card-body">
            <form class="row row-cols-lg-auto mb-4">
                <div class="col-12">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="URL">
                        <button type="submit" class="btn btn-primary">Добавить задачу</button>
                    </div>
                </div>
            </form>
            <h4>Последние 10 выполненных задач</h4>
            <table class="table mb-4">
                <thead>
                <tr>
                    <th scope="col">URL</th>
                    <th scope="col">Время запуска</th>
                    <th scope="col">Время выполнения</th>
                    <th scope="col" width="12.5%">total_time</th>
                    <th scope="col" width="12.5%">namelookup_time</th>
                    <th scope="col" width="12.5%">connect_time</th>
                    <th scope="col" width="12.5%">pretransfer_time</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>https://site.ru</td>
                    <td><?= date('Y-m-d H:i:s') ?></td>
                    <td>00:00:35</td>
                    <td>10.549943</td>
                    <td>10.100938</td>
                    <td>10.300077</td>
                    <td>10.300079</td>
                </tr>
                <tr>
                    <td>https://site.ru</td>
                    <td><?= date('Y-m-d H:i:s') ?></td>
                    <td>00:00:35</td>
                    <td>10.549943</td>
                    <td>10.100938</td>
                    <td>10.300077</td>
                    <td>10.300079</td>
                </tr>
                <tr>
                    <td>https://site.ru</td>
                    <td><?= date('Y-m-d H:i:s') ?></td>
                    <td>00:00:35</td>
                    <td>10.549943</td>
                    <td>10.100938</td>
                    <td>10.300077</td>
                    <td>10.300079</td>
                </tr>
                </tbody>
            </table>
            <h4>Статистика</h4>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center">
                            Задач обработано
                        </div>
                        <div class="card-body text-center h4">
                            50
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center">
                            Задач в очереди
                        </div>
                        <div class="card-body text-center h4">
                            50
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center ">
                            Среднее время на задачу
                        </div>
                        <div class="card-body text-center h4">
                            50
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center">
                            Расчетное время завершения
                        </div>
                        <div class="card-body text-center h4">
                            50
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/app.js" type="text/javascript"></script>
</body>
</html>
