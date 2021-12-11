<?php

namespace App\Controller;
use App\Manager\ProjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProjectController extends AbstractController
{
     /**
     * @var ProjectManager
     */
    private ProjectManager $projectManager;
    
    /**
     * ProjectController constructor.
     * @param ProjectManager $projectManager
     */
    public function __construct(ProjectManager $projectManager) {
        $this->projectManager = $projectManager;
    }

    #[Route('/api/projects', name: 'get_projects')]
    public function index(): Response
    {
        $projects = $this->projectManager->getAllProjects();
        return $this->json($projects);
    }

    /**
    * @return JsonResponse
    */
    #[Route('/api/projects/create',name:'create_project',methods: ['POST'])]
    public function create(): JsonResponse {
        $request = Request::createFromGlobals();
        $current_user_username = $this->getUser()->getUsername();
        $project = $this->projectManager->addProject($request, $current_user_username);
        return $this->json($project);
    }
   

    // update project
    #[Route('/api/projects/{id}',name:'update_project',methods: ['PATCH'])]
    public function update($id): JsonResponse {
        $request = Request::createFromGlobals();
        $current_user_username = $this->getUser()->getUsername();
        $project = $this->projectManager->UpdateProject($request, $current_user_username,$id);
        if(!$project){
            return $this->json(['message'=>'Project not Found']);
        }
        return $this->json($project);
    }

      // find project
      #[Route('/api/projects/{id}',name:'get_project',methods: ['GET'])]
      public function getProject($id): JsonResponse {
          $project = $this->projectManager->FindProject($id);
          if(!$project){
              return $this->json(['message'=>'Project not Found']);
          }
          return $this->json($project);
      }
   


}
