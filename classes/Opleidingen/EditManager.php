<?php
namespace Opleidingen;
class EditManager Extends Manager{
    public function __construct(&$database) {
        parent::__construct($database);
    }

    public function getEditForm(){
        return 'getEditForm';
    }

}
