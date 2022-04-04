<?php

class FormController extends AppController{

    function render($f3){

        $error = array();

        if($this->f3->get('POST.submit') !==""){

            $audit = Audit::instance();
            $form = new Report($this->db);

            if($this->f3->get('POST.name') !== ""){
                $form->name = $this->f3->get('POST.name');
            }else{
                $error[] = "<span class='form-error'>Missing name<br /></span>";
            }

            if($audit->email($this->f3->get('POST.email'), MX)){
                $form->email = $this->f3->get('POST.email');
            }else{
                $error[] = "<span class='form-error'>Missing/Invalid email<br /></span>";
            }

            $ukphoneRegex = '/(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/i';
            
            if(preg_match($ukphoneRegex, $this->f3->get('POST.phone'))){
                $form->phone = $this->f3->get('POST.phone');
            }else{
                $error[] = "<span class='form-error'>Missing/Invalid UK phone number <br /></span>";
            }

            if($this->f3->get('POST.confirmed') == ""){
                $form->confirmed = "off";
            }
            else{
                $form->confirmed = $this->f3->get('POST.confirmed');
            }

        }
        else{
            $error[] = "Unknown error, please try again later";
        }

        if(!empty($error)){
            echo "<h3>Error: Unfortunately we couldn't capture your details!</h3>";
            foreach($error as $value){
                echo $value;
            }
            echo "<a href='javascript: history.go(-1)'>Go Back</a>";
        }
        else{
            $form->save();
            $this->f3->set('rsResult', $results);
            $template = new Template;
            echo $template->render('message.htm');
        }
    }
}