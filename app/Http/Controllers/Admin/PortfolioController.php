<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\PortfolioType;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Session;

class PortfolioController extends Controller
{
    public function addType()
    {
        return view('admin.portfolio.add_type');
    }

    public function storeType(Request $request)
    {
        $portfolioType = new PortfolioType;
        $portfolioType->title = $request->title;
        $portfolioType->status = $request->status;
        $portfolioType->save();
        Session::flash('message', 'Record added successfully');
        return redirect()->back();
    }

    public function typeList()
    {
        $portfolioTypes = PortfolioType::get();
        return view('admin.portfolio.add_type_list',['portfolioTypes'=>$portfolioTypes]);
    }

    public function typeEdit($id)
    {
        $portfolioType = PortfolioType::find($id);
        return view('admin.portfolio.add_type_edit',['portfolioType'=>$portfolioType]);
    }

    public function typeUpdate(Request $request, $id)
    {
        $portfolioType = PortfolioType::find($id);
        $portfolioType->title = $request->title;
        $portfolioType->status = $request->status;
        $portfolioType->update();
        Session::flash('message', 'Record uddated successfully');
        return back();
    }

    public function typeDelete($id)
    {
        PortfolioType::destroy($id); // 1 way
        Session::flash('message', 'Record deleted successfully');
        return back();
    }

    public function addPortfolio()
    {
        $portfolioTypes = PortfolioType::where('status','active')->get();
        return view('admin.portfolio.add_portfolio',['portfolioTypes' => $portfolioTypes]);
    }

    public function storePortfolio(Request $request)
    {
        $portfolio = new Portfolio;
        $portfolio->type_id = $request->type_id;
        $portfolio->title = $request->title;
        if ($request->file('image')){
            $file=$request->file('image');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION)) ;
            $destinationPath = 'images/portfolio/' ;
            $file->move($destinationPath,$fileName);
            $portfolio->image = $fileName;
        }
        $portfolio->link = $request->link;
        $portfolio->status = $request->status;
        $portfolio->save();
        Session::flash('message', 'Record added successfully');
        return redirect()->back();
    }

    public function typePortfolioList()
    {
        $portfolios = Portfolio::get();
        return view('admin.portfolio.add_portfolio_list',['portfolios'=>$portfolios]);
    }

    public function typePortfolioEdit($id)
    {
        $portfolio = Portfolio::find($id);
        $portfolioTypes = PortfolioType::where('status','active')->get();
        return view('admin.portfolio.add_portfolio_edit',['portfolio'=>$portfolio,'portfolioTypes'=>$portfolioTypes]);
    }

    public function typePortfolioUpdate(Request $request, $id)
    {
        $portfolio = Portfolio::find($id);
        $portfolio->type_id = $request->type_id;
        $portfolio->title = $request->title;
        $portfolio->image = $request->image;
        $portfolio->link = $request->link;
        $portfolio->status = $request->status;
        if ($request->file('image')){
            $file=$request->file('image');
            $fileName = md5(uniqid(rand(), true)).'.'.strtolower(pathinfo($file->getClientOriginalName(),PATHINFO_EXTENSION));
            $destinationPath = 'images/portfolio/' ;
            $file->move($destinationPath,$fileName);
            $image = $fileName;
            $portfolio->image=$image;
        }
        $portfolio->update();
        Session::flash('message', 'Record uddated successfully');
        return back();
    }

    public function typePortfolioDelete($id)
    {
        Portfolio::destroy($id);
        Session::flash('message', 'Record deleted successfully');
        return back();
    }
}
