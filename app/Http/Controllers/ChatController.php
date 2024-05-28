<?php
namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ChatController extends Controller
{
    public $search = '';
    public function index()
    {
        $employee_id = Session::get('employee_id');
        $employees = Employee::all()->whereNotIn('employee_id', $employee_id);
        $messages = Message::with('sender')->get();
        if (Session::get("role") === "AD") {
            return view('admin.chat.index', compact('employees', 'messages'));
        } elseif (Session::get("role") === "NVNL") {
            return view('employee.chat.index', compact('employees', 'messages'));
        } elseif (Session::get("role") === "QLNL") {
            return view('material-management.chat.index', compact('employees', 'messages'));
        } elseif (Session::get("role") === "QLTP") {
            return view('product-management.chat.index', compact('employees', 'messages'));
        } elseif (Session::get("role") === "NVSP") {
            return view('employee_prod.chat.index', compact('employees', 'messages'));
        } elseif (Session::get("role") === "SX") {
            return view('production.chat.index', compact('employees', 'messages'));
        } else {
            return redirect()->back()->withErrors(['error' => 'Unauthorized access']);
        }
    }

    public function getMessages($employee_id)
    {
        $current_employee_id = Session::get('employee_id');
        $messages = Message::where(function ($query) use ($current_employee_id, $employee_id) {
            $query->where('sender_id', $current_employee_id)
                ->where('receiver_id', $employee_id);
        })->orWhere(function ($query) use ($current_employee_id, $employee_id) {
            $query->where('sender_id', $employee_id)
                ->where('receiver_id', $current_employee_id);
        })->with('sender', 'receiver')->get();

        return response()->json($messages);
    }

    public function broadcast(Request $request)
    {
        $message = new Message();
        $employee_id = Session::get('employee_id');
        $message->sender_id = $employee_id;
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;
        $message->save();

        broadcast(new PusherBroadcast($message))->toOthers();

        return response()->json([
            'status' => 'Message Sent!',
            'message' => view('partials.message', ['message' => $message])->render()
        ]);
    }


    public function receive(Request $request)
    {
        $message = new Message();
        $employee_id = Session::get('employee_id');
        $message->sender_id = $employee_id;
        $message->message = $request->message;
        $message->save();

        return view('partials.message', ['message' => $message]);
    }
}