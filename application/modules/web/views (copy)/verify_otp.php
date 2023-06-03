    <div class="main-container container">
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="#">Verify OTP</a></li>
        </ul>
        
        <div class="row">
            <div id="content" class="col-sm-12">
                <div class="page-login forgotpassword">
                
                    <div class="account-border">
                        <div class="row">
                            
                            <form action="<?php echo base_url('reset-password'); ?>" >
                                <div class="col-sm-6 customer-login col-sm-offset-3">
                                    <div class="well">
                                        <h2><i class="fa fa-file-text-o" aria-hidden="true"></i> Verify the OTP & reset your password</h2>
                                        <p><strong>Recover your password by verifying your registered mobile no</strong></p>
                                        <div class="form-group">
                                            <label class="control-label">Enter the OTP here</label>
                                            <input type="text" name="otp"  class="form-control" />
                                        </div>
                                    </div>
                                    <div class="bottom-form">
                                        <a href="#" class="forgot">Resend OTP</a>
                                        <input type="submit" value="Verift OTP" class="btn btn-default pull-right" />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>