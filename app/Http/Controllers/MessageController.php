<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Holding;
use App\Models\Message;
use App\Http\Requests\Message\MessageStoreRequest;

class MessageController extends Controller
{

    protected $limit;
    protected $highestId;
    protected $alert;

    public function __construct()
    {
        $this->limit = Holding::select('limit')->where('id', env('APP_ID'))->first();
        $this->highestId = Message::max('id');
        $this->alert = 0;
        if ($this->highestId > $this->limit->limit && $this->highestId !== null) {
            $this->alert = 1;
        }
    }

    public function index(){
        $messages = Message::withoutTrashed()
                           ->select('id', 'uuid', 'message')
                           ->orderBy('id');

        return Inertia::render('Message/Index', [
            'messages' => $messages->paginate(10),
            'alert' => $this->alert,
        ]);
    }

    public function create(){
        $query = Message::select('uuid', 'message');

        return Inertia::render('Message/Create',[
        'messages' => $query->get(),
        'alert' => $this->alert
        ]);
    }

    public function store(MessageStoreRequest $request): RedirectResponse{
        
        \DB::beginTransaction();

        try {
            $holdingId = env('APP_ID');            
            $message = new Message;
            $message->message = $request['message'];
            $message->uuid = $request['uuid'];
            $message->holding_id = $holdingId;
            $message->save();

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error("Error saving message:");
            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());
            return redirect()->back()->with('message', trans('messages.error_saving'))->with('type', 'error');
        }

        \DB::commit();
        return redirect()->back()->with('message', trans('messages.success_saving'))->with('type', 'success');

    }

    public function edit(string $message_uuid): Response|RedirectResponse { // Changed the return type here
        $message = Message::where('uuid', $message_uuid)->first();
        if(!$message){
          return redirect()->back()->with('message', trans('messages.record_not_found'))->with('type', 'error');
        }
        return Inertia::render('Message/Edit', [
            'message' => $message
        ]);
    }

    public function update(MessageStoreRequest $request, string $message_uuid): RedirectResponse {
        \DB::beginTransaction();
        try {
            $message = Message::where('uuid', $message_uuid)->first();
            if(!$message) {
                return redirect()->back()->with('message', trans('messages.record_not_found'))->with('type', 'warning');
            }
            $message->update($request->all());
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message', trans('messages.error_on_update'))->with('type', 'error');
        }

        \DB::commit();
        return redirect()->route('message.index')->with('message', trans('messages.updated_successfully'))->with('type', 'success');
        
    }

    public function destroy(Request $request): RedirectResponse{
        \DB::beginTransaction();
        try {
            $message = Message::find($request->id);
            if(!$message) {
                return redirect()->back()->with('message', trans('messages.record_not_found'))->with('type', 'error');
            }
            $message->delete();
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message', trans('messages.error_deleting'))->with('type', 'error');
        }

        \DB::commit();
        return redirect()->route('message.index')->with('message', trans('messages.deleted_successfully'))->with('type', 'success');
    }

}
