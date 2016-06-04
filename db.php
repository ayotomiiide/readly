<?PHP
///////////////////////DATABASE CONNECTION///////////////
@mysql_connect("localhost","root","") or
die("Could not Connect");
mysql_select_db("readly") or
die("Could not Connect to a Database");
//////////////////////////////////////////////
?>