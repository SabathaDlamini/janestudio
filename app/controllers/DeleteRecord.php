<?php

class DeleteRecord extends AppController{
    function render($f3){
        $f3->set('result', $this->db->exec('DELETE FROM contactus WHERE id=?', $f3->get('GET.id')));
        $template = new Template;
        echo $template->render('deleted.htm');

    }
}