<?php
class StatisticsSQLHelper
{
    public static function createStmt_1(){
        $where_a .= U::addwhere('a.id', '=', U::q('account_id'));
        $where_a .= U::addwhere('s.sum_amount', 'is', U::q('includeaccounts'));
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
        Yii::log('1x'.$where_a);
        Yii::log('2x'.$where_t);                            
        Yii::log('3x'.$where_p);
        $stmt = "select a.id, a.name, s.sum_amount 
            from accounts a
            left join (
            select t.account_id, sum(p.amount) sum_amount
            from payments p join transactions t on t.id = p.transaction_id
            where 1=1 " . $where_t . $where_p ." group by account_id ) s
            on a.id = s.account_id
            where 1=1 " . $where_a;
        return $stmt;
    }

    
    
    public static function createStmt_2(){
        Yii::log('1x'.U::q('account_id'));
        $where_a .= U::addwhere('a.id', '=', U::q('account_id'));
        $where_t .= U::addwhere('t.account_id', '=', U::q('account_id'));
        $where_t .= U::addwhere('t.recipient_subject_id', '=', U::q('recipient_subject_id'));
        $where_t .= U::addwhere('t.date_from', '=', U::q('date_from'));
        $where_t .= U::addwhere('t.date_to', '=', U::q('date_to'));
        $stmt = "select a.id, a.name, s.sum_amount 
            from accounts a
            left join (
            select t.account_id, sum(t.amount) sum_amount
            from transactions t where 1=1 " . $where_t . " group by account_id ) s
            on a.id = s.account_id
            where 1=1 " . $where_a;
        return $stmt;
    }

}
?>

  
  
  
