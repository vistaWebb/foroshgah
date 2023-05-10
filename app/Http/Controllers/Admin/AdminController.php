<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $successTransactions = Transaction::getData(1);
        $successTransactionsChart = $this->chart($successTransactions);

        $unsuccessTransactions = Transaction::getData(0);
        $unsuccessTransactionsChart = $this->chart($unsuccessTransactions);

        return view('admin.dashboard' , [
            'successTransactions' => array_values($successTransactionsChart),
            'unsuccessTransactions' => array_values($unsuccessTransactionsChart),
            'labels' => array_keys($successTransactionsChart),
            'transactionsCount' =>[$successTransactions->count() , $unsuccessTransactions->count()]
        ]);
    }

    public function chart($transactions)
    {
        $monthName = $transactions->map(function($item){
            return verta($item->created_at)->format('%B %y');
        });

        $amount = $transactions->map(function($item){
            return $item->amount;
        });

        foreach ($monthName as $i => $v) {
            if (!isset($result[$v])) {
                $result[$v] = 0;
            }
            $result[$v] += $amount[$i];
        }

        if (count($result) != 12) {
            for ($i = 0; $i < 12; $i++) {
                $monthName = verta()->subMonths($i)->format('%B %y');
                $shamsiMonths[$monthName] = 0;
            }
            return array_reverse(array_merge($shamsiMonths, $result));
        }

        return $result;
    }
}
