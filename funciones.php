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
function selectTableWhereLike1($tabla,$field,$value,$field1,$value1){
    $val=strval($value1);
    $value2=str_replace("'","",$val);
    $result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value." AND ".$field1." LIKE '%$value2%'");
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

function selectOrderedTableWhere2($tabla,$field,$value,$field1,$value1,$campo){
    $result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value." AND ".$field1." = ".$value1." ORDER BY ".$campo);
    return $result;
}

function selectOrderedTable1($tabla,$campo,$campo1){
	$result=mysql_query("SELECT * FROM ".$tabla." ORDER BY ".$campo." ASC,".$campo1." ASC");
	return $result;
}

function selectOrderedTableWhere1($tabla,$field,$value,$campo,$campo1){
	$result=mysql_query("SELECT * FROM ".$tabla." WHERE ".$field." = ".$value." ORDER BY ".$campo." ASC, ".$campo1." ASC");
	return $result;
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
function idgen($clase){
    date_default_timezone_set('America/Lima');
    $hora = date('H:i:s');
    $fecha = date('m/d/y');
    $hora=explode(":",$hora);
    $fecha=explode("/",$fecha);
    $aux="";
        switch ($hora[0]) {
            case 1:
                $aux = "A";
                break;
            case 2:
                $aux = "B";
                break;
            case 3:
                $aux = "C";
                break;
            case 4:
                $aux = "D";
                break;
            case 5:
                $aux = "E";
                break;
            case 6:
                $aux = "F";
                break;
            case 7:
                $aux = "G";
                break;
            case 8:
                $aux = "H";
                break;
            case 9:
                $aux = "I";
                break;
            case 10:
                $aux = "J";
                break;
            case 11:
                $aux = "K";
                break;
            case 12:
                $aux = "L";
                break;
            case 13:
                $aux = "M";
                break;
            case 14:
                $aux = "N";
                break;
            case 15:
                $aux = "P";
                break;
            case 16:
                $aux = "Q";
                break;
            case 17:
                $aux = "R";
                break;
            case 18:
                $aux = "S";
                break;
            case 19:
                $aux = "T";
                break;
            case 20:
                $aux = "U";
                break;
            case 21:
                $aux = "V";
                break;
            case 22:
                $aux = "W";
                break;
            case 23:
                $aux = "X";
                break;
            case 24:
                $aux = "Y";
                break;
        }
        switch ($fecha[0]) {
            case 1:
                $fecha[0] = "A";
                break;
            case 2:
                $fecha[0] = "B";
                break;
            case 3:
                $fecha[0] = "C";
                break;
            case 4:
                $fecha[0] = "D";
                break;
            case 5:
                $fecha[0] = "E";
                break;
            case 6:
                $fecha[0] = "F";
                break;
            case 7:
                $fecha[0] = "G";
                break;
            case 8:
                $fecha[0] = "H";
                break;
            case 9:
                $fecha[0] = "I";
                break;
            case 10:
                $fecha[0] = "J";
                break;
            case 11:
                $fecha[0] = "K";
                break;
            case 12:
                $fecha[0] = "L";
                break;
        }
    $id=$clase.$fecha[2].$aux.$hora[1].$hora[2].$fecha[0].$fecha[1];
    return $id;
}

function runQuery($query) {
    $result = mysql_query($query);
    while($row=mysql_fetch_assoc($result)) {
        $resultset[] = $row;
    }
    if(!empty($resultset))
        return $resultset;
}
