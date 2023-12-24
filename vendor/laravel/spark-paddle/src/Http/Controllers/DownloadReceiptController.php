<?php

namespace Spark\Http\Controllers;

use Illuminate\Http\Request;

class DownloadReceiptController
{
    use RetrievesBillableModels;

    /**
     * Download the given receipt.
     *
     * @param  string  $type
     * @param  string  $id
     * @param  string  $transactionId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function __invoke(Request $request, $type, $id, $transactionId)
    {
        $billable = $this->billable($type, $id);

        return $billable->transactions()->findOrFail($transactionId)->redirectToInvoicePdf();
    }
}
