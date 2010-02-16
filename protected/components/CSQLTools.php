<?php
/** 
 * @version V4.93 10 Oct 2006 (c) 2000-2009 John Lim (jlim#natsoft.com). All rights reserved.
 * Released under both BSD license and Lesser GPL library license. 
 * Whenever there is any discrepancy between the two licenses, 
 * the BSD license will take precedence. 
 *
 * Set tabs to 4 for best viewing.
 * 
*/

/*
 * Concept from daniel.lucazeau@ajornet.com. 
 *
 * @param db        Adodb database connection
 * @param tables    List of tables to join
 * @rowfields        List of fields to display on each row
 * @colfield        Pivot field to slice and display in columns, if we want to calculate
 *                        ranges, we pass in an array (see example2)
 * @where            Where clause. Optional.
 * @aggfield        This is the field to sum. Optional. 
 *                        Since 2.3.1, if you can use your own aggregate function 
 *                        instead of SUM, eg. $aggfield = 'fieldname'; $aggfn = 'AVG';
 * @sumlabel        Prefix to display in sum columns. Optional.
 * @aggfn            Aggregate function to use (could be AVG, SUM, COUNT)
 * @showcount        Show count of records
 *
 * @returns            Sql generated
 */
 
class CSQLTools
{

    public static function createPivotQuery($db, $tables, $rowfields, $colfield, $where=false, 
        $aggfield = false, $sumlabel='Sum ', $aggfn ='SUM', $showcount = true)
    {
        if ($aggfield) $hidecnt = true;
        else $hidecnt = false;

        if ($where) $where = "\nWHERE $where";
        //if (!is_array($colfield)) $colarr = $db->GetCol("select distinct $colfield from $tables $where order by 1");
        if (!$aggfield) $hidecnt = false;

        $sel = "$rowfields, ";
        if (is_array($colfield)) {
            foreach ($colfield as $k => $v) {
                $k = trim($k);
                if (!$hidecnt) {
                    $sel .= "\n\t$aggfn(CASE WHEN $v THEN 1 ELSE 0 END) AS \"$k\", ";
                }
                if ($aggfield) {
                    $sel .= "\n\t$aggfn(CASE WHEN $v THEN $aggfield ELSE 0 END) AS \"$sumlabel$k\", ";
                }
            } 
        } else {
            foreach ($colarr as $v) {
                if (!is_numeric($v)) $vq = $db->qstr($v);
                else $vq = $v;
                $v = trim($v);
                if (strlen($v) == 0    ) $v = 'null';
                if (!$hidecnt) {
                    $sel .= "\n\t$aggfn(CASE WHEN $colfield=$vq THEN 1 ELSE 0 END) AS \"$v\", ";
                }
                if ($aggfield) {
                    if ($hidecnt) $label = $v;
                    else $label = "{$v}_$aggfield";
                    $sel .= "\n\t$aggfn(CASE WHEN $colfield=$vq THEN $aggfield ELSE 0 END) AS \"$label\", ";
                }
            }
        }
        if ($aggfield && $aggfield != '1'){
            $agg = "$aggfn($aggfield)";
            $sel .= "\n\t$agg as \"$sumlabel$aggfield\", ";        
        }

        if ($showcount)
            $sel .= "\n\tSUM(1) as Total";
        else
            $sel = substr($sel,0,strlen($sel)-2);


        // Strip aliases
        $rowfields = preg_replace('/ AS (\w+)/i', '', $rowfields);

        $sql = "SELECT $sel \nFROM $tables $where \nGROUP BY $rowfields";

        return $sql;
    }

}
?>