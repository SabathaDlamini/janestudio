<?php

class Proccess extends DB\SQL\Mapper{

    public function __construct(DB\SQL $db){
        parent::__construct($db, 'contactus');
    }

    public function all(){
        $this->load();
        return $this->query;
    }
}