<script>
	$(".eliminar").click(function(){
		if (confirm("Seguro de eliminar?")){
			$(".eliminar").attr("href","http://localhost/miniframe/tareas/index");
		}else{
			return false;
		}
	});
</script>

</body>
</html>
