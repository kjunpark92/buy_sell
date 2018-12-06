<?php 
    try
{
    $db = new PDO("mysql:host=localhost;dbname=buy_sell;charset=utf8",'root','root');
}
    catch (Exception $e)
{
    die('Error: '. $e->getMessage());
}
?>