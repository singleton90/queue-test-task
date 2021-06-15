<?php

use App\Models\Measurement;
use App\Models\SqlMeasurementRepository;
use App\Models\ViewModels\MainViewModel;
use App\Models\VO\MeasurementParams;
use App\Models\VO\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('api')->post('/add-task', function (Request $request) {
//    $startTime = new DateTimeImmutable();
//    sleep(rand(1,3));
//    $url = new Url($request->input('url'));
//    $ch = curl_init();
//    curl_setopt($ch, CURLOPT_URL, $url->urlString());
//    curl_exec($ch);
//    $info = curl_getinfo($ch);
//    $finishTime = new DateTimeImmutable();
//    $params = MeasurementParams::fromCurlGetinfo($info);
//    $measurement = new Measurement($startTime, $url);
//    $measurement->setFinishTime($finishTime);
//    $measurement->setMeasurementParams($params);
//    //TODO перенести PDO в DIC
    $repository = new SqlMeasurementRepository(DB::connection()->getPdo());
//    $repository->save($measurement);
    dd($repository->latestMeasurements());
})->name('add-task');

Route::middleware('api')->get('/', function (Request $request) {
    $repository = new SqlMeasurementRepository(DB::connection()->getPdo());
    return (new MainViewModel($repository))->data();
});
