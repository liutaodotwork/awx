<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html> 
    <head>
        <style type="text/css">
            body {
                font-family: -apple-system,BlinkMacSystemFont,"Segoe UI","Roboto","Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
                font-size: 18px;
                position: relative;
            }

            #child {
                position: absolute;
                top: 40%;
                left: 38%;
            }
        </style>
    </head>
    <body>
        <div id="child">Loading...</div>

        <form id="stepUpForm" name="stepup" method="POST" action="<?= $url ?>" style="display:none;"> 
            <input type="hidden" name="JWT" value="<?= $jwt ?>" /> 
            <input type="hidden" name="MD" value="the_value_to_be_passed_to_return_url" /> 
            <input type="submit" name="continue" value="Continue" />
        </form> 
        <script type="text/javascript">
            setTimeout("stepUpForm.submit();", 1);
        </script>
   </body>
</html>
