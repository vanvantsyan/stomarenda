<?php

namespace App\Providers;

use App\Orders;
use App\CallQueries;
use App\Feedback;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin_layouts.admin', function ($view) {
            $order = new Orders();
            $unseen_orders = $order->where('seen', '0')->count();
            $unseen_orders = ($unseen_orders == 0) ? "" : $unseen_orders;

            // var_dump($unseen_orders);die('123');
            $call_queries = new CallQueries();
            $unseen_callqueries = $call_queries->where('seen', '0')->count();
            $unseen_callqueries = ($unseen_callqueries == 0) ? "" : $unseen_callqueries;

            $feedback = new Feedback();
            $unseen_feedback = $feedback->where('seen', '0')->count();
            $unseen_feedback = ($unseen_feedback == 0) ? "" : $unseen_feedback;
            $view->with('data', array(
                'unseen_orders' => $unseen_orders,
                'unseen_calls' => $unseen_callqueries,
                'unseen_feedback' => $unseen_feedback
            ));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
