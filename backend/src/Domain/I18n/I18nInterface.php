<?php declare(strict_types=1);

namespace Slotegrator\Domain\I18n;

interface I18nInterface
{
    /**
     * @param string $key
     * @param array $parameters
     * @return string
     */
    public function translate(string $key, array $parameters = []): string;
}
