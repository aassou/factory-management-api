<?php

namespace App\Controller;

use App\Exception\PropertyNotFoundException;
use App\Manager\ApartmentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class ApartmentController extends AbstractController implements CrudControllerInterface
{

    /**
     * @var ApartmentManager
     */
    private ApartmentManager $apartmentManager;

    /**
     * ApartmentController constructor.
     * @param ApartmentManager $apartmentManager
     */
    public function __construct(ApartmentManager $apartmentManager) {
        $this->apartmentManager = $apartmentManager;
    }

    /**
     * @return JsonResponse
     */
    #[Route('/', name: 'apartment_index', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $apartments = $this->apartmentManager->readAll();

        return $this->json($apartments);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/create', name:'apartment_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $apartment = $this->apartmentManager->create($data, $this->getUser()->getUsername());

        return $this->json($apartment);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws PropertyNotFoundException
     */
    #[Route('/{id}', name:'apartment_get_one_by_id', methods: ['GET'])]
    public function read(int $id): JsonResponse {
        $apartment = $this->apartmentManager->read($id);

        if (!$apartment) {
            throw new NotFoundHttpException(sprintf("Apartment %s not found", $id));
        }

        return $this->json($apartment);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws PropertyNotFoundException
     */
    #[Route('/{id}', name:'apartment_update', methods: ['PATCH'])]
    public function update(Request $request, int $id): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $apartment = $this->apartmentManager->update($data, $this->getUser()->getUsername(), $id);

        if (!$apartment) {
            throw new PropertyNotFoundException('Apartment Not Found!');
        }

        return $this->json($apartment);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws PropertyNotFoundException
     */
    #[Route('/{id}', name:'apartment_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $this->apartmentManager->delete($id, $this->getUser()->getUsername());

        return $this->json(["message" => sprintf("Apartment %s deleted successfully", $id)]);
    }

    /**
     * @param int $projectId
     * @return JsonResponse
     */
    #[Route('/project/{projectId}', name: 'apartment_get_by_project_id', methods: ['GET'])]
    public function readAllByProjectId(int $projectId): JsonResponse
    {
        $apartments = $this->apartmentManager->readAllByProjectId($projectId);

        return $this->json($apartments);
    }
}
