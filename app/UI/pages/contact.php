
<?php
require APPROOT . '/UI/inc/header.php';
?>
<?php
require APPROOT . '/UI/inc/navigation.php';
?>

        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-lg-offset-2">

                    <h1>Get in Touch</h1>

                    <h3>----------</h3>

                    <h3> If you have any questions regarding the Haarlem Festival, do not hesitate and get in touch! </br> Fields with * need to be filled in</h3>


                    <form id="contact-form" method="post" role="form">

                        <div class="messages"></div>

                        <div class="controls">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_name">First Name *</label>
                                        <input id="form_name" type="text" name="name" class="form-control"  required="required" data-error="Firstname is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_lastname">Last Name *</label>
                                        <input id="form_lastname" type="text" name="surname" class="form-control"  required="required" data-error="Lastname is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_email">Email *</label>
                                        <input id="form_email" type="email" name="email" class="form-control" required="required" data-error="Valid email is required.">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="form_phone">Phone Number</label>
                                        <input id="form_phone" type="tel" name="phone" class="form-control">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="form_message">Enter a Message *</label>
                                        <textarea id="form_message" name="message" class="form-control" rows="4" required="required" data-error="Please,leave us a message."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" name="ok" class="btn btn-send" value="Submit Message">
                                </div>
                            </div>
                        </div>

                    </form>
      
           <?php

            if(isset($_POST['ok'])){
                include_once('../../DAL/function.php');
                $obj = new Contact();
                $res = $obj->contact_us($_POST);
                if($res==true){
                    echo "<script>alert('Query successfully Submitted.Thank you')</script>";
                }else{
                    echo "<script>alert('Something Went wrong!!')</script>";
                }
            }
            
           ?>   
 
                </div><!-- /.8 -->

            </div> <!-- /.row-->

        </div> <!-- /.container-->

<?php
require APPROOT . '/UI/inc/footer.php';
?>
