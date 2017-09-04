<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<form action="<?php echo $action; ?>" method="POST" id="suntech_payment">
    <?php
    foreach($parameters as $key => $parameter) {
    ?>
    <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $parameter; ?>"/>
    <?php
    }
    ?>
</form>

<script type="text/javascript">
    document.getElementById("suntech_payment").submit();
</script>
</body>
</html>