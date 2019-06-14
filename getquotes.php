<?php

  // The basic SELECT statement
  $select = 'SELECT id, joketext';
  $from   = ' FROM joke';
  $where  = ' WHERE TRUE';

  $placeholders = array();

  // Connect to database
  include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

  if ($_GET['author'] != '') // An author is selected
  {
    $where .= " AND authorid = :authorid";
    $placeholders[':authorid'] = $_GET['author'];
  }

  if ($_GET['category'] != '') // A category is selected
  {
    $from  .= ' INNER JOIN jokecategory ON id = jokeid';
    $where .= " AND categoryid = :categoryid";
    $placeholders[':categoryid'] = $_GET['category'];
  }

  if ($_GET['text'] != '') // Some search text was specified
  {
    $where .= " AND joketext LIKE :joketext";
    $placeholders[':joketext'] = '%' . $_GET['text'] . '%';
  }

  try
  {
    $sql = $select . $from . $where;
    $s = $pdo->prepare($sql);
    $s->execute($placeholders);
	if ($s->rowCount() == 0) {
		include 'no.jokes.php';
		exit();
	}
  }
  catch (PDOException $e)
  {
    $error = 'Error fetching jokes.';
    include 'error.html.php';
    exit();
  }

  foreach ($s as $row)
  {
    $jokes[] = array('id' => $row['id'], 'text' => $row['joketext']);
  }

  include 'jokes.html.php';

  ?>

