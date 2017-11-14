<?php

namespace Q\ExampleBundle\Factory;

interface FactoryInterface
{
    public function factory(string $data, array $groups = []);
}
