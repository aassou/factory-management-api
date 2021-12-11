<?php

namespace App\Manager;

use App\Manager\HistoryManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Provider;

/**
 * Class ProviderManager
 * @package App\Manager
 */
class ProviderManager
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * ProviderManager constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager,HistoryManager $historyManager) {
        $this->entityManager = $entityManager;
        $this->historyManager = $historyManager;
    }

    /**
     * @param Request $request
     * @return Provider|false
     */
    public function addProvider(Request $request,$current_user_username) {
        $data = json_decode(
            $request->getContent(),
            true
        );
     

        $provider = new Provider();
        $provider->setNom($data["nom"]);
        $provider->setEmail($data["email"]);
        $provider->setAdresse($data["adresse"]);
        $provider->setTelephone1($data["telephone1"]);
        $provider->setTelephone2($data["telephone2"]);
        $provider->setFax($data["fax"]);
        $provider->setCode($data["code"]);
        $provider->setCreatedBy($current_user_username);
 
        
        //
        $this->entityManager->persist($provider);
        $this->entityManager->flush();
        $historyData = [
            'action' =>"Ajout",
            'target' => "Table des Providers",
            'description' => "Ajout de le Provider : ".$provider->getNom(),
        ];
        $this->historyManager->addHistory($historyData,$current_user_username);
        return $provider;
    }
   
    /**
     * @return array
     */
    public function getAllProviders(): array {
        $repository = $this->entityManager->getRepository(Provider::class);
        return $repository->findAll();
    }

    /**
     * @param Request $request
     * @return Provider|false
     */
    public function UpdateProvider(Request $request, $current_user_username,$id){
        $data = json_decode(
            $request->getContent(),
            true
        );
        $repository = $this->entityManager->getRepository(Provider::class);
        $provider = $repository->findOneBy(['id' => $id]);
        
        if(!$provider){
            return false;
        }
        if (array_key_exists("nom",$data))  $provider->setNom($data["nom"]);
        if (array_key_exists("email",$data)) $provider->setEmail($data["email"]);
        if (array_key_exists("adresse",$data)) $provider->setAdresse($data["adresse"]);
        if (array_key_exists("telephone1",$data)) $provider->setTelephone1($data["telephone1"]);
        if (array_key_exists("telephone2",$data)) $provider->setTelephone2($data["telephone2"]);
        if (array_key_exists("fax",$data)) $provider->setFax($data["fax"]);
        if (array_key_exists("code",$data)) $provider->setCode($data["code"]);
        $provider->setUpdatedBy($current_user_username);
        
        $date = new \DateTime() ;
        $date->setTimezone(new \DateTimeZone('Africa/Casablanca'));
        $provider->setUpdated($date);

        
       
 
        
        //
        $this->entityManager->persist($provider);
        $this->entityManager->flush();
        $historyData = [
            'action' =>"Modification",
            'target' => "Table des Providers",
            'description' => "Modification de le Provider : ".$provider->getNom(),
        ];
        $this->historyManager->addHistory($historyData,$current_user_username);
        return $provider;
    }

    public function FindProvider($id){
        $repository = $this->entityManager->getRepository(Provider::class);
        $provider = $repository->findOneBy(['id' => $id]);
        if(!$provider){
            return false;
        }
        return $provider;
    }
}