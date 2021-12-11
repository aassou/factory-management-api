<?php

namespace App\Controller;

use App\Exception\ClientNotFoundException;
use App\Manager\ClientManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class ClientController
 * @package App\Controller
 */
class ClientController extends AbstractController implements CrudControllerInterface
{

    /**
     * @var ClientManager
     */
    private ClientManager $clientManager;
    
    /**
     * ClientController constructor.
     * @param ClientManager $clientManager
     */
    public function __construct(ClientManager $clientManager) {
        $this->clientManager = $clientManager;
    }

    /**
     * @return JsonResponse
     */
    #[Route('/', name: 'client_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $clients = $this->clientManager->readAll();

        return $this->json($clients);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/api/client/create',name:'client_create',methods: ['POST'])]
    public function create(Request $request): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $client = $this->clientManager->create($data, $this->getUser()->getUsername());

        return $this->json($client);
    }


    /**
     * @param int $id
     * @return JsonResponse
     * @throws ClientNotFoundException
     */
    #[Route('/api/clients/{id}',name:'get_client',methods: ['GET'])]
    public function read(int $id): JsonResponse {
        $client = $this->clientManager->read($id);
        
        if (!$client) {
            throw new NotFoundHttpException(sprintf("Client not found %s", $id));
        }

        return $this->json($client);
    }


    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ClientNotFoundException
     */
    #[Route('/api/client/{id}', name: 'update_client', methods: ['PATCH'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $client = $this->clientManager->update($data, $this->getUser()->getUsername() ,$id);
        
        if (!$client) {
            throw new NotFoundHttpException(sprintf("Client not found %s", $id));
        }

        return $this->json([$client]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->clientManager->delete($id, $this->getUser()->getUsername());

        return $this->json(["message" => sprintf("Client %s deleted successfully", $id)]);
    }

    /**
     * @return JsonResponse
     */
    #[Route('/api/client', name: 'get_clients', methods: ['GET'])]
    public function readAll(): JsonResponse
    {
        $clients = $this->clientManager->readAll();

        return $this->json($clients);
    }
}
