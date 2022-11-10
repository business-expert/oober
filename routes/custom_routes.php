Route::group(array('prefix' => 'admin', 'middleware' => ['web','SentinelAdmin'],'as'=>'admin.'), function () {Route::resource('books', 'BooksController');
	Route::get('books/{id}/delete', array('as' => 'books.delete', 'uses' => 'BooksController@getDelete'));
	Route::get('books/{id}/confirm-delete', array('as' => 'books.confirm-delete', 'uses' => 'BooksController@getModalDelete'));
});