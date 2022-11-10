<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Lang;

class BooksController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$books = Book::latest()->get();
		return view('admin.books.index', compact('books'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.books.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

	    $book= new Book($request->except(''));
		
		$book->save();
		return redirect('admin/books')->with('success', Lang::get('message.success.create'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$book = Book::findOrFail($id);
		return view('admin.books.show', compact('book'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$book = Book::findOrFail($id);
		return view('admin.books.edit', compact('book'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$book = Book::findOrFail($id);

		

		
		$book->update($request->except(''));
		return redirect('admin/books')->with('success', Lang::get('message.success.update'));
	}

	/**
    	 * Delete confirmation for the given Book.
    	 *
    	 * @param  int      $id
    	 * @return View
    	 */
    	public function getModalDelete($id = null)
    	{
            $error = '';
            $model = '';
            $confirm_route =  route('admin.books.delete',['id'=>$id]);
            return View('admin/layouts/modal_confirmation', compact('error','model', 'confirm_route'));

    	}

    	/**
    	 * Delete the given Book.
    	 *
    	 * @param  int      $id
    	 * @return Redirect
    	 */
    	public function getDelete($id = null)
    	{
    		$book = Book::destroy($id);

            // Redirect to the group management page
            return redirect('admin/books')->with('success', Lang::get('message.success.delete'));

    	}

}