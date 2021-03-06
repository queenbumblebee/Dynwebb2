<?php
// Start session, check if user is logged in
session_start();
if(!isset($_SESSION['uid'])){
   header("Location:index.php");
}

date_default_timezone_set('Europe/Stockholm');
include 'common.library.php';
include 'header.php';

//Performs a query to database, shows list of posts and deletes selected post
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM blog WHERE id='$id'";
  $result = mysqli_query($conn, $query);
  if ((mysql_affected_rows() == 0) || (mysql_affected_rows() == -1)) {
	echo "Deleted!";
	}
	else {
		echo "Not deleted!";
	}
}

//Performs a query to database and shows list of posts
$query = "SELECT date_time, title, text, id FROM blog ORDER BY date_time DESC";
$result = mysqli_query($conn, $query);
while (list($date, $title, $text, $id) = mysqli_fetch_row($result)) {
  echo "<div class=blog_posts>
		<div class=blog_title><h2>$title</h2></div>
	    <div class=blog_content><p>$text</p></div>
	    <div class=blog_footer><a href=\"deletepost.php?id=$id\">Delete</a></div></div>";
}
?>
 
</body>
</html>
