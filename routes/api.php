<?php

use App\Jobs\MeasurementTaskJob;
use App\Models\Interfaces\MeasurementRepositoryInterface;
use App\Models\Interfaces\UrlInterface;
use App\Models\ViewModels\MainViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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

    $url = trim($request->input('url'));

    try {
        $urlObj = App::make(UrlInterface::class, ['url' => $url]);
        MeasurementTaskJob::dispatch($urlObj);
        $result = ['status' => 'success'];
    } catch (Exception $e) {
        $result = ['status' => 'error', 'message' => $e->getMessage()];
    }

    return $result;

})->name('add-task');

Route::middleware('api')->get('/', function (Request $request) {

    $repository = App::make(MeasurementRepositoryInterface::class);

    return (new MainViewModel($repository))->data();

});
