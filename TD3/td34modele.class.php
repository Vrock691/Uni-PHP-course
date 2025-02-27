<?php

class ID {
    private $login = "valentin";
    private $password = "1234";

    public function verif($params_login, $params_password) {
        if ($this->login == $params_login && $this->password == $params_password) {
            return 1;
        } else {
            return 0;
        }
    }
}

?>