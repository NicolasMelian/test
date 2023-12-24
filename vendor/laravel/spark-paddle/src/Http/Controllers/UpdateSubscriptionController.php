<?php

namespace Spark\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Laravel\Paddle\Exceptions\PaddleException;
use Spark\Spark;
use Spark\ValidPlan;

class UpdateSubscriptionController
{
    use RetrievesBillableModels;

    /**
     * Update the plan that the billable is currently subscribed to.
     *
     * @return void
     */
    public function __invoke(Request $request)
    {
        $billable = $this->billable();

        $subscription = $billable->subscription('default');

        if (! $subscription) {
            throw ValidationException::withMessages([
                '*' => __('This account does not have an active subscription.'),
            ]);
        }

        $request->validate([
            'plan' => ['required', new ValidPlan($request->billableType)],
        ]);

        Spark::ensurePlanEligibility(
            $billable,
            Spark::plans($billable->sparkConfiguration('type'))
                ->where('id', $request->plan)
                ->first()
        );

        try {
            if (config('spark.prorates')) {
                $subscription->prorate()
                    ->swapAndInvoice($request->plan);
            } else {
                $subscription->noProrate()
                    ->swapAndInvoice($request->plan);
            }

            session(['spark.flash.success' => __('Your subscription was successfully updated.')]);
        } catch (PaddleException $e) {
            report($e);

            throw ValidationException::withMessages([
                '*' => __('We are unable to process your payment. Please contact customer support.'),
            ]);
        }
    }
}
