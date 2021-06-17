<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Фоновое задание + очередь</title>
    <link href="css/app.css" rel="stylesheet">
</head>
<body class="py-5">

<div class="container">
    <div class="card" id="app">
        <div class="card-body">
            <form class="row row-cols-lg-auto mb-4">
                <div class="col-12">
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" placeholder="URL"
                               v-bind:class="{'is-invalid': hasError}"
                               v-model="url"
                        >
                        <button type="submit" class="btn btn-primary" v-on:click="addTask">Добавить задачу</button>
                        <div class="invalid-tooltip">
                            @{{ errorMessage }}
                        </div>
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
                <tr v-for="measurement in measurements">
                    <td>@{{ measurement.url }}</td>
                    <td>@{{ measurement.start_time }}</td>
                    <td>@{{ measurement.execution_time }}</td>
                    <td>@{{ measurement.total_time }}</td>
                    <td>@{{ measurement.namelookup_time }}</td>
                    <td>@{{ measurement.connect_time }}</td>
                    <td>@{{ measurement.pretransfer_time }}</td>
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
                            @{{ statistics.total_finished_tasks }}
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center">
                            Задач в очереди
                        </div>
                        <div class="card-body text-center h4">
                            @{{ statistics.total_queue_tasks }}
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center ">
                            Среднее время на задачу
                        </div>
                        <div class="card-body text-center h4">
                            @{{ statistics.average_time_per_task }}
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header text-center">
                            Расчетное время завершения
                        </div>
                        <div class="card-body text-center h4">
                            @{{ statistics.expected_time_for_tasks }}
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
