<?php
namespace Users;
class Manager {
    public function newUser() {
        if (POST) {
            $this->getPostData();
            $this->validateData();
            if($heeftrechten and $isingelogt) {
                if ($ok) {
                    $this->RegisterUser();
                }
            } elseif(isingelogt) {
                //TODO niet genoeg rechten
            } else {
                redirect('index.php');
            }
        } else {
            $this->getRegistrationForm();
        }
    }

    private function getRegistrationForm() {
        
    }

    private function getPostData() {
        
    }

    private function validateData() {
        
    }

    private function RegisterUser() {
        
    }

}
