<footer>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<?php if(isset($data['script']))foreach($data['script'] as $k => $script){ ?>
<script src="<?php echo BASE_URL.$script['url']; ?>"></script>
<?php }?>

</footer>
</body>
</html>