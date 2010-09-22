<?php
  /* EXAMPLES USING MS NORTHWIND DATABASE */
if (0) {

# example1
#
# Query the main "product" table
# Set the rows to CompanyName and QuantityPerUnit
# and the columns to the Categories
# and define the joins to link to lookup tables 
# "categories" and "suppliers"
#

 $sql = PivotTableSQL(
     $gDB,                                              # adodb connection
     'products p ,categories c ,suppliers s',          # tables
    'CompanyName,QuantityPerUnit',                    # row fields
    'CategoryName',                                    # column fields 
    'p.CategoryID = c.CategoryID and s.SupplierID= p.SupplierID' # joins/where
);
 print "<pre>$sql";
 $rs = $gDB->Execute($sql);
 rs2html($rs);
 
/*
Generated SQL:

SELECT CompanyName,QuantityPerUnit, 
    SUM(CASE WHEN CategoryName='Beverages' THEN 1 ELSE 0 END) AS "Beverages", 
    SUM(CASE WHEN CategoryName='Condiments' THEN 1 ELSE 0 END) AS "Condiments", 
    SUM(CASE WHEN CategoryName='Confections' THEN 1 ELSE 0 END) AS "Confections", 
    SUM(CASE WHEN CategoryName='Dairy Products' THEN 1 ELSE 0 END) AS "Dairy Products", 
    SUM(CASE WHEN CategoryName='Grains/Cereals' THEN 1 ELSE 0 END) AS "Grains/Cereals", 
    SUM(CASE WHEN CategoryName='Meat/Poultry' THEN 1 ELSE 0 END) AS "Meat/Poultry", 
    SUM(CASE WHEN CategoryName='Produce' THEN 1 ELSE 0 END) AS "Produce", 
    SUM(CASE WHEN CategoryName='Seafood' THEN 1 ELSE 0 END) AS "Seafood", 
    SUM(1) as Total 
FROM products p ,categories c ,suppliers s  WHERE p.CategoryID = c.CategoryID and s.SupplierID= p.SupplierID 
GROUP BY CompanyName,QuantityPerUnit
*/
//=====================================================================

# example2
#
# Query the main "product" table
# Set the rows to CompanyName and QuantityPerUnit
# and the columns to the UnitsInStock for diiferent ranges
# and define the joins to link to lookup tables 
# "categories" and "suppliers"
#
 $sql = PivotTableSQL(
     $gDB,                                        # adodb connection
     'products p ,categories c ,suppliers s',    # tables
    'CompanyName,QuantityPerUnit',                # row fields
                                                # column ranges
array(                                        
' 0 ' => 'UnitsInStock <= 0',
"1 to 5" => '0 < UnitsInStock and UnitsInStock <= 5',
"6 to 10" => '5 < UnitsInStock and UnitsInStock <= 10',
"11 to 15"  => '10 < UnitsInStock and UnitsInStock <= 15',
"16+" =>'15 < UnitsInStock'
),
    ' p.CategoryID = c.CategoryID and s.SupplierID= p.SupplierID', # joins/where
    'UnitsInStock',                             # sum this field
    'Sum'                                        # sum label prefix
);
 print "<pre>$sql";
 $rs = $gDB->Execute($sql);
 rs2html($rs);
 /*
 Generated SQL:
 
SELECT CompanyName,QuantityPerUnit, 
    SUM(CASE WHEN UnitsInStock <= 0 THEN UnitsInStock ELSE 0 END) AS "Sum  0 ", 
    SUM(CASE WHEN 0 < UnitsInStock and UnitsInStock <= 5 THEN UnitsInStock ELSE 0 END) AS "Sum 1 to 5", 
    SUM(CASE WHEN 5 < UnitsInStock and UnitsInStock <= 10 THEN UnitsInStock ELSE 0 END) AS "Sum 6 to 10", 
    SUM(CASE WHEN 10 < UnitsInStock and UnitsInStock <= 15 THEN UnitsInStock ELSE 0 END) AS "Sum 11 to 15", 
    SUM(CASE WHEN 15 < UnitsInStock THEN UnitsInStock ELSE 0 END) AS "Sum 16+",
    SUM(UnitsInStock) AS "Sum UnitsInStock", 
    SUM(1) as Total 
FROM products p ,categories c ,suppliers s  WHERE  p.CategoryID = c.CategoryID and s.SupplierID= p.SupplierID 
GROUP BY CompanyName,QuantityPerUnit
 */
?>
