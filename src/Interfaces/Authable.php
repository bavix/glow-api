<?php

namespace Bavix\GlowApi\Interfaces;

interface Authable
{
    /**
     * @param string $email
     * @param string $password
     * @param array $options
     * @return array
     */
    public function createToken(string $email, string $password, array $options = []): array;

    /**
     * @return iterable
     */
    public function allAbilities(): iterable;
}
