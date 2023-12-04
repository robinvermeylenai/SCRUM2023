<?php

declare(strict_types=1);

namespace Business;


use Data\ActionCodeDAO;

use Entities\ActionCode;

class ActionCodeService
{
    private ActionCodeDAO $actionCodeDAO;

    public function __construct()
    {
        $this->actionCodeDAO = new ActionCodeDAO();
    }
    public function getAllActionCodes() : array
    {
        return $this->actionCodeDAO->getAllCodes();
    }
    public function addCode(ActionCode $actionCode) : void
    {
        $this->actionCodeDAO->addActionCode($actionCode);
    }
    public function updateCode(ActionCode $actionCode) : void
    {
        $this->actionCodeDAO->updateActionCode($actionCode);
    }
    public function checkIfUsable(int $id) : void
    {
        $this->actionCodeDAO->isActionCodeUsable($id);
    }


}