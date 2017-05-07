<?
include("db_conf.php");

$mode =$_GET['mode'];

$title=$_REQUEST['title'];
$author=$_REQUEST['author'];
$year=$_REQUEST['year'];
$id = $_REQUEST['id'];

if($mode=='add'){
	$q = "insert into t_m_books(c_title, c_author, c_release_year) values('$title','$author','$year')";
} else if($mode=='update'){
	$q = "update t_m_books set c_title = '$title',  c_author = '$author', c_release_year='$year' where c_id=$id ";
} else if($mode=='delete'){
	$q = "delete from t_m_books where c_id=$id ";
}

$result = mysql_query($q);

if(!$result){
	echo mysql_error();
}

header("Location: index.php");

?>