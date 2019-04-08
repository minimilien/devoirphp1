<html>
	<head>
		<title>index</title>
		<meta charset="UTF-8"/>
		<link rel="stylesheet" type="text/css" href="index.css"/>
	</head>
	<body>
		<div class="titre0">
			Site de Maximilien Frat Leprince : Book of friends
		</div>
		<div class="potes">
			<form action="index.php" method="post">
				Insert name:
				<input type="text" name="name">
				<input type="submit">
			</form>
			<p><B>My friends: </B></p>
			<?php
				$liste = 'index.txt';
				$file = fopen( $liste, "a+" );
				if( $file != false ) {
					while(!feof($file)) {
						if(isset($_POST['filtre'])){
							$line=null;
							$filtre=$_POST['filtre'];
							$string=fgets($file);
							if(isset($_POST['begin'])){
								$pos=strpos($string,$filtre);
								if($pos==0){
									$line = strstr($string,$filtre);
								};
							}else{
								if(!empty(strstr($string,$filtre))){
									$line=$string;
								}
							};
						}else{
							$line=fgets($file);
						};
						if($line){
							echo "<li>$line</li>";
						};
					};
					if(isset($_POST['name'])){
						$name=$_POST['name'];
						echo "<li>$name</li>";
						fwrite($file,"$name\n");
					};
				 fclose($file);
				};
			?>
			<form action="index.php" method="post">
				<?php 
					if(isset($_POST['filtre'])){
						$filtre=$_POST['filtre'];
					}
				?>
				<input type="text" name="filtre">
				<?php 
					if(isset($_POST['begin'])){
						$begin=$_POST['begin'];
					};
				?>
				<input type="checkbox" name="begin" value="TRUE"> Only names begining with</input>
				<input type="submit" value ="filter">
			</form>
		</div>
	</body>
</html>