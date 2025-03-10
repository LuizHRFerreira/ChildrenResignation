<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\Message\MessageStoreRequest;
use App\Models\Example;
use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Inertia\Response;

class MessageController extends Controller
{

    public function index(){
        $query = Message::select('id','uuid', 'message')->orderBy('id');

        return Inertia::render('Message/Index', [
            'messages' => $query->paginate(10),
        ]);
    }

    public function create(){
        $query = Message::select('uuid', 'message');
        return Inertia::render('Message/Create',[
        'messages' => $query->get(),
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
            \Log::error($e->getMessage()); // Log the specific error message
            \Log::error($e->getTraceAsString()); // Log the stack trace
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
