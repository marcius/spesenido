<?php
return array("1" => array(
    "DROP PROCEDURE IF EXISTS TotalsByAccount",
    "CREATE DEFINER=`" . Yii::app()->db->username . "`@`localhost` ".
<<<EOD
PROCEDURE TotalsByAccount(
IN payer_subject_id INT,
IN recipient_subject_id INT
)
BEGIN
DECLARE stmtsql varchar(1000);

SET @stmtsql = "select a.id, a.name, s.sum_amount from accounts a
  left join (
    select t.account_id, sum(t.amount) sum_amount 
    from transactions t group by account_id ) s
    on a.id = s.account_id
  ";

PREPARE stmt from @stmtsql;

EXECUTE stmt;

END
EOD
    ), "2" => array(
    "ALTER TABLE payment_types ADD COLUMN statement VARCHAR(20) NOT NULL DEFAULT 'C/C bancario' AFTER name ",
    "UPDATE payment_types SET statement = name WHERE id IN (4, 5, 6)"



    )
    );
?>
