<?php declare(strict_types=1);

namespace Slotegrator\Business\I18n;

interface I18nInterface
{
    /**
     * @param string $message
     * @param array $parameters
     * @return string
     */
    public function translate(string $message, array $parameters = []): string;
}
