<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html> 
   <body> 
        <form id="stepUpForm" name="stepup" method="POST" action="<?= $url ?>"> 
            <input type="hidden" name="JWT" value="<?= $jwt ?>" /> 
            <input type="hidden" name="MD" value="pa" /> 
            <input type="submit" name="continue" value="Continue" />
        </form> 
        <script type="text/javascript">
            setTimeout("stepUpForm.submit();", 1);
        </script>
   </body>
</html>
