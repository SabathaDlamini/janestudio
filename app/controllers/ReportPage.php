<?php

class ReportPage extends AppController{
    function render($f3){
        $f3->set('result', $this->db->exec('SELECT * FROM contactus'));
        $template = new Template;
        echo $template->render('report.htm');
    }
}
