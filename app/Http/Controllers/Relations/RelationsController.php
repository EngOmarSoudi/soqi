<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\doctors;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){
        $user=User::with(['phone'=>function($q){
            $q->select('code','phonecol','user_id');
        }])->find(12);
//        $phone=$user->phone; return phone table only
        return response()->json([$user]);
    }
    public function hasOneRelationReverse(){
//         $phone=Phone::with('user')->find(1);
            //return all the user data and Phone data via his phone number

//        $phone=Phone::with(['user'=>function($q){$q->select('id','name');}])->find(1);
            //return specific user data via his phone number
        ////////////////MAKE some attribute hidden or visible//////////
//        $phone->makeVisible(['user_id']);
//        $phone->akeHidden(['user_id']);



//        $phone=Phone::find(1)->user;
        // return user data only via his phone number


//        return User::whereHas('phone')->get();
        //get user if he has phone
        return User::whereHas('phone',function($q){$q->where('code','967');})->get();
        //get user if he has specific condition in his Phone table
//        return User::whereDoesntHave('phone')->get();
        //get user if he does not have phone

//        return response()->json([$phone]);
    }



    ################ Begin OneToMany Relations ##############


    public function hasManyRelations(){
//        $hospital= Hospital::find(1); //$hospital= Hospital::where('id',1)->first();//$hospital= Hospital::first();
//        return $hospital->doctors;
        //find the hospital and who is working in

        $hospital= Hospital::with('doctors')->find(1);
        return $hospital;
    }
    public function hospitals(){
        $hospitals=Hospital::all();
        return view('hospital.hospital',compact('hospitals'));
    }
    public function doctors($id){
        $hospitals = Hospital::find($id);
        $doctors = $hospitals->doctors;
        return view('hospital.doctors',compact('doctors'));
    }
    public function hospitalsById($id){
        $doctors =doctors::find($id);
        $hospitalsById = $doctors->hospital_id;
        $hospitals = Hospital::find($hospitalsById);
        $hospitalsName= $hospitals->name;
return $hospitalsName;
//
//        return view('hospital.hospital',compact('hospitals'));
    }
    public function hospitalsMaleDoctors(){
        return $hospitals =Hospital::whereHas('doctors',
        function ($q) {
            $q->where('gender',1);
        }
        )->get();
    }
    public function hospitalsDonthaveDoctors(){

    }
    public function hospitalsHaveDoctors(){
        return $hospitals =Hospital::whereHas('doctors')->get();
    }
    public function deleteHospital($hospital_id){
        $hospital= Hospital::find($hospital_id);
        if(!$hospital)
            return abort('404');
        $hospital-> doctors()->delete();
        $hospital->delete();
    }
    public function getDoctorsServices(){
        $doctor=doctors::with('services')->find(2);
       //return $doctor->services;//services that this doctor provide
     //   return doctors::with('services')->find(2);
        return $doctor->name;
    }
    public function getServicesDoctors(){
        $doctor=Service::with(['doctors'=>function($q){
            $q->select('doctors.id','name','title');
        }])->find(1);

        return $doctor;
    }
    public function showDoctorServices($id) {
        $doctor=doctors::find($id);
        $service=$doctor->services;
        $doctors=doctors::select('id','name')->get();
        $services=Service::select('id','name')->get();
        return view('hospital.doctor_services',compact('services','doctors','service'));

    }
    public function save(Request $request){
//        return $request;
        $doctor= Doctors::find($request->doctorId);
        if(!$doctor)
            return 'not find';
//        $doctor->services()->attach($request->servicesIds);//add on old data even if the same data exist
//        $doctor->services()->sync($request->servicesIds);//delete old data and add new
        $doctor->services()->syncWithoutDetaching($request->servicesIds);// add new with out delete old data

        return redirect()->back()->with(['success']);
    }
    public function getPatientDoctor (){
        $patent=Patient::find(2);
        return  $patent -> doctor;
//        $patent;
    }
    public function getDoctorCountries (){
         $country =Country::find(1);
        return $country -> doctors;
//        $patent;
    }
}
