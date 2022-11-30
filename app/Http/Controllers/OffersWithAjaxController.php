<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;

use App\Traits\OffresTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OffersWithAjaxController extends Controller
{
    use OffresTrait;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index(){
        return view('offerswithajax.creatform');
    }


    public function store(OfferRequest $request){

        $file_name=$this->saveImages($request->photo,'images/offers' );
//       return 'ok';
        $offer=Offer::create([
            'photo'=>$file_name,
            'name_ar'=> $request->name_ar,
            'name_en'=> $request->name_en,
            'price'=>$request->price,
            'details_ar'=>$request->details_ar,
            'details_en'=>$request->details_en,
        ]);
        if ($offer)
        return response()->json([
            'status'=>true,
            'msg'=>__('massages.added successfully')
        ]) ;
        else
            return response()->json([
                'status'=>false,
                'msg'=>__('massages.The offer is not exist')
            ]) ;
    }
    public function show()
    {
        $offers=Offer::select(
            'photo',
            'id',
            'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
            'price',
            'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
        )->get();
        return view('offerswithajax.showtable',compact('offers'));
    }
    public function delete(Request $request){
//        return $request;
        $offer = Offer::find($request->id);
        if (!$offer)
            return response()->json([
                'status'=>false,
                'msg'=>__('massages.The offer is not exist')
            ]) ;
        $offer->delete();
        return response()->json([
            'status'=>true,
            'msg'=>__('massages.added successfully'),
            'id'=>$request->id,
        ]) ;

//        return view('offers.editForm',compact('offer'));
    }
    public function update(Request $request){
//return $request;
        $offer = Offer::find($request->offer_id);
        if (!$offer)
            return response()->json([
                'status'=>false,
                'msg'=>__('massages.The offer is not exist')
            ]) ;
        $offer->update($request->all());
        return response()->json([
            'status'=>true,
            'msg'=>__('massages.added successfully')
        ]);
    }
    public function showEditFormajax(Request $request){
//        return response()->json([$request]);
        $offer = Offer::find($request->offer_id);
        if (!$offer)
            return response()->json([
                'status'=>false,
                'msg'=>__('massages.The offer is not exist')
            ]) ;
        $offer= Offer::select(
            'id',
            'name_ar',
            'name_en',
            'price',
            'details_ar',
            'details_en',
        )->find($request->offer_id);
        return view('offerswithajax.editForm',compact('offer'));
    }
}
