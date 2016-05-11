<?php
   // This file takes one GET variable 'file', and grabs the file from the
   // submissions of the currently logged-in team.
   include('config.php');
   
   header('Content-type: text/plain');
   if (!isset($_GET['file']))
   {
     echo 'no file selected';
     exit;
   }
   $file = $_GET['file'];
   if (empty($_SESSION['teamid']))
   {
     echo 'You must be logged in to view sources.';
     exit;
   }
   $teamid = $_SESSION['teamid'];
   if ($_SESSION['password'] != $g_teams[$teamid])
   {
     echo 'Team configuration has changed.  Please log in again.';
     unset($_SESSION['teamid']);
     unset($_SESSION['password']);
   }
   else 
   {
     $file_path = $g_submitpath . '/' . $teamid . '/' . $file;
     if (!file_exists($file_path))
     {
       echo 'source not found';
     }
     else
     {
       echo file_get_contents($file_path);
     }
   }
?> 
