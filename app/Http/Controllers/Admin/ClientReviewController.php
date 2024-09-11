<?php

namespace App\Http\Controllers\Admin;

use App\Models\ClientReview;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;

class ClientReviewController extends Controller
{
    public function addReview()
    {
        return view('admin.client.add-review');
    }

    public function storeReview(Request $request)
    {
        $clientReview = new ClientReview;
        $clientReview->name = $request->name;
        $clientReview->designation = $request->designation;
        $clientReview->review = $request->review;
        if ($request->file('image')){
            $file=$request->file('image');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION)) ;
            $destinationPath = 'images/client/' ;
            $file->move($destinationPath,$fileName);
            $clientReview->image = $fileName;
        }
        $clientReview->save();
        Session::flash('message', 'Record added successfully');
        return redirect()->back();
    }

    public function reviewList()
    {
        $clientReviews = ClientReview::get();
        return view('admin.client.review_list',['clientReviews'=>$clientReviews]);
    }

    public function reviewEdit($id)
    {
        $clientReview = ClientReview::find($id);
        return view('admin.client.review_edit',['clientReview'=>$clientReview]);
    }

    public function reviewUpdate(Request $request, $id)
    {
        $clientReview = ClientReview::find($id);
        $clientReview->name = $request->name;
        $clientReview->designation = $request->designation;
        $clientReview->review = $request->review;
        $clientReview->image = $request->image;
        if ($request->file('image')){
            $file=$request->file('image');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION));
            $destinationPath = 'images/client/' ;
            $file->move($destinationPath,$fileName);
            $image = $fileName;
            $clientReview->image=$image;
        }
        $clientReview->update();
        Session::flash('message', 'Record uddated successfully');
        return back();
    }

    public function reviewDelete($id)
    {
        ClientReview::destroy($id);
        Session::flash('message', 'Record deleted successfully');
        return back();
    }
}
