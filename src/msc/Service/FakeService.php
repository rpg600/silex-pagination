<?php

namespace msc\Service;

use Faker;

class FakeService
{
    const NUM_RESULTS = 100;

    protected $data;
    private $seed;

    public function __construct($seed = null)
    {
        $this->data = array();
        $this->seed = $seed;

        $this->initialize();
    }

    public function getResults()
    {
        return $this->data;
    }

    protected function initialize()
    {
        $faker = Faker\Factory::create();

        if ($this->seed) {
            $faker->seed($this->seed);
        }

        for ($i=0; $i < self::NUM_RESULTS; $i++) {
            $this->data[] = array(
                "id"        => $i,
                "firstName" => $faker->firstName,
                "lastName"  => $faker->lastName,
                "address"   => $faker->address
            );
        }
    }
}
