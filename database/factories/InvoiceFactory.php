<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use Carbon\Carbon as Carbon;

$factory->define(\App\Invoice::class, function (Faker $faker) {
    $status = ['paga',  'aberta' , 'atrasada'];
    static $id = 1;
    $expires = Carbon::now()->addDays(3); // toda fatura terá 3 dias de validade assim que criada
    $array =  [
        'status' => $faker->randomElement($status),
        'url' => 'www.desafiowecont.com/fatura/'.$id,
        'user_id' => $faker->numberBetween(1,5),
        'expiration' => $expires ,
        'created_at' => now(),
        'updated_at' => now(),
        'value' => $faker->randomFloat(2,1,9999),
    ];
    $id++;
    return $array;
});

