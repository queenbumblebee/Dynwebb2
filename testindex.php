<?php
date_default_timezone_set('Europe/Stockholm');
include 'common.library.php';
include 'header.php';

echo "<p>Sort by<br />
      </p>
      <form name='sort' class='sort_form' action='testindex.php' method='post'>
      <select name = 'order'>
	  <option value='choose'>Make A Selection</option>
       <option value='title'>Title</option>
       <option value='date_time'>Date posted</option>
	   <option value='category'>Category</option>
       </select>
      <p><input type='submit' method='POST' name='submit' action='testindex.php' value='Update!' /></p>
      </div>
      </form>"
?>
<?php

$sort = @$_POST['order']; 
if (!empty($sort)) { // If you Sort it with value of your  select options
$query = "SELECT date_time, text, title, catid FROM blog
  ORDER BY '".$sort."' ASC";
  
  echo "Val.";
 
} else { // else if you do not pass any value from select option will return this
   $query = "SELECT date_time, text, title, catid FROM blog
  ORDER BY date_time DESC";
  
  echo "Inget val.";
  
}
$result = mysqli_query($conn, $query);
while (list($date, $text, $title, $catid) = mysqli_fetch_row($result)) {
	$query2 = "SELECT category FROM cat WHERE catid='$catid'";
	$result2 = mysqli_query($conn, $query2);
	while ($row2 = mysqli_fetch_array($result2)) {
		$cat = $row2['category'];
	}
	echo "<div class=blog_posts>
          <div class=blog_title><h2>$title</h2></div>
	      <div class=blog_content><p>$text</p></div>
	      <div class=blog_footer><p> $date <br> Category: $cat</p></div></div>";
}

?>

</body>
</html>
