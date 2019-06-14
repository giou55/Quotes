<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/projects/quotes/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
  </head>
  <body>
	  
    <?php if (isset($jokes)): ?>
      <table>
        <?php foreach ($jokes as $joke): ?>
		<tr>
          <td><?php htmlout($joke['text']); ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
	  
  </body>
</html>
