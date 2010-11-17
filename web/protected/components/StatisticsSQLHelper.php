<?php
class StatisticsSQLHelper
{
    public static function createStmt_1(){
        Yii::log('xx'.Yii::app()->request->getParam('diff_payers'));
        $where_a .= U::addwhere('a.id', '=', U::q('account_id'));
        $where_t .= U::addwhere('t.account_id', '=', U::q('account_id'));
        $where_t .= U::addwhere('t.recipient_subject_id', '=', U::q('recipient_subject_id'));
        $where_t .= U::addwhere('t.payer_subject_id', '=', U::q('expected_payer_subject_id'));
        $where_t .= U::addwhere('t.counterparty', 'like', U::q('counterparty'), 'string');
        $where_t .= U::addwhere('t.description', 'like', U::q('description'), 'string');
        $where_t .= U::addwhere('t.ref_period_begin_date', '<=', U::q('ref_period_date_from'), 'date');
        $where_t .= U::addwhere('t.ref_period_begin_date', '>=', U::q('ref_period_date_to'), 'date');
        $where_p .= U::addwhere('p.payer_subject_id', '=', U::q('actual_payer_subject_id'));
        $where_p .= U::addwhere('p.payment_type_id', '=', U::q('payment_type_id'));
        $where_p .= U::addwhere('p.date', '>=', U::q('date_from'), 'date');
        $where_p .= U::addwhere('p.date', '<=', U::q('date_to'), 'date');
        $where_p .= U::addwhere('p.amount', '>=', U::q('amount_min'));
        $where_p .= U::addwhere('p.amount', '<=', U::q('amount_max'));
        $where_p .= U::addwhere('p.payer_subject_id <> t.payer_subject_id', '', U::q('diff_payers'), 'boolean');
        $where_pt .= U::addwhere('pt.statement', '=', U::q('statement'), 'string');
        $having .= U::addwhere(
            array(''=>'', 'notnull'=>'sum(p.amount) is not null', 'notzero'=>'sum(p.amount) > 0'), 
            'case', U::q('include_accounts'));
        $stmt = "select a.id, a.name, sum(p.amount) sum_p_amount, 
            sum(case (select max(id) from payments where transaction_id = t.id) when p.id then t.amount else 0 end) sum_t_amount
            from accounts a
            left join transactions t on a.id = t.account_id
            left join payments p on t.id = p.transaction_id
            left join payment_types pt on pt.id = p.payment_type_id  
            where 1=1" . $where_a . $where_t . $where_p . $where_pt .
            " group by a.id, a.name";        
         if ($having<>"") $stmt .= " having 1=1" . $having;
        return $stmt;
    }

    
    public static function createStmt_2(){
        Yii::log('xx'.Yii::app()->request->getParam('diff_payers'));
        $where_a .= U::addwhere('a.id', '=', U::q('account_id'));
        $where_t .= U::addwhere('t.account_id', '=', U::q('account_id'));
        $where_t .= U::addwhere('t.recipient_subject_id', '=', U::q('recipient_subject_id'));
        $where_t .= U::addwhere('t.payer_subject_id', '=', U::q('expected_payer_subject_id'));
        $where_t .= U::addwhere('t.counterparty', 'like', U::q('counterparty'), 'string');
        $where_t .= U::addwhere('t.description', 'like', U::q('description'), 'string');
        $where_t .= U::addwhere('t.ref_period_begin_date', '<=', U::q('ref_period_date_from'), 'date');
        $where_t .= U::addwhere('t.ref_period_begin_date', '>=', U::q('ref_period_date_to'), 'date');
        $where_p .= U::addwhere('p.payer_subject_id', '=', U::q('actual_payer_subject_id'));
        $where_p .= U::addwhere('p.payment_type_id', '=', U::q('payment_type_id'));
        $where_p .= U::addwhere('p.date', '>=', U::q('date_from'), 'date');
        $where_p .= U::addwhere('p.date', '<=', U::q('date_to'), 'date');
        $where_p .= U::addwhere('p.amount', '>=', U::q('amount_min'));
        $where_p .= U::addwhere('p.amount', '<=', U::q('amount_max'));
        $where_p .= U::addwhere('p.payer_subject_id <> t.payer_subject_id', '', U::q('diff_payers'), 'boolean');
        $where_pt .= U::addwhere('pt.statement', '=', U::q('statement'), 'string');
        $stmt = "select distinct t.id t_id, t.date t_date, a.name a_name, t.amount t_amount, t.counterparty t_counterparty, t.description t_description, rs.name rs_name, eps.name eps_name, t.ref_period_begin_date t_ref_period_begin_date, t.ref_period_end_date t_ref_period_end_date
            from transactions t 
            left join accounts a on a.id = t.account_id
            left join payments p on t.id = p.transaction_id
            left join subjects aps on aps.id = p.payer_subject_id
            left join subjects eps on eps.id = t.payer_subject_id
            left join subjects rs on rs.id = t.recipient_subject_id
            left join payment_types pt on pt.id = p.payment_type_id
            where 1=1" . $where_a . $where_t . $where_p . $where_pt;
        return $stmt;
    }

    public static function createStmt_3(){
        $where_p .= U::addwhere('p.transaction_id', '=', U::q('transaction_id'));
        $stmt = "select p.id p_id, p.date p_date, p.amount p_amount, aps.name aps_name, pt.name pt_name
            from payments p
            left join subjects aps on aps.id = p.payer_subject_id
            left join payment_types pt on pt.id = p.payment_type_id
            where 1=1" . $where_p;
        return $stmt;
    }

    public static function createStmt_3_new($count = false){
        $where_p .= U::addwhere('p.transaction_id', '=', U::q('transaction_id'));
        if ($count)
            $fields = "count(*)";
        else
            $fields = "p.id p_id, p.date p_date, p.amount p_amount, aps.name aps_name, pt.name pt_name";
        $from = "from payments p
            left join subjects aps on aps.id = p.payer_subject_id
            left join payment_types pt on pt.id = p.payment_type_id";
        $stmt = "select ".$fields." ".$from." where 1=1 ".$where_p;
        return $stmt;
    }

    public static function createStmt_SubjectBalance(){
        $where_t .= U::addwhere('t.ref_period_begin_date', '<=', U::q('ref_period_date_from'), 'date');
        $where_t .= U::addwhere('t.ref_period_begin_date', '>=', U::q('ref_period_date_to'), 'date');
        $stmt = <<<EOD
        select s2.name creditore, azione, s1.name debitore, importo from (

        select p_payer, 'ha pagato per ' as azione, t_payer, abs(sum_p_amount * mult) as importo from (
        SELECT sum(p.amount) sum_p_amount, t.payer_subject_id t_payer, p.payer_subject_id p_payer,
        case
        when t.payer_subject_id = 1 and p.payer_subject_id = 2 then -1
        when t.payer_subject_id = 2 and p.payer_subject_id = 1 then 1
        when t.payer_subject_id = 3 and p.payer_subject_id = 1 then 0.5
        when t.payer_subject_id = 3 and p.payer_subject_id = 2 then -0.5
        else null end as mult
        FROM transactions t
        join payments p on t.id = p.transaction_id
        where t.payer_subject_id <> p.payer_subject_id $where_p
        group by t.payer_subject_id, p.payer_subject_id
        ) x1

        union all

        select (case when sum(sum_p_amount * mult)>0 then 2 else 1 end)  as creditore,
        'in totale deve a' as azione,
        (case when sum(sum_p_amount * mult)>0 then 1 else 2 end) as debitore, abs(sum(sum_p_amount * mult)) as importo from (
        SELECT sum(p.amount) sum_p_amount, t.payer_subject_id t_payer, p.payer_subject_id p_payer,
        case
        when t.payer_subject_id = 1 and p.payer_subject_id = 2 then -1
        when t.payer_subject_id = 2 and p.payer_subject_id = 1 then 1
        when t.payer_subject_id = 3 and p.payer_subject_id = 1 then 0.5
        when t.payer_subject_id = 3 and p.payer_subject_id = 2 then -0.5
        else null end as mult
        FROM transactions t
        join payments p on t.id = p.transaction_id
        where t.payer_subject_id <> p.payer_subject_id $where_p
        group by t.payer_subject_id, p.payer_subject_id
        ) x2
        ) x
        join subjects s1 on x.t_payer = s1.id
        join subjects s2 on x.p_payer = s2.id
        ;
EOD;
        return $stmt;
    }


/*
select s2.name creditore, azione, s1.name debitore, importo from (

select p_payer, 'ha pagato per ' as azione, t_payer, abs(sum_p_amount * mult) as importo from (
SELECT sum(p.amount) sum_p_amount, t.payer_subject_id t_payer, p.payer_subject_id p_payer,
case
when t.payer_subject_id = 1 and p.payer_subject_id = 2 then -1
when t.payer_subject_id = 2 and p.payer_subject_id = 1 then 1
when t.payer_subject_id = 3 and p.payer_subject_id = 1 then 0.5
when t.payer_subject_id = 3 and p.payer_subject_id = 2 then -0.5
else null end as mult
FROM transactions t
join payments p on t.id = p.transaction_id
where t.payer_subject_id <> p.payer_subject_id
group by t.payer_subject_id, p.payer_subject_id
) x1

union all

select (case when sum(sum_p_amount * mult)>0 then 2 else 1 end)  as creditore,
'deve a' as azione,
(case when sum(sum_p_amount * mult)>0 then 1 else 2 end) as debitore, abs(sum(sum_p_amount * mult)) as importo from (
SELECT sum(p.amount) sum_p_amount, t.payer_subject_id t_payer, p.payer_subject_id p_payer,
case
when t.payer_subject_id = 1 and p.payer_subject_id = 2 then -1
when t.payer_subject_id = 2 and p.payer_subject_id = 1 then 1
when t.payer_subject_id = 3 and p.payer_subject_id = 1 then 0.5
when t.payer_subject_id = 3 and p.payer_subject_id = 2 then -0.5
else null end as mult
FROM transactions t
join payments p on t.id = p.transaction_id
where t.payer_subject_id <> p.payer_subject_id
group by t.payer_subject_id, p.payer_subject_id
) x2
) x
join subjects s1 on x.t_payer = s1.id
join subjects s2 on x.p_payer = s2.id
;
*/
}
?>

  
  
  
