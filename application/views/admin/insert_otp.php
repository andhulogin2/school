                  <div class="form-group">
                    <label class="col-sm-4 control-label">OTP:</label>
                    <div class="col-sm-5">
                       <input  type="text" class="form-control" name="otp" id="otp"/>
                       <input value="<?php echo $this->session->userdata('otp');?>" id="recieved_otp" hidden />
                       <label id="errorMsg" style="display:none;color:red">Enter Valid OTP.</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-5">
                        <button type="button" class="btn btn-info" onclick="validate_otp();">Submit</button>
                    </div>
                </div>
