<?php

namespace App\Traits;

use Symfony\Contracts\Translation\TranslatorInterface;

trait TranslatorTrait
{
    /** @var TranslatorInterface */
    protected $translator;

    /**
     * @required
     * @param TranslatorInterface $translator
     */
    public function setTranslator(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }
}