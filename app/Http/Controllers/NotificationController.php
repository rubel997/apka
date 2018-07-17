<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationRequest;
use App\Invoice;
use App\Notification;
use App\Services\RoleService;
use App\Services\StatusService;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Notification $notifications
     * @return \Illuminate\Http\Response
     */
    public function index(Notification $notifications) {
        if (auth()->user()->role == RoleService::WORKER || auth()->user()->role == RoleService::CLIENT) {
            $notifications = $notifications->where(function ($q) {
                $q->where('client_id', auth()->user()->id)->orWhere('worker_id', auth()->user()->id);
            });
        }

        $notifications = $notifications->get();

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NotificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(NotificationRequest $request) {
        $validated = $request->validated();

        $validated['date'] = new Carbon();
        $validated['client_id'] = auth()->id();
        $validated['status'] = StatusService::REGISTERED;

        Notification::create($validated);

        session()->flash('status', ['type' => 'success', 'message' => 'Zgłoszenie utworzone']);

        return redirect()->route('notification.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification) {
        return view('notifications.show', compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification) {
        return view('notifications.edit', compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NotificationRequest $request
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function update(NotificationRequest $request, Notification $notification) {
        $validated = $request->validated();

        $notification->update($validated);

        session()->flash('status', ['type' => 'success', 'message' => 'Zgłoszenie zaktualizowane']);

        return redirect()->route('notification.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notification $notification
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Notification $notification) {
        $notification->delete();

        session()->flash('status', ['type' => 'success', 'message' => 'Zgłoszenie usunięte']);

        return redirect()->route('notification.index');
    }

    public function changeStatus(Notification $notification) {
        $notification->changeStatus();

        if ($notification->status === StatusService::COMPLETED) {
            return redirect()->route('notification.create.invoice', ['notification' => $notification->id]);
        }

        return redirect()->route('notification.index');
    }

    public function cancelStatus(Notification $notification) {
        $notification->status = StatusService::CANCELED;
        $notification->save();

        return redirect()->route('notification.index');
    }

    public function assignWorker(Notification $notification, User $workers) {
        $workers = $workers->where('role', RoleService::WORKER);

        if ($notification->client && $notification->client->street && $notification->client->street->region && $notification->client->street->region->id) {
            $regionId = $notification->client->street->region->id;

            $workers = $workers->whereHas('regions', function ($q) use ($regionId) {
                $q->where('id', $regionId);
            });
        }

        $workers = $workers->get();

        return view('notifications.worker', compact('notification', 'workers'));
    }

    public function storeWorker(Request $request, Notification $notification) {
        $notification->update([
            'worker_id' => $request->input('worker_id'),
            'status' => StatusService::PENDING
        ]);

        return redirect()->route('notification.show', ['id' => $notification->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function createInvoice(Notification $notification) {
        return view('invoices.create', compact('notification'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param Notification $notification
     * @return \Illuminate\Http\Response
     */
    public function storeInvoice(Request $request, Notification $notification) {
        $validated = $request->input();
        $validated['data'] = array_except($validated, ['_token']);
        $validated['notification_id'] = $notification->id;
        $validated['date'] = new Carbon();
        $validated['invoice_number'] = md5($validated['date']);

        // calculate sum
        $sum = 0;
        $keys = preg_grep('/price*/', array_keys($validated));
        foreach ($keys as $key) {
            $sum += array_get($validated, $key, 0);
        }

        $validated['sum'] = $sum;
        Invoice::create($validated);

        return redirect()->route('invoice.index');
    }

}
