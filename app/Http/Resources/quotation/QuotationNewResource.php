<?php

namespace App\Http\Resources\quotation;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotationNewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'status' => $this->status,
            'type' => $this->type,
            'date' => $this->date,
            'invoice_date' => $this->invoice_date,
            'due_date' => $this->due_date,
            'subtotal' => $this->getSaleSubtotal(),
            'total' => $this->getSaleTotal(),
            'iva' => $this->getSaleIva(),
            'invoice' => $this->saleInvoice(),
            'remission' => $this->saleRemission(),
            'note' => $this->note,
            'pdf' => $this->pdf,
            'bar' => $this->bar,
            'printed' => $this->printed,
            'price_list' => new PriceListResource($this->company->priceList),
            'rejection_comment' => $this->rejection_comment,
            'production_dispatched' => $this->production_dispatched,
            'items' => QuotationItemMinResource::collection($this->quotationItems),
            'company' => new CompanyResource($this->company),
            'user' => new UserLightResource($this->user),
            'contact' => new ContactMinResource($this->contact),
            'rejection' => new RejectionResource($this->rejection),
            'created_by_user_id' => new UserMinResource(User::findOrFail($this->created_by_user_id)),
            'last_updated_by_user_id' => new UserMinResource(User::findOrFail($this->last_updated_by_user_id)),
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'updated_at' => date('d-m-Y H:i:s', strtotime($this->updated_at)),
            'payments' => $this->collectionDetails->sum('amount'),
            'due_balance' => $this->getDueBalance(),
            'past_due_balance' => $this->getPastDueBalance(),
            'balance_due_date' => Carbon::parse($this->date)->addDays($this->company->credit_days),
            'balance_due_days' => $this->when($this->getBalanceDueDays() > $this->company->credit_days, $this->getBalanceDueDays()),
            'days_after_invoice_date' => $this->when($this->invoice_date!=null, (double)date_diff(Carbon::parse($this->invoice_date), now())->format('%R%a')),
            'payment_status' => $this->getPaymentStatus(),
            'sale_total_weight' => $this->getSaleTotalWeight(),
            'shipping_date' => $this->when($this->getCompletedShipping(),  $this->getShippingDate()),
            'utility' => $this->getUtility(),
            //'pdf_delivered' => $this->shippingDetail->id(),
            'is_in_production' => $this->is_in_production
        ];
    }
}
