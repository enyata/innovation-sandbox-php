<?php
require_once './vendor/autoload.php';

class Fixture {
    private $faker;

    public function __construct(){
        $this->faker = Faker\Factory::create();
    }

    public function Reset(){
        return [
            "Server"=> 'Cowboy',
            "aes_key"=> utf8_encode($this->faker->regexify('[A-Za-z0-9]{16}')),
            "Responsecode"=> '00',
            "password"=> $this->faker->regexify('[A-Za-z0-9]{7}'),
            "ivkey"=> utf8_encode($this->faker->regexify('[A-Za-z0-9]{16}')),
        ];
    }
}