<?php

namespace App\Manager;

use App\Manager\HistoryManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Project;

/**
 * Class ProjectManager
 * @package App\Manager
 */
class ProjectManager
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * ProjectManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager,HistoryManager $historyManager) {
        $this->entityManager = $entityManager;
        $this->historyManager = $historyManager;
    }

    /**
     * @param Request $request
     * @return Project|false
     */
    public function addProject(Request $request,$current_user_username) {
        $data = json_decode(
            $request->getContent(),
            true
        );
     
        $authDate = new \DateTime($data["authorizationDate"]);

        $project = new Project();
        $project->setName($data["name"]);
        $project->setArabicName($data["arabicName"]);
        $project->setLandTitle($data["landTitle"]);
        $project->setAddress($data["address"]);
        $project->setArabicAddress($data["arabicAddress"]);
        $project->setSurface($data["surface"]);
        $project->setDescription($data["description"]);
        $project->setBudget($data["budget"]);
        $project->setLotNumber($data["lotNumber"]);
        $project->setAuthorizationNumber($data["authorizationNumber"]);

        $project->setAuthorizationDate($authDate);

        $project->setNumberFloors($data["numberFloors"]);
        $project->setBasement($data["basement"]);
        $project->setGroundFloor($data["groundFloor"]);
        $project->setMezzanin($data["mezzanin"]);
        $project->setStairwellCage($data["stairwellCage"]);

        $project->setTerrace($data["terrace"]);
        $project->setFloorSurface($data["floorSurface"]);
        $project->setDeadline($data["deadline"]);
        $project->setPriceMeterInclVat($data["priceMeterInclVat"]);
        $project->setPriceMeterExclVat($data["priceMeterExclVat"]);

        $project->setVAT($data["VAT"]);
        $project->setArchitect($data["architect"]);
        $project->setReinforcedCement($data["reinforcedCement"]);
        $project->setStatus($data["status"]);
        $project->setClosed($data["closed"]);
        $project->setCreatedBy($current_user_username);
        //
       
 
        
        //
        $this->entityManager->persist($project);
        $this->entityManager->flush();
        $historyData = [
            'action' =>"Ajout",
            'target' => "Table des Projects",
            'description' => "Ajout de le Project : ".$project->getName(),
        ];
        $this->historyManager->addHistory($historyData,$current_user_username);
        return $project;
    }
   
    /**
     * @return array
     */
    public function getAllProjects(): array {
        $repository = $this->entityManager->getRepository(Project::class);
        return $repository->getProjectsName();
    }

    /**
     * @param Request $request
     * @return Project|false
     */
    public function UpdateProject(Request $request, $current_user_username,$id){
        $data = json_decode(
            $request->getContent(),
            true
        );
        $repository = $this->entityManager->getRepository(Project::class);
        $project = $repository->findOneBy(['id' => $id]);
        
        if(!$project){
            return false;
        }
         if (array_key_exists("name",$data)) $project->setName($data["name"]);
         if (array_key_exists("arabicName",$data)) $project->setArabicName($data["arabicName"]);
         if (array_key_exists("landTitle",$data)) $project->setLandTitle($data["landTitle"]);
         if (array_key_exists("address",$data)) $project->setAddress($data["address"]);
         if (array_key_exists("arabicAddress",$data)) $project->setArabicAddress($data["arabicAddress"]);
         if (array_key_exists("surface",$data)) $project->setSurface($data["surface"]);
         if (array_key_exists("description",$data)) $project->setDescription($data["description"]);
         if (array_key_exists("budget",$data)) $project->setBudget($data["budget"]);
         if (array_key_exists("lotNumber",$data)) $project->setLotNumber($data["lotNumber"]);
         if (array_key_exists("authorizationNumber",$data)) $project->setAuthorizationNumber($data["authorizationNumber"]);
         if (array_key_exists("authorizationDate",$data)){
            $authDate = new \DateTime($data["authorizationDate"]);
            $project->setAuthorizationDate($authDate);
         } 
         if (array_key_exists("numberFloors",$data)) $project->setNumberFloors($data["numberFloors"]);
         if (array_key_exists("basement",$data)) $project->setBasement($data["basement"]);
         if (array_key_exists("groundFloor",$data)) $project->setGroundFloor($data["groundFloor"]);
         if (array_key_exists("mezzanin",$data)) $project->setMezzanin($data["mezzanin"]);
         if (array_key_exists("stairwellCage",$data)) $project->setStairwellCage($data["stairwellCage"]);
         if (array_key_exists("terrace",$data)) $project->setTerrace($data["terrace"]);
         if (array_key_exists("floorSurface",$data)) $project->setFloorSurface($data["floorSurface"]);
         if (array_key_exists("deadline",$data)) $project->setDeadline($data["deadline"]);
         if (array_key_exists("priceMeterInclVat",$data)) $project->setPriceMeterInclVat($data["priceMeterInclVat"]);
         if (array_key_exists("priceMeterExclVat",$data)) $project->setPriceMeterExclVat($data["priceMeterExclVat"]);
         if (array_key_exists("VAT",$data)) $project->setVAT($data["VAT"]);
         if (array_key_exists("architect",$data)) $project->setArchitect($data["architect"]);
         if (array_key_exists("reinforcedCement",$data)) $project->setReinforcedCement($data["reinforcedCement"]);
         if (array_key_exists("status",$data)) $project->setStatus($data["status"]);
         if (array_key_exists("closed",$data)) $project->setClosed($data["closed"]);

      
        $project->setUpdatedBy($current_user_username);
        
        $date = new \DateTime() ;
        $date->setTimezone(new \DateTimeZone('Africa/Casablanca'));
        $project->setUpdated($date);

        $this->entityManager->persist($project);
        $this->entityManager->flush();
        $historyData = [
            'action' =>"Modification",
            'target' => "Table des Projects",
            'description' => "Modification de le Project : ".$project->getName(),
        ];
        $this->historyManager->addHistory($historyData,$current_user_username);
        return $project;
    }

    public function FindProject($id){
        $repository = $this->entityManager->getRepository(Project::class);
        $Project = $repository->findOneBy(['id' => $id]);
        if(!$Project){
            return false;
        }
        return $Project;
    }
}