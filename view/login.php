<?php 
session_start();
include("./route.php");

$conn = mysqli_connect("localhost", "root", "", "pra-ukk");

$id = $_POST['id'];
$password = $_POST['password'];

$administrators = mysqli_query(
	$conn,
	"SELECT * FROM petugas WHERE username='$id'"
);

$students = mysqli_query(
	$conn,
	"SELECT * FROM siswa WHERE nisn='$id'"
);

@$administrators_count = mysqli_num_rows($administrators);
@$students_count = mysqli_num_rows($students);

if ($administrators_count > 0){
	while ($administrator = mysqli_fetch_assoc($administrators)) {
		if (md5($password) == $administrator['password']) {
			$role = $administrator['level'];
			
			if ($role == "admin") {
				$_SESSION['id'] = $administrator['id_petugas'];
				$_SESSION['name'] = $administrator['nama_petugas'];
				$_SESSION['level'] = "admin";
				
				header("location:$index_admin");
			} else if ($role == "petugas") {
				$_SESSION['id'] = $administrator['id_petugas'];
				$_SESSION['name'] = $administrator['nama_petugas'];
				$_SESSION['level'] = "officer";

				header("location:$index_officer");
			} else {
				echo "
					<script>
						alert('Anda tidak memiliki akses untuk login!');
						window.location.href = '$login';
					</script>
				";
			}
		} else {
			echo "
				<script>
					alert('Password yang Anda masukkan salah!');
					window.location.href = '$login';
				</script>
			";
		}
	}
} else if ($students_count > 0){
	while ($student = mysqli_fetch_assoc($students)) {
		if ($password == $student['nis']) {
			$_SESSION['id'] = $student['nisn'];
			$_SESSION['name'] = $student['nama'];
			$_SESSION['level'] = "student";
			header("location:$index_student");
		} else {
			echo "
				<script>
					alert('NIS yang Anda masukkan salah!');
					window.location.href = '$login';
				</script>
			";
		}
	}
} else {
	echo "
		<script>
			alert('Akun tidak ditemukan!');
			window.location.href = '$login';
		</script>
	";
}

?>