<?php

class MainController extends AppController{

    function render(){

        $dbReport = new Report($this->db);
        $results = $dbReport->all()[0];

        $this->f3->set('rsResult', $results);
        $template = new Template;
        echo $template->render('about.htm');
    }

}