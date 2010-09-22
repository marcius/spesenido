<?php
class U
{
    public static function filled($string){
         $string = trim($string);
         if(is_numeric($string)) return TRUE;
         return !empty($string);
    }
    
    public static function q($param){
        return Yii::app()->request->getParam($param);
    }

    public static function getLimitClause($pagestart, $rowsperpage){
        if (U::filled($pagestart) && U::filled($rowsperpage)) {
            $rowstart = $pagestart * $rowsperpage - $rowsperpage;
            return " LIMIT ".$rowstart.", ".$rowsperpage;
        }
        else {
            return "";
        }
    }

    public static function getOrderBy($fieldname, $direction){
        if (!empty($fieldname) && !empty($direction)) {
            return " ORDER BY " . $fieldname . " " . $direction;
        }
        else {
            return "";
        }
    }

    public static function getJsonHeader($stmt, $pagestart, $rowsperpage){
        $response->records = Yii::app()->db->createCommand("SELECT count(*) from (".$stmt.") count")->queryScalar();

        if( $response->records > 0 ) {
            $response->total = ceil($response->records / $rowsperpage);
        } else {
            $response->total = 0;
        }
        $response->page = $pagestart;
        return $response;
    }
    
    public static function addwhere($field, $oper, $value, $type = "number", $and_or = "and"){
        if (empty($value)) return "";
        if ($oper == "is") {
            if ($value == "notnull") 
                $fvalue = "not null";
            elseif ($value == "null") 
                $fvalue = "null";
            else
                return "";
        } elseif ($oper == "case") {
            $fvalue = $field[$value]; $field = ""; $oper = "";
        } elseif ($type == "boolean" && $value == "true") {
            $fvalue = ""; $oper = "";
        } elseif ($type == "string" && $oper == "like") {
            $fvalue = "'%" . $value . "%'";
        } elseif ($type == "string") {
            $fvalue = "'" . $value . "'";
        } elseif ($type == "number") {
            $fvalue = $value;
        } elseif ($type == "date") {
            $fvalue = "'" . $value . "'";
        } else
            return "";
        return " " . $and_or . " " . $field . " " . $oper . " " . $fvalue;
    }
    
}
?>
