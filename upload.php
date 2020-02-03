<?php
if($_POST["name"]==""||$_POST["type"]==""||$_POST["position"]==""||$_POST["price"]==""||$_POST["updateType"]==""){
    $msg="update fail！Parameter is null!";
}else {
    try {
        $db = new PDO('mysql:host=localhost;dbname=test', "root", "root");

        //$dbh = null;
    } catch (PDOException $e) {

        $msg= "Update fail! Error!: " . $e->getMessage();
        $db = null;
        die();
    }
    if($db!=null) {

        $name = $db->quote($_POST["name"]);
        $position = $db->quote($_POST["position"]);
        $type = $db->quote($_POST["type"]);		
        $price = $_POST["price"];
		$inventory = $db->quote($_POST["inventory"]);	
        $f=true;
        if($_POST["updateType"]=="1") {
            try {

                $db->beginTransaction();
                $db->exec("insert into parts values (null, $name, $position,$type,$price,$inventory)");
                $rows = $db->query("select last_insert_id()");
                if ($rows->rowCount() > 0) {
                    $row = $rows->fetch();
                    $id = $row[0];
                }
                $db->commit();
                $db = null;
            } catch (Exception $e) {
                $db->rollBack();
                $db = null;
                $msg = "Update fail! Error: " . $e->getMessage();
                $f = false;
            }
        }else if($_POST["updateType"]=="2"){
            try {
                $id=$_POST['id'];
                $db->beginTransaction();
                $db->exec("update parts set name=$name where id=$id");
				$db->exec("update parts set position=$position where id=$id");
				$db->exec("update parts set type=$type where id=$id");
				$db->exec("update parts set price=$price where id=$id");
				$db->exec("update parts set inventory=$inventory where id=$id");
				$db->exec("update orderdetails set inventory=$inventory where partid=$id");
                $db->commit();
                $db = null;
            } catch (Exception $e) {
                $db->rollBack();
                $db = null;
                $msg = "Update fail! Error: " . $e->getMessage();
                $f = false;
            }
        }
    }
    if($f) {

        $path = "items/";        


        if (!file_exists($path)) {
            mkdir("$path", 0700);
        }

        if ($_FILES["filename"]["name"]) {
            $file1 = $_FILES["filename"]["name"];
            $file2 = $path . $id . ".jpg";
            $flag = 1;
        }
        if ($flag) $result = move_uploaded_file($_FILES["filename"]["tmp_name"], $file2);
        $msg="Update Success!";
    }
}
echo "<script language='javascript'>";
echo "alert(\"".$msg."\");";
if(isset($_POST['updateType'])&&$_POST['updateType']==2){
    $updateType=$_POST["updateType"];
    $name = $_POST["name"];
    $position = $_POST["position"];
    $type = $_POST["type"];
    $price = $_POST["price"];
	$inventory = $_POST["inventory"];
    echo "location='addPart.php?updateType=2&id=".$id."&name=".$name."&position=".$position."&type=".$type."&price=".$price."&inventory=".$inventory."'";
}else{
    echo "location='addPart.php?updateType=1'";
}
echo "</script>";
header('Location: admin.php');