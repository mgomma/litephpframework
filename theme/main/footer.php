<footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<?php if(isset($data['script']))foreach($data['script'] as $k => $script){ ?>
<link rel="stylesheet" href="<?php echo BASE_URL.$script['url']; ?>">
<?php }?>

</footer>
</body>
</html>