


<div id="contact_form">

    <h1>Contact us</h1>
    <?php
    echo form_open('contact/submit');
    echo form_input('name','Name', 'id="name"');
    echo form_input('email','Email' );
    $data = array('name'=> 'message','cols' => 30, 'rows' => 15); 
    echo form_textarea($data, 'Message', 'id="messahe"');
    echo form_open('submit','Submit', 'id="submit"');
    echo form_close();
    
    ?>
    
</div> end contact form






