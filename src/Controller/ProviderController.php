<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Manager\ProviderManager;

#[Route('/api/providers', name: 'provider_')]
class ProviderController extends AbstractController
{
     /**
     * ProviderController constructor.
     * @param ProviderManager $providerManager
     */
    public function __construct(ProviderManager $providerManager) {
        $this->providerManager = $providerManager;
    }

    #[Route('/', name: 'getAll')]
    public function index(): Response
    {
        $providers = $this->providerManager->getAllProviders();
        return $this->json($providers);
    }

    /**
    * @return JsonResponse
    */
    #[Route('/create',name:'create',methods: ['POST'])]
    public function create(): JsonResponse {
        $request = Request::createFromGlobals();
        $current_user_username = $this->getUser()->getUsername();
        $provider = $this->providerManager->addProvider($request, $current_user_username);
        return $this->json($provider);
    }
   

    // update Provider
    #[Route('/{id}',name:'update',methods: ['PATCH'])]
    public function update($id): JsonResponse {
        $request = Request::createFromGlobals();
        $current_user_username = $this->getUser()->getUsername();
        $provider = $this->providerManager->UpdateProvider($request, $current_user_username,$id);
        if(!$provider){
            return $this->json(['message'=>'Provider not Found']);
        }
        return $this->json($provider);
    }

      // find Provider
      #[Route('/{id}',name:'get',methods: ['GET'])]
      public function getProvider($id): JsonResponse {
          $provider = $this->providerManager->FindProvider($id);
          if(!$provider){
              return $this->json(['message'=>'Provider not Found']);
          }
          return $this->json($provider);
      }
}
