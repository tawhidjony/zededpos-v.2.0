<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseMessage;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{ use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function expense()
    {
        return view('expenses.module_page');
    }
    public function index()
    {
        $expense=Expense::orderBy('id' ,'desc')->paginate(10);
        return view('expenses.index',compact('expense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expense= New Expense();
        return view('expenses.create',compact('expense'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'employee_name' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $data = $request->all();
        $expense=Expense::create($data);
        if ($expense){
            return redirect()->Route('expenses.index')->with($this->create_success_message);
        }else{
            return redirect()->Route('expenses.create')->withInput()->with($this->create_fail_message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show($expense)
    {
        $expense=Expense::find($expense);
        return view('expenses.show',compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit( $expense)
    {
        $expense=Expense::find($expense);
        return view('expenses.edit',compact('expense'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_name' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);

        $data = $request->all();
        $expense=Expense::find($id);
        $expense->update($data);
        if ($expense){
            return redirect()->Route('expenses.index')->with($this->create_success_message);
        }else{
            return redirect()->Route('expenses.create')->withInput()->with($this->create_fail_message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy( $expense)
    {
        $expense = Expense::find($expense);

        if ($expense) {

            $expense->delete();
            return redirect()->route('expenses.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }
}
