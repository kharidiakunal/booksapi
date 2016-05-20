<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Book;

use Response;

class BooksController extends Controller
{
    //

	public function index(){
    	$books = Book::all(); //Not a good idea
    	//return $Books;
 		return Response::json([
         'message' => $this->transformCollection($books)
    	], 200);
	}

	public function show($id){
        $book = Book::find($id);
 
        if(!$book){
            return Response::json([
                'error' => [
                    'message' => 'Book does not exist'
                ]
            ], 404);
        }
 
        return Response::json([
                'data' => $this->transform($book)
        ], 200);
	}


	private function transformCollection($books){
    	return array_map([$this, 'transform'], $books->toArray());
	}
 
	private function transform($book){
    	return [
           'bookId' => $book['id'],
           'title' => $book['title'],
           'description' => $book['description'],
           'author' => $book['author'],
           'publisher' => $book['publisher'],
           'isbn' => $book['isbn'],           
           'amount' => $book['amount']   
        ];
	}


 	public function store(Request $request){
 
        if(! $request->title or ! $request->author or ! $request->publisher or ! $request->amount){
            return Response::json([
                'error' => [
                    'message' => 'Please Provide required data'
                ]
            ], 422);
        }
        
        $book = Book::create($request->all());
 
        return Response::json([
                'message' => 'Book Created Succesfully',
                'data' => $this->transform($book)
        ]);
    }

    public function update(Request $request, $id){ 
        
        $book = Book::find($id);
        if(!$book){
            return Response::json([
                'error' => [
                    'message' => 'Book does not exist'
                ]
            ], 404);
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->description = $request->description;
        $book->isbn = $request->isbn;                
        $book->amount = $request->amount;
        $book->save();
 
        return Response::json([
                'message' => 'Book Updated Succesfully'
        ]);
    }

  	public function destroy($id){
        
        $book = Book::find($id);
 
        if(!$book){
            return Response::json([
                'error' => [
                    'message' => 'Book does not exist'
                ]
            ], 404);
        }
        
        Book::destroy($id);

        return Response::json([
                'message' => 'Book Deleted Succesfully'
        ],200);        
    }
}