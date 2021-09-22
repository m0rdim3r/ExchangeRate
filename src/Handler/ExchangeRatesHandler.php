<?php

namespace App\Handler;

use App\Entity\Currency;
use App\Traits\EntityManagerTrait;

class ExchangeRatesHandler
{
    use EntityManagerTrait;

    /**
     * @param array $date
     */
    public function handle(array $date)
    {
        $tmp = array_pop($date);

        if (array_key_exists('rates', $tmp)) {
            $currencyRepository = $this->em->getRepository(Currency::class);
            $rates = $tmp['rates'];

            foreach ($rates as $rate) {
                /** @var Currency $currency */
                if ($currency = $currencyRepository->findOneBy(['currencyCode' => $rate['code']])) {
                    $currency->setExchangeRate($rate['mid']);
                } else {
                    $currency = (new Currency())
                        ->setName($rate['currency'])
                        ->setCurrencyCode($rate['code'])
                        ->setExchangeRate($rate['mid'])
                        ;
                }

                $this->em->persist($currency);
            }

            $this->em->flush();
        }
    }
}