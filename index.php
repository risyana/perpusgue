<html>
	<head>
		<title>PerpusGue</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?
		include("db_conf.php");

		$mode = $_GET['mode']; 	// mode: '', add, update, delete
		$id = $_GET['id'];		// get record id for update and delete mode

		// get initial for update and delete mode
		$q = "select c_title, c_author, c_release_year from t_m_books where c_id='$id' ";
		$result=mysql_query($q);
		$value = mysql_fetch_row($result);
		if(!$value){
			echo mysql_error();
		}

		// properties for each modes
		$formVisible = "visibility: visible;";
		if (!$mode){
			$value = array('','','');
			$formVisible = "visibility: hidden;";
		}else if ($mode=='add'){
			$submit_btn = "Save";
		}else if ($mode=='update'){
			$submit_btn = "Update";
		}else if ($mode=='delete'){
			$submit_btn = "Delete";
			$disabled="disabled";
		}

		?>

		<h1><a href="/PerpusGue">Perpus Gue</a></h1>

		<div>
			<form style="<?echo $formVisible;?>" action="crud.php?mode=<?echo $mode;?>" method="POST">
				<input name='id' type="hidden" value="<?echo $id ?>" />
				<input name='title' type="text" placeholder="Title" value="<?echo $value[0]; ?>" <?echo $disabled;?>  autofocus autocomplete="off" required/> 
				<input name='author' type="text" placeholder="Author" value="<?echo $value[1]; ?>" <?echo $disabled;?>  autocomplete="off" required/> 
				<input name='year' type="number" min=1900 max=3000 placeholder="Year" value="<?echo $value[2]; ?>" <?echo $disabled;?>  autocomplete="off" required/> 
				<input type="submit" value=<?echo $submit_btn; ?> />
				<a href="/PerpusGue"><input type="button" value="Cancel" /></a>
			</form>

			<a id="add" class="btn" href="index.php?mode=add" title="Add Book"><img src='img/b_insrow.png'  /> Add </a>


			<div class='table-row'>
				<span class='table_med' id='head'>Title</span>
				<span class='table_med' id='head'>Author</span> 
				<span class='table_med' id='head'>Released </span> 
				<span class='table_small' id='head'>	
				</span> 
			</div>
			<?
			// Display Data
			$q = "select t.c_id, t.c_title, t.c_author, t.c_release_year from t_m_books t";
			$result = mysql_query($q);
			while($row=mysql_fetch_row($result)){
				echo "<div class='table-row'>";
					echo "<span class='table_med'><a href='http://google.com?#q=$row[1] $row[2]' target='_blank' >$row[1]</a></span>";
					echo "<span class='table_med'>".$row[2]."</span> ";
					echo "<span class='table_med'>".$row[3]."</span> ";
					echo "<span class='table_small'>";
						echo "<a class='btn' href='index.php?mode=update&id=$row[0]' title='Update Book' ><img src='img/b_edit.png' /></a> ";
						echo "<a class='btn' href='index.php?mode=delete&id=$row[0]' title='Delete Book' ><img src='img/b_drop.png'  /></a> ";
					echo "</span> ";
				echo "</div>";
			}
			?>
		</div>
	</body>
</html>
