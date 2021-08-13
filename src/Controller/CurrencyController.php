<?php

namespace App\Controller;

use App\Entity\Currency;
use App\Handler\ExchangeRatesHandler;
use App\Service\ApiClient\NbpApiClient;
use App\Traits\EntityManagerTrait;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyController extends AbstractController
{
    use EntityManagerTrait;

    /**
     * @Route("/", name="currency")
     * @throws GuzzleException
     */
    public function index(NbpApiClient $nbpApiClient, ExchangeRatesHandler $handler): Response
    {
        $response = $nbpApiClient->get();

        if (is_array($response)) {
            $handler->handle($response);
        } else {
            $this->get('session')->getFlashBag()->add(
                'error',
                $response
            );
        }

        return $this->render('currency/index.html.twig', [
            'currency' => $this->em->getRepository(Currency::class)->findAll(),
        ]);
    }
}
