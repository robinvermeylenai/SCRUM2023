<?php

declare(strict_types=1);

namespace Business;

use Entities\Company;
use Data\CompanyDAO;
use Entities\Client;
use Entities\ContactPerson;

class CompanyService
{
   private CompanyDAO $companyDAO;

   public function __construct()
   {
      $this->companyDAO = new CompanyDAO;
   }

   public function getCompany(int $clientId): ?Company
   {
      return $this->companyDAO->getCompanyByClientId($clientId);
   }

   public function createNewCompany(Client $client, string $companyName, string $btwNumber): ?Company
   {
      return $this->companyDAO->insertNewCompany($client, $companyName, $btwNumber);
   }

  
}
