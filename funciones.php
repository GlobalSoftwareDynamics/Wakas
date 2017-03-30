<?php
function conexion(){
	$con=mysql_connect("localhost","root","");
	if($con){
		$bd=mysql_select_db("wakas",$con);
		if(!$bd) echo "No existe la bd";
	}else{
		echo "No existe la conexión";
	}
}

function selectTable($tabla){
	$result=mysql_query("SELECT * FROM ".$tabla);
	return $result;
}

function selectOrderedTable($tabla,$campo){
	$result=mysql_query("SELECT * FROM ".$tabla." ORDER BY ".$campo);
	return $result;
}

function deleteRegistry($tabla,$field,$value){
	$result=mysql_query("DELETE FROM ".$tabla." WHERE ".$field." = ".$value);
	return $result;
}

function selectTableWhere($tabla,$field,$value){
	$result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value);
	return $result;
}

function selectTableWhereLike($tabla,$field,$value,$field1,$value1){
	$result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value." AND ".$field1." LIKE ".$value1);
	return $result;
}

function selectTableWhere2($tabla,$field,$value,$field2,$value2){
	$result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value." AND ".$field2." = ".$value2);
	return $result;
}

function selectTableWhere3($tabla,$field,$value,$field1,$value1,$field2,$value2){
	$result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value." AND ".$field1."=".$value1." AND ".$field2." = ".$value2);
	return $result;
}

function selectTableWhere4($tabla,$field,$value,$field1,$value1,$field2,$value2,$field3,$value3){
	$result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value." AND ".$field1."=".$value1." AND ".$field2." = ".$value2." AND ".$field3." = ".$value3);
	return $result;
}

function selectOrderedTableWhere($tabla,$field,$value,$campo){
	$result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value." ORDER BY ".$campo);
	return $result;
}

function selectOrderedTable1($tabla,$campo,$campo1){
	$result=mysql_query("SELECT * FROM ".$tabla." ORDER BY ".$campo." ASC,".$campo1." ASC");
	return $result;
}

function selectOrderedTableWhere1($tabla,$field,$value,$campo,$campo1){
	$result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value." ORDER BY ".$campo." ASC, ".$campo1." ASC");
	return $result;
	echo $result;
}

function selectTableWhereLikeSingle($tabla,$field,$value){
    $value1=strval($value);
    $value2=str_replace("'","",$value1);
    $result=mysql_query("SELECT * FROM $tabla WHERE $field LIKE '%$value2%'");
    return $result;
}

function insertData1($tabla,$field1,$value1){
	$result = mysql_query("INSERT INTO ".$tabla." (".$field1.") VALUES (".$value1.")");
	if($result){
		return $result;
	}else{
		echo "Error Insertando Datos";
		return null;
	}
}

function runQuery($query) {
    $result = mysql_query($query);
    while($row=mysql_fetch_assoc($result)) {
        $resultset[] = $row;
    }
    if(!empty($resultset))
        return $resultset;
}
