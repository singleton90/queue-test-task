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
    \App\Jobs\MeasurementTaskJob::dispatch($request->input('url'));
    return true;
})->name('add-task');

Route::middleware('api')->get('/', function (Request $request) {
    $repository = new SqlMeasurementRepository(DB::connection()->getPdo());
    return (new MainViewModel($repository))->data();
});
