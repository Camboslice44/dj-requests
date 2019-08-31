<!DOCTYPE html>
<html>
<head>
	<title>DJ Request(er)</title>
	<meta name="description" content="DJ requester">
	<meta name="author" content="André Wisén">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head> 
<body>
	<div style="text-align: center;">
    <div style="display: inline-block; text-align: left;">
		<header></header>
		<h1 style="font-size:4vw;">Requests</h1>
		<div style="font-size:2vw;">
		<?php
			// Refresh URL
			$url1=$_SERVER['REQUEST_URI'];
			header("Refresh: 5; URL=$url1");

			// No Cache
			header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
			header("Cache-Control: post-check=0, pre-check=0", false);
			header("Pragma: no-cache");

			$songs= array();
			$output= array();

			$fh = fopen('../requests.txt','r');
			while ($line = fgets($fh)) {
				array_push($songs,$line);
			}

			fclose($fh);
			//print_r($songs);

			foreach ($songs as &$song) {
				$tempSong = "";

				// print_r($song);
				$tmp = array_count_values($songs);
				$cnt = $tmp[$song];
				// print_r($cnt);
				
				$tempSong .= $cnt . ": " .$song;
				array_push($output,$tempSong);
			}
			
			$output = array_unique($output);
			rsort($output);

			unset($value); // break the reference 
			unset($song);

			foreach ( $output as $line ) {
				echo $line . "<br/>";
			}

			function clearTxt(){
				// echo "Reqeusts purged!";
				$fh = fopen('../requests.txt','w');
				//fwrite($fh,"");
				fclose($fh);
				header("Refresh:0");
			}

			if(array_key_exists('purgeRequests',$_POST)){
				clearTxt();
			}
		?>
		</div>
		<br><br>
		<div>
			<form method="post">
				<input type="submit" name="purgeRequests" id="purgeRequests" value="Purge" /><br/>
			</form>
			<br>
			<form action="../">
				<input type="submit" value="Back" />
			</form>
		</div>
	</div>
	</div>
</body>
</html>