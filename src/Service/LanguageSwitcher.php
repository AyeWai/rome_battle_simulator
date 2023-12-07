<?php
namespace App\Service;

use Symfony\Component\Translation\LocaleSwitcher;

class LanguageSwitcher
{
    public function __construct(
        private LocaleSwitcher $localeSwitcher,
    ) {
    }

    public function switchLocaleToFrench(): void
    {
        // you can set the locale for the entire application like this:
        // (from now on, the application will use 'fr' (French) as the
        // locale; including the default locale used to translate Twig templates)
        $this->localeSwitcher->setLocale('fr');

    }

    public function resetLocale(): void
    {
        // reset the current locale of your application to the configured default locale
        // in config/packages/translation.yaml, by option 'default_locale'
        $this->localeSwitcher->reset();
    }

    public function getLocale()
    {
        // you can get the current application locale like this:
        return $this->localeSwitcher->getLocale();
    }
}