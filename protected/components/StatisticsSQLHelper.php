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
        $stmt = "select a.id, a.name, sum(p.amount) sum_p_amount, sum(t.amount) sum_t_amount
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
        $stmt = "select p.id p_id, p.date p_date, p.amount p_amount, aps.name aps_name, pt.name pt_name, eps.name eps_name, a.name a_name, t.counterparty t_counterparty
            from accounts a
            left join transactions t on a.id = t.account_id
            left join payments p on t.id = p.transaction_id
            left join subjects aps on aps.id = p.payer_subject_id
            left join subjects eps on eps.id = t.payer_subject_id
            left join payment_types pt on pt.id = p.payment_type_id
            where 1=1" . $where_a . $where_t . $where_p . $where_pt;
        return $stmt;
    }

}
?>

  
  
  
