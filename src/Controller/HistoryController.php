<?php

namespace App\Controller;

use App\Manager\HistoryManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class  HistoryController
 * @package App\Controller
 */
#[Route('/api/history', name: 'history_')]
class HistoryController extends AbstractController implements CrudControllerInterface
{
    /**
     * @var HistoryManager
     */
    private HistoryManager $historyManager;

    /**
     * @param HistoryManager $historyManager
     */
    public function __construct(HistoryManager $historyManager) {
        $this->historyManager = $historyManager;
    }

    /**
     * @return Response
     */
    #[Route('/', name: 'history_index', methods: ['GET'])]
    public function index(): Response
    {
        $histories = $this->historyManager->readAll();

        return $this->json($histories);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/create', name: 'history_create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        return $this->json([]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'history_get_one_by_id', methods: ['GET'])]
    public function read($id): JsonResponse
    {
        return $this->json([]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'history_update', methods: ['PATCH'])]
    public function update(Request $request, $id): JsonResponse
    {
        return $this->json([]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    #[Route('/{id}', name: 'history_delete', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        return $this->json([]);
    }

    /**
     * @param $month
     * @param $year
     * @return Response
     */
    #[Route('/api/history/{month}/{year}', name: 'history_get_by_exact_month', methods: ['GET'])]
    public function getHistoryByExactMonth($month,$year): Response
    {
        $histories = $this->historyManager->getHistoryByExactMonth($month,$year);

        return $this->json($histories);
    }

    /**
     * @return Response
     */
    #[Route('/api/history/months', name: 'history_get_by_months', methods: ['GET'])]
    public function getHistoryMonths(): Response
    {
        $histories = $this->historyManager->getHistoryMonths();

        return $this->json($histories);
    }
}
