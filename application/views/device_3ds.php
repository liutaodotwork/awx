<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<html> 
    <body> 
        <form id="collectionForm" name="devicedata" method="POST" action="<?= $url ?>"> 
            <input type="hidden" id="Bin" name="Bin" value="<?= $bin ?>" /> 
            <input type="hidden" id="JWT" name="JWT" value="<?= $jwt ?>" /> 
            <input type="submit" name="continue" value="Continue" /> 
        </form> 
		<script type="text/javascript">
            setTimeout("collectionForm.submit();", 1);
		</script>
    </body> 
</html>
