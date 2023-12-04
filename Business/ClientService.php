<?php

declare(strict_types=1);

namespace Business;

use Data\ClientDAO;
use Entities\Address;
use Entities\Client;

class ClientService
{
   private ClientDAO $clientDAO;

   public function __construct()
   {
      $this->clientDAO = new ClientDAO;
   }

   //This function returns a Client with the clientId as parameter
   public function getClientByClientId(int $clientId): ?Client
   {
      return $this->clientDAO->getClientByClientId($clientId);
   }

   public function createNewClient(Address $billingAddress, Address $shippingAddress): ?Client {
      return $this->clientDAO->insertNewClient($billingAddress, $shippingAddress);
   }


}