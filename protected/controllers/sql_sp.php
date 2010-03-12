<?php
return array(
"DROP PROCEDURE IF EXISTS TotalsByAccount",
<<<EOD
CREATE PROCEDURE TotalsByAccount (
IN payer_subject_id INT,
IN recipient_subject_id INT
)
BEGIN
DECLARE stmtsql varchar(1000);

SET @stmtsql = "select a.id, a.name, s.sum_amount from accounts a
left join
(select t.account_id tid, sum(t.amount) sum_amount from transactions t

group by account_id ) s
on a.id = s.account_id";

PREPARE stmt from @stmtsql;

EXECUTE stmt;

END
EOD
);
?>
