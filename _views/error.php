<!DOCTYPE html>
<html>
<head>
	<title><?php echo project_title("Error"); ?></title>
</head>
<body>

<?php if(empty($error)) { ?>
	Erro não reconhecido.
<?php } else { ?>
	<?php echo $error; ?>
<?php } ?>


</body>
</html>
