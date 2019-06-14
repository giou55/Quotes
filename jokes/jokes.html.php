<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/projects/mycms/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>List of Jokes</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
  </head>
  <body>
    <p class="h1">Ευφυολογήματα, Ατάκες, Σοφά Λόγια, Τσιτάτα, Αποφθέγματα, Γνωμικά, Ρητά</p>
    <?php foreach ($jokes as $joke): ?>
      <blockquote>
        <p>
          <?php htmlout($joke['text']); ?>
          (by <a href="mailto:<?php htmlout($joke['email']); ?>"><?php
              htmlout($joke['name']); ?></a>)
        </p>
      </blockquote>
    <?php endforeach; ?>
  </body>
</html>
