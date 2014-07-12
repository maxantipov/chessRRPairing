<html>
<body>
		<form action="bd.php" method="post">
		Username: <input type="text" name="usuario" required><br />
		Password: <input type="password" name="pass" required><br />
		Nivel: <select name="nivel" required>
			<option value="miembro">Miembro</option>
		 	<option value="admin">Administrador</option>
			</select><br />
		<input type="submit" />
		</form>

</body>
</html>