<?php

namespace Opleidingen;
class DeleteManager Extends Manager{
    public function __construct(&$database) {
        parent::__construct($database);
    }

    public function getDeleteForm() {
        return 'getDeleteForm';
    }

}
