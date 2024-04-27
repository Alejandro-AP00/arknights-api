<?php

namespace App\Contracts;

interface Transformer
{
    public function __construct($subject);

    public function transform(): mixed;
}
