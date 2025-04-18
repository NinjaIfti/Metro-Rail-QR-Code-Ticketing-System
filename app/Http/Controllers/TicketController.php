<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Auth::user()->tickets()->orderBy('created_at', 'desc')->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new ticket.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Add stations data - customize as needed for your metro system
        $stations = ['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'];

        return view('tickets.create', compact('stations'));
    }

    /**
     * Store a newly created ticket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'from_station' => 'required|string',
            'to_station' => 'required|string|different:from_station',
            'journey_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required',
            'number_of_passengers' => 'required|integer|min:1',
            'payment_option' => 'required|in:pay_now,pay_later',
        ]);

        // Calculate fare based on from and to stations
        $fare = $this->calculateFare($request->from_station, $request->to_station, $request->number_of_passengers);

        // Calculate arrival time based on from and to stations
        $arrivalTime = $this->calculateArrivalTime($request->from_station, $request->to_station, $request->departure_time);

        // Determine payment status
        $paymentStatus = ($request->payment_option === 'pay_now') ? 'paid' : 'unpaid';

        // Create the ticket
        $ticket = new Ticket([
            'user_id' => Auth::id(),
            'ticket_number' => Ticket::generateTicketNumber(),
            'from_station' => $request->from_station,
            'to_station' => $request->to_station,
            'journey_date' => $request->journey_date,
            'departure_time' => $request->departure_time,
            'arrival_time' => $arrivalTime,
            'number_of_passengers' => $request->number_of_passengers,
            'fare' => $fare,
            'status' => 'active',
            'payment_status' => $paymentStatus,
        ]);

        $ticket->save();

        // Generate QR code
        $qrContent = json_encode([
            'ticket_number' => $ticket->ticket_number,
            'from' => $ticket->from_station,
            'to' => $ticket->to_station,
            'date' => $ticket->journey_date,
            'passengers' => $ticket->number_of_passengers,
            'payment_status' => $ticket->payment_status,
        ]);

        $qrCodePath = 'qrcodes/' . $ticket->ticket_number . '.svg';

        // Make sure the directory exists
        Storage::disk('public')->makeDirectory('qrcodes', 0755, true, true);

        $qrCode = QrCode::size(200)->generate($qrContent);
        Storage::disk('public')->put($qrCodePath, $qrCode);

        $ticket->qr_code = $qrCodePath;
        $ticket->save();

        if ($paymentStatus === 'paid') {
            return response()->json(['success' => true, 'message' => 'Ticket booked and paid successfully', 'ticket_id' => $ticket->id]);
        } else {
            return redirect()->route('tickets.index')->with('success', 'Ticket booked successfully! Payment is pending.');
        }
    }

    /**
     * Display the specified ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated user
        if ($ticket->user_id !== Auth::id()) {
            return redirect()->route('tickets.index')->with('error', 'Unauthorized access');
        }

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated user
        if ($ticket->user_id !== Auth::id()) {
            return redirect()->route('tickets.index')->with('error', 'Unauthorized access');
        }

        // Check if the ticket is still active and can be edited
        if ($ticket->status !== 'active') {
            return redirect()->route('tickets.index')->with('error', 'This ticket cannot be edited');
        }

        // Check if the ticket is paid
        if ($ticket->payment_status === 'paid') {
            return redirect()->route('tickets.index')->with('error', 'Paid tickets cannot be edited');
        }

        $stations = ['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'];

        return view('tickets.edit', compact('ticket', 'stations'));
    }

    /**
     * Update the specified ticket in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated user
        if ($ticket->user_id !== Auth::id()) {
            return redirect()->route('tickets.index')->with('error', 'Unauthorized access');
        }

        // Check if the ticket is still active and can be edited
        if ($ticket->status !== 'active') {
            return redirect()->route('tickets.index')->with('error', 'This ticket cannot be edited');
        }

        // Check if the ticket is paid
        if ($ticket->payment_status === 'paid') {
            return redirect()->route('tickets.index')->with('error', 'Paid tickets cannot be edited');
        }

        $request->validate([
            'from_station' => 'required|string',
            'to_station' => 'required|string|different:from_station',
            'journey_date' => 'required|date|after_or_equal:today',
            'departure_time' => 'required',
            'number_of_passengers' => 'required|integer|min:1',
        ]);

        // Calculate fare
        $fare = $this->calculateFare($request->from_station, $request->to_station, $request->number_of_passengers);

        // Calculate arrival time
        $arrivalTime = $this->calculateArrivalTime($request->from_station, $request->to_station, $request->departure_time);

        $ticket->from_station = $request->from_station;
        $ticket->to_station = $request->to_station;
        $ticket->journey_date = $request->journey_date;
        $ticket->departure_time = $request->departure_time;
        $ticket->arrival_time = $arrivalTime;
        $ticket->number_of_passengers = $request->number_of_passengers;
        $ticket->fare = $fare;

        $ticket->save();

        // Update QR code
        $qrContent = json_encode([
            'ticket_number' => $ticket->ticket_number,
            'from' => $ticket->from_station,
            'to' => $ticket->to_station,
            'date' => $ticket->journey_date,
            'passengers' => $ticket->number_of_passengers,
            'payment_status' => $ticket->payment_status,
        ]);

        $qrCodePath = 'qrcodes/' . $ticket->ticket_number . '.svg';
        $qrCode = QrCode::size(200)->generate($qrContent);
        Storage::disk('public')->put($qrCodePath, $qrCode);

        return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully!');
    }

    /**
     * Cancel the specified ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function cancel(Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated user
        if ($ticket->user_id !== Auth::id()) {
            return redirect()->route('tickets.index')->with('error', 'Unauthorized access');
        }

        // Check if the ticket is still active and can be cancelled
        if ($ticket->status !== 'active') {
            return redirect()->route('tickets.index')->with('error', 'This ticket cannot be cancelled');
        }

        // Check if the ticket is paid
        if ($ticket->payment_status === 'paid') {
            return redirect()->route('tickets.index')->with('error', 'Paid tickets cannot be cancelled in this demo');
        }

        $ticket->status = 'cancelled';
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Ticket cancelled successfully!');
    }

    /**
     * Process payment for a ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function processPayment(Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated user
        if ($ticket->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access']);
        }

        // Check if the ticket is still active
        if ($ticket->status !== 'active') {
            return response()->json(['success' => false, 'message' => 'This ticket cannot be paid for']);
        }

        // Check if the ticket is already paid
        if ($ticket->payment_status === 'paid') {
            return response()->json(['success' => false, 'message' => 'This ticket is already paid']);
        }

        // In a real application, you would process payment here
        // For this demo, we'll just mark the ticket as paid
        $ticket->payment_status = 'paid';
        $ticket->save();

        // Update QR code with new payment status
        $qrContent = json_encode([
            'ticket_number' => $ticket->ticket_number,
            'from' => $ticket->from_station,
            'to' => $ticket->to_station,
            'date' => $ticket->journey_date,
            'passengers' => $ticket->number_of_passengers,
            'payment_status' => $ticket->payment_status,
        ]);

        $qrCodePath = 'qrcodes/' . $ticket->ticket_number . '.svg';
        $qrCode = QrCode::size(200)->generate($qrContent);
        Storage::disk('public')->put($qrCodePath, $qrCode);

        return response()->json(['success' => true, 'message' => 'Payment processed successfully']);
    }

    /**
     * Display the view modal content for a ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function viewModal(Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated user
        if ($ticket->user_id !== Auth::id()) {
            return response('Unauthorized', 403);
        }

        return view('tickets.partials.view-modal', compact('ticket'));
    }

    /**
     * Display the edit modal content for a ticket.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function editModal(Ticket $ticket)
    {
        // Check if the ticket belongs to the authenticated user
        if ($ticket->user_id !== Auth::id()) {
            return response('Unauthorized', 403);
        }

        // Check if the ticket is still active and can be edited
        if ($ticket->status !== 'active') {
            return response('This ticket cannot be edited', 403);
        }

        // Check if the ticket is paid
        if ($ticket->payment_status === 'paid') {
            return response('Paid tickets cannot be edited', 403);
        }

        return view('tickets.partials.edit-modal', compact('ticket'));
    }

    /**
     * Calculate the fare based on stations and number of passengers.
     *
     * @param  string  $fromStation
     * @param  string  $toStation
     * @param  int  $passengers
     * @return float
     */
    private function calculateFare($fromStation, $toStation, $passengers)
    {
        // This is a simplified calculation
        // In a real application, you might have a more complex fare structure
        $stations = ['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'];

        $fromIndex = array_search($fromStation, $stations);
        $toIndex = array_search($toStation, $stations);

        $stationCount = abs($fromIndex - $toIndex);

        // Base fare is 20 taka, add 5 taka per station
        $baseFare = 20 + ($stationCount * 5);

        // Total fare for all passengers
        return $baseFare * $passengers;
    }

    /**
     * Calculate the arrival time based on stations and departure time.
     *
     * @param  string  $fromStation
     * @param  string  $toStation
     * @param  string  $departureTime
     * @return string
     */
    private function calculateArrivalTime($fromStation, $toStation, $departureTime)
    {
        // This is a simplified calculation
        // In a real application, you might have a more complex time calculation
        $stations = ['Uttara North', 'Uttara Center', 'Uttara South', 'Pallabi', 'Mirpur 11', 'Mirpur 10', 'Kazipara', 'Shewrapara', 'Agargaon', 'Farmgate', 'Karwan Bazar', 'Shahbag', 'Dhaka University', 'Bangladesh Secretariat', 'Motijheel'];

        $fromIndex = array_search($fromStation, $stations);
        $toIndex = array_search($toStation, $stations);

        $stationCount = abs($fromIndex - $toIndex);

        // Assume 3 minutes per station
        $minutesToAdd = $stationCount * 3;

        $departure = strtotime($departureTime);
        $arrival = date('H:i:s', strtotime("+{$minutesToAdd} minutes", $departure));

        return $arrival;
    }
}
