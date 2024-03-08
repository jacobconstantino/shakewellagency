<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
</head>

<style type="text/css">
    .count_email {
        float: right;
        font-weight: 600;
        padding-right: 10px;
        font-size: 18px;
    }
    .count_email1 {
    
        position: absolute;
        top: 660px;
        left: 800px;
        bottom: 10px
    }

    .button--primary {
        text-align:center; 
        padding: 7px 16px; 
        gap: 8px; 
        width: 360px; 
        left: 600px; 
        top: 600px; 
        box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.02); 
        border-radius: 8px; 
        background: #32D291; 
        color: white; 
        text-decoration: none; 
        font-size: 20px; 
        cursor: pointer; 
        display: block;
        margin: 40px auto;
    }
  

</style>

<body style="background-color: #E0E0E0" >

<br> 
    <center>
        <table style="background-color: #ffffff; margin-top:20px;" cellpadding="0" cellspacing="0" height="100%" width="650">
            <tr>
                <td>
                    
                    <table style="margin-left: 15px; margin-right:15px; margin-top: 10px;  margin-bottom:20px;font-size: 20px; font-family: 'Inter',sans-serif" cellspacing="10" cellpadding="8">
                             <tr>
                                <td style=" font-family:'Inter',sans-serif; font-size: 20px;  ">
                                    <label style="color:#696969"> Hello, {{ $username }}! </label>
                                </td>
                            </tr>
                    
                            <tr>    
                                <td style="font-family: 'Inter',sans-serif; font-style: normal; font-size: 24px; line-height: 24px; text-align: center;">
                                <b>  Thank you for registering! We're thrilled to have you on board and can't wait for you to explore all the exciting features and benefits our app has to offer.</b>

                                </td>
                            </tr>


                            <tr>
                                <td style=" font-family:'Inter',sans-serif; font-size: 20px;  ">
                                    <label style="color:#696969"> As a token of our appreciation for choosing us, we're delighted to present you with a special voucher. Here are the details: </label>
                                </td>
                            </tr>


                            <tr>
                                <td style=" font-family:'Inter',sans-serif; font-size: 20px;  ">
                                    <label style="color:#696969"> Voucher Code : <b>{{ $voucher }} </b> </label>
                                </td>
                            </tr>

                    

                     
                            <tr>
                                <td style=" font-family:'Inter',sans-serif; font-weight: 400; font-size: 20px; color:#696969 ;margin-bottom:30px">
                                    Thanks, <br>
                                    ShakeWell Agency Team
                                </td>
                            </tr>
                        
                    
                        
                    </table>

        </table>
        </td>
        </tr>
        </table>
                                

        
    </center>
    <br>
    <br>

</body>

</html>