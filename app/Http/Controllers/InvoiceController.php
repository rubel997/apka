<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Notification;
use App\Services\RoleService;
use Dompdf\Dompdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Invoice $invoices
     * @param Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function index(Invoice $invoices, Notification $notification) {
        if (auth()->user()->role == RoleService::WORKER || auth()->user()->role == RoleService::CLIENT) {
            $notification = $notification->where('client_id', auth()->id())->orWhere('worker_id', auth()->id())->get()->pluck('id');
            $invoices = $invoices->whereIn('notification_id', $notification);
        }

        $invoices = $invoices->get();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Invoice $invoice
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Invoice $invoice) {
        $invoice->delete();

        session()->flash('status', ['type' => 'success', 'message' => 'Faktura usunięta']);

        return redirect()->route('invoice.index');
    }

    /**
     * Generate invoice pdf
     *
     * @param Invoice $invoice
     * @param Dompdf $pdf
     * @return void
     * @throws \Throwable
     */
    public function generateInvoice(Invoice $invoice, Dompdf $pdf) {
        $notification = collect($invoice->notification)->only(['date', 'description'])->toArray();
        $client = collect($invoice->notification->client)->only([
            'name',
            'last_name',
            'email',
            'phone_number',
            'house_number',
            'apartment_number'
        ])->toArray();

        if (!empty($invoice->notification->client->street)) {
            $client['street'] = $invoice->notification->client->street->name;
        }

        $worker = collect($invoice->notification->worker)->only([
            'name',
            'last_name',
            'email',
            'phone_number'
        ])->toArray();
        $invoice = collect($invoice)->only(['invoice_number', 'date', 'sum', 'data'])->toArray();

        $view = view('vendor.pdf', compact('invoice', 'notification', 'client', 'worker'))->render();
        $pdf->loadHtml($view);

        // (Optional) Setup the paper size and orientation
        $pdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $pdf->render();

        // Output the generated PDF to Browser
        return $pdf->stream();
    }
}
