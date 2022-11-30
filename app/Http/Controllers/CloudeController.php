<?php

namespace App\Http\Controllers;


use App\Http\Requests\OfferRequest;
use App\Models\doctors;
use App\Models\Offer;
//use Dotenv\Validator;
use App\Traits\OffresTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class CloudeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }
    use OffresTrait;
    public function index(){
        return view('offers.creatform');
    }
//    public function rulls(){
//        $rulls=[
//            'name'=>'required|max:100|unique:offers',
//            'price'=>'required|numeric',
//            'details'=>'required',
//        ];
//        return $rulls;
//    }
//    public function massage(){
//        $massage=[
//            'name.required'=>__('massages.name_is_required'),
//            'price.required'=>__('massages.price is required'),
//        ];
//        return $massage;
//    }
    public function store(OfferRequest $request){
//        $massage = $this->massage();
//        $rulls = $this->rulls();
//
//        $validate= Validator::make ($request->all(),$rulls,$massage);
//        if ($validate -> fails()){
//            return redirect()-> back()->withErrors($validate)->withInput($request->all());
//        }

        $file_name=$this->saveImages($request->photo,'images/offers' );
        Offer::create([
            'photo'=>$file_name,
            'name_ar'=> $request->name_ar,
            'name_en'=> $request->name_en,
            'price'=>$request->price,
            'details_ar'=>$request->details_ar,
            'details_en'=>$request->details_en,
        ]);
    return redirect()->back()->with(['success'=>__('massages.added successfully')]) ;
    }
    public function show()
    {
//         $offers=Offer::select(
//             'photo',
//            'id',
//            'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
//            'price',
//            'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
//        )->get();
        $offers=Offer::select(
            'photo',
            'id',
            'name_'.LaravelLocalization::getCurrentLocale() . ' as name',
            'price',
            'details_'.LaravelLocalization::getCurrentLocale() . ' as details',
        )->paginate(5);//spicafiec amount of data
        return view('offers.showtable',compact('offers'));

    }
    public function update($offer_id,OfferRequest  $request){
        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back()->with(['error'=>__('massages.The offer is not exist')]);
        $offer = Offer::select(
            'id',
            'name_ar',
            'name_en',
            'price',
            'details_ar',
            'details_en',
        )->find($offer_id);
        $offer->update($request->all());
//        $offer = Offer::update([
//            'name_ar'=> $request->name_ar,
//            'name_en'=> $request->name_en,
//            'price'=>$request->price,
//            'details_ar'=>$request->details_ar,
//            'details_en'=>$request->details_en,
//        ]);
        return redirect()->back()->with(['success'=>__('massages.added successfully')]) ;
    }
    public function showEditForm($offer_id){

        $offer = Offer::select(
            'id',
            'name_ar',
            'name_en',
            'price',
            'details_ar',
            'details_en',
        )->find($offer_id);
        return view('offers.editForm',compact('offer'));
    }
    public function delete($offer_id){

        $offer = Offer::find($offer_id);
        if (!$offer)
            return redirect()->back()->with(['error'=>__('massages.The offer is not exist')]);
        $offer->delete();
        return redirect()->back()->with(['success'=>__('massages.successfully deleted')]) ;

//        return view('offers.editForm',compact('offer'));
    }
    public function gerDoctorsGender(){
        $doctorGender = doctors::select('id','name','gender')->get();
//            if(isset($doctorGender) && $doctorGender->count() > 0){
//                foreach($doctorGender as $doctor){
//                    $doctor->gender = $doctor->gender == 1 ? 'male' : 'female';
//                }
//            }
        return $doctorGender;
    }
}
