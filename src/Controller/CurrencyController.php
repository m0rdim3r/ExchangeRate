<?php

namespace App\Controller;

use App\Entity\Currency;
use App\Service\ApiClient\NbpApiClient;
use App\Traits\EntityManagerTrait;
use App\Traits\TranslatorTrait;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyController extends AbstractController
{
    use EntityManagerTrait;
    use TranslatorTrait;

    /**
     * @Route("/", name="currency")
     * @throws GuzzleException
     */
    public function index(NbpApiClient $nbpApiClient): Response
    {
        $message = $nbpApiClient->get();

        $this->get('session')->getFlashBag()->add(
            $message[0],
            $this->translator->trans($message[1])
        );

        return $this->render('currency/index.html.twig', [
            'currency' => $this->em->getRepository(Currency::class)->findAll(),
        ]);
    }
}
