<?php

namespace App\Http\Controllers;

use App\Http\Requests\Example\ExampleStoreRequest;
use App\Models\Example;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $query = Example::orderBy('id', 'desc');
        if(request('search')) {
            $query->where('name', 'LIKE', '%'.request('search').'%');
        }
        // dd($query->get());
        return Inertia::render('Example/Index', [
            'examples' => $query->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Example/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExampleStoreRequest $request): RedirectResponse
    {
        
        \DB::beginTransaction();
        try {
            Example::create(request()->all());
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message', trans('messages.error_saving'))->with('type', 'error');
        }

        \DB::commit();
        return redirect()->route('example.index')->with('message', trans('messages.success_saving'))->with('type', 'success');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Example $example)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request): Response
    {
        $example = Example::find(request()->example_id);
        return Inertia::render('Example/Edit', [
            'example' => $example
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExampleStoreRequest $request, Example $example)
    {
        \DB::beginTransaction();
        try {
            $example = Example::find(request()->example_id);
            if(!$example) {
                return redirect()->back()->with('message', trans('messages.record_not_found'))->with('type', 'warning');
            }
            $example->update(request()->all());
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message', trans('messages.error_on_update'))->with('type', 'error');
        }

        \DB::commit();
        return redirect()->route('example.index')->with('message', trans('messages.updated_successfully'))->with('type', 'success');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): RedirectResponse
    {
        \DB::beginTransaction();
        try {
            $example = Example::find(request()->id);
            if(!$example) {
                return redirect()->back()->with('message', trans('messages.record_not_found'))->with('type', 'error');
            }
            $example->delete();
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->with('message', trans('messages.error_deleting'))->with('type', 'error');
        }

        \DB::commit();
        return redirect()->route('example.index')->with('message', trans('messages.deleted_successfully'))->with('type', 'success');
    }
}
