<?php

namespace eatae\ThrowableInstruction\Examples;

interface ValidatorInterface
{
    public function validate(object $inner): bool;
}
