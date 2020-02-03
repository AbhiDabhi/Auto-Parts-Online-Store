<?php

    try {
        $db = new PDO('mysql:host=localhost;dbname=test', "root", "root");

        //$dbh = null;
    } catch (PDOException $e) {

        $msg= "Delete fail! Error!: " . $e->getMessage();
        $db = null;
        die();
    }
    if($db!=null) {

        $id=$_GET['id'];
        $f=true;

            try {

                $db->beginTransaction();
                $db->exec("update orderdetails set inventory=-2 where partid=$id");
				$db->exec("update parts set inventory=-2 where id=$id");
                $db->commit();
                $db = null;
            } catch (Exception $e) {
                $db->rollBack();
                $db = null;
                $msg = "Delete fail! Error: " . $e->getMessage();
                $f = false;
            }

    }
    if($f) {

        $path = "items/$id.jpg";    

        if (file_exists($path)) {
           unlink($path);
        }//END IF

        $msg="Delete Success!";
    }

echo "<script language='javascript'>";
echo "alert(\"".$msg."\");";
echo "location='admin.php'";
echo "</script>";