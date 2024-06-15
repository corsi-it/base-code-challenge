<?php

namespace App\Http\Controllers\Web;

use App\Enums\StockRequestStatusEnum;
use App\Helpers\ItemsHelper;
use App\Helpers\StockRequestsHelper;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\StockRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

// Make sure to use the correct model

class StockRequestsController extends Controller
{
    public function index()
    {
        $stockRequests = StockRequest::with('item')
            ->with('requestedBy')
            ->get();
        return Inertia::render('StockRequests/Index', [
            'stockRequests' => $stockRequests,
        ]);
    }

    public function create()
    {
        return Inertia::render('StockRequests/Create');
    }

    public function store(
        Request             $request,
        StockRequestsHelper $stockRequestsHelper,
        ItemsHelper         $itemsHelper
    )
    {
        $validatedData = $request->validate([
            'item_id'     => 'required',
            'quantity'    => ['required', 'not_in:0', function ($attribute, $value, $fail) use ($request, $stockRequestsHelper, $itemsHelper) {
                $requestType = $request->input('requestType');
                if ($requestType == 'sell' && (!$request->has('start_date') || !$request->has('end_date'))) {
                    $fail('The start date and end date are required for sell requests.');
                }

                $startDate = $request->input('start_date');
                $endDate = $request->input('end_date');

                $startDateObj = \DateTime::createFromFormat('Y-m-d', $startDate);
                $endDateObj = \DateTime::createFromFormat('Y-m-d', $endDate);

                $allDates = $stockRequestsHelper->getDates($startDateObj, $endDateObj);
                $itemId = $request->input('item_id');
                $item = Item::find($itemId);
                if (!$item) {
                    $fail('Item not found');
                }

                foreach ($allDates as $date) {
                    $canOnDate = $itemsHelper->canBeRequestedOnDate(
                        $item,
                        $value,
                        $date
                    );
                    if (!$canOnDate) {
                        $fail('Not enough orderable stock for the requested quantity on ' . $date->format('Y-m-d'));
                    }
                }


            }],
            'requestType' => 'required',
            'start_date'  => 'required_if:requestType,sell',
            'end_date'    => 'required_if:requestType,sell',
        ]);

        $currentUser = auth()->user();
        $validatedData['requested_by'] = $currentUser->id;
        $validatedData['status'] = StockRequestStatusEnum::PENDING;
        if ($validatedData['requestType'] == 'sell' && $validatedData['quantity'] > 0) {
            $validatedData['quantity'] = $validatedData['quantity'] * -1;
        }

        $stockRequest = StockRequest::create($validatedData);
        return redirect()->route('stockRequests.index');
    }

    public function show(StockRequest $stockRequest)
    {
        return view('StockRequests.show', compact('stockRequest'));
    }

    public function edit(StockRequest $stockRequest)
    {
        return view('StockRequests.edit', compact('stockRequest'));
    }

    public function update(Request $request, StockRequest $stockRequest)
    {
        $stockRequest->update($request->all());
        return redirect()->route('StockRequests.index');
    }

    public function destroy(StockRequest $stockRequest)
    {
        $stockRequest->delete();
        return redirect()->route('stockRequests.index');
    }
}
