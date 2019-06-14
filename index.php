<?php
include_once $_SERVER['DOCUMENT_ROOT'] .
    '/projects/quotes/includes/magicquotes.inc.php';

include_once $_SERVER['DOCUMENT_ROOT'] .
    '/projects/quotes/includes/helpers.inc.php';


// Connect to database
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';


// Get authors and categories from database
try
{
  $result = $pdo->query('SELECT id, name FROM author ORDER BY name ASC');
}
catch (PDOException $e)
{
  $error = 'Error fetching authors from database!';
  include 'error.html.php';
  exit();
}

foreach ($result as $row)
{
  $authors[] = array('id' => $row['id'], 'name' => $row['name']);
}

try
{
  $result = $pdo->query('SELECT id, name FROM category ORDER BY name ASC');
}
catch (PDOException $e)
{
  $error = 'Error fetching categories from database!';
  include 'error.html.php';
  exit();
}

foreach ($result as $row)
{
  $categories[] = array('id' => $row['id'], 'name' => $row['name']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Quotes</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
    <h1 class="title">Ευφυολογήματα, Σοφά Λόγια, Αποφθέγματα</h1>
	
	<div id="left">
	  
	<div id="search">  
        <form name="myForm" id="myForm" action="" method="get">
            <p>Δείτε τα αποφθέγματα βάσει των παρακάτω κριτηρίων:</p>
            <p>
                <label for="author">Πρόσωπο:</label>
                <select name="author" id="author" onchange="showquotes()">
					<option value="">Όλα τα πρόσωπα</option>
                    <?php foreach ($authors as $author): ?>
                    <option value="<?php htmlout($author['id']); ?>"><?php
                    htmlout($author['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p>
                <label for="category">Κατηγορία:</label>
                <select name="category" id="category" onchange="showquotes()">
					<option value="">Όλες οι κατηγορίες</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?php htmlout($category['id']); ?>"><?php
                    htmlout($category['name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </p>	
            <p>
                <label for="text">Κείμενο που περιέχεται:</label>
                <input type="text" name="text" id="text" onkeyup="showquotes()">
            </p>
	    </form>	
	</div>
		
	<div id="image"></div>
	
	</div>
	
	
	<div id="right">
	  
	     <div id="quotes">
		
	     </div>
		
	</div>
	
<script>
function showquotes() {
  a = document.getElementById("author").value;
  b = document.getElementById("category").value;
  c = document.getElementById("text").value;
  str = "author=" + a + "&category=" + b + "&text=" + c;
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("quotes").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","getquotes.php?" + str);
  xmlhttp.send();
}
showquotes();
</script>
	   
  </body>
</html>

