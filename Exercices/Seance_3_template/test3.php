<?php
  include('template.php');
  
  $connect = mysql_connect("localhost", "root", "");
  mysql_select_db("database", $connect);

  // cette fois, on récupère aussi l'id de la ligne.
  $result = mysql_query("SELECT id, pseudo, email FROM table_users");

  // on créé une nouvelle instance de la classe Template

  $template = new Template("./"); // on indique en argument le chemin vers les modèles

  // modèle à utiliser auquel on adjoint un nom arbitraire

  $template->set_filenames( array('body' => 'template2.tpl'));

  // Assignation des variables

  $template->assign_vars( array(
      'NB_USERS' => mysql_num_rows($result)
  ));

  // on récupère la variable $mode.

  $mode = $HTTP_GET_VARS['mode'];

  // Assignation des variables dans le block 'user'

  while( $row = mysql_fetch_array($result) )
  {
      $template->assign_block_vars('user', array(
          'PSEUDO' => stripslashes($row['pseudo']),
          'EMAIL'  => $row['email']
      ));

	  // Si mode contient la chaine display, on affiche également l'id du membre.

      if( $mode == 'display' )
      {
          $template->assign_block_vars('user.id', array(
              'IDENTIFIANT' => $row['id']
          ));
      }
  }

  // Affichage des données

  $template->pparse('body');
?>