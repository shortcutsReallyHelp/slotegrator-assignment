<?php declare(strict_types=1);

namespace Slotegrator\Application\I18n;

use Slotegrator\Domain\I18n\I18nInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class I18n implements I18nInterface
{
    public function __construct(protected TranslatorInterface $translator) {}

    /**
     * @param string $key
     * @param array $parameters
     * @return string
     */
    public function translate(string $key, array $parameters = []): string
    {
        return $this->translator->trans($key, $parameters);
    }
}
