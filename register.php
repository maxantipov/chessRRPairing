<html>
<body>
		<form action="bd.php" method="post">
		Nombre de Usuario: <input type="text" name="usuario" required><br />
		Contraseña: <input type="password" name="pass" required><br />
		Nivel: <select name="nivel" required>
			<option value="miambro">Miembro</option>
		 	<option value="admin">Administrador</option>
			</select><br />
		<input type="submit" />
		</form>

</body>
</html>