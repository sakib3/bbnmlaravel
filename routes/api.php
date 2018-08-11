<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the 'api' middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::any('shops', function () {
    return generateShops();
});

function generateShops(){
    $noOfShops = 50;
    $shops = array();
    for ($i = 1; $i <= $noOfShops; $i++)
        array_push($shops,generateShop($i));
    return ['shops' => $shops];
}

function generateShop($id){
    $object = new stdClass;
    $object->id = $id;
    $object->name = generateString();
    $object->address = generateString();
    $object->logo = generateLogoUrl();
    $object->location = [
      'latitude' => (40 + (rand(100,999)/1000)),
      'longitude' => (-74 - (rand(100,999)/1000))
    ];
    $object->distance = '1';
    $object->price = [
      'Man' => rand(80, 110),
      'Pensonist' => rand(65, 75),
      'Children' => rand(35, 45)
    ];
    $object->opening =(object)[
      'Monday' => [
        'start' => '11:00',
        'end' => '18:00'
      ],
      'Tuesday' => [
        'start' => '10:00',
        'end' => '18:00'
      ],
      'Wednesday' => [
        'start' => '10:00',
        'end' => '18:00'
      ],
      'Thursday' => [
        'start' => '10:00',
        'end' => '18:00'
      ],
      'Friday' => [
        'start' => '10:00',
        'end' => '18:00'
      ],
      'Saturday' => null,
      'Sunday'=> null
    ];
    return $object;
}

function generateString() {
  $text = '';
  $possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
  for ($i = 0.0; $i < 10.0; $i++)
    $text .= substr($possible,rand(0, strlen($possible)-1),1);
  return $text;
}

function generateLogoUrl() {
    $possible = '123456789';
    return 'assets/imgs/logo' . substr($possible,rand(0, strlen($possible)-1),1) . '.jpg';
}