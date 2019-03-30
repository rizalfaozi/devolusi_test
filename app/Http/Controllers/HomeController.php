<?php

namespace App\Http\Controllers;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Http\Request;
use DB;
use App\User;
use Hash;
use File;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $url;
    public function __construct(UrlGenerator $url)
    {
        $this->middleware('auth');
        $this->url = $url;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $user = DB::table('user as a')
         ->join('detail_user as b','a.iduser','=','b.iduser')
         ->get();

        return view('home')->with(['user' => $user]);
    }


    public function create()
    {
        
         $propinsi = DB::table('propinsi')->get(); 
        return view('create')->with(['propinsi'=>$propinsi]);
    }


      public function edit($iduser)
    {
        
         $user = DB::table('user as a')
         ->join('detail_user as b','a.iduser','=','b.iduser')
         ->where(['a.iduser'=>$iduser])
         ->first();



         $kabupaten = DB::table('kabupaten')->get();
         $kecamatan = DB::table('kecamatan')->get();
         $kelurahan = DB::table('kelurahan')->get();
         $propinsi = DB::table('propinsi')->get(); 
        return view('edit')->with(['user'=>$user,'propinsi'=>$propinsi,'kabupaten'=>$kabupaten,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan]);
    }



    public function store(Request $request)
    {    
          $propinsi = DB::table('propinsi')->get();
         if($request->password == $request->password_new)
         {
              $password = $request->password;
             
              $data = DB::table('user')->where('email',$request->email)->first();
              if(empty($data))
              {  
              
                   $user = User::create([
                        'username' => $request->username,
                        'notlp' => '',
                        'email' => $request->email,
                        'password' => bcrypt($request['password'])
                    ]);

                    $rand = rand(10,100);
                    if($request->photo != null){
                            $photo = $rand.'.'.$request->photo->getClientOriginalExtension();
                    $request->photo->move(public_path('img/'), $photo);
                    }else{
                    $photo = "";
                    }

                   $detail = DB::table('detail_user')->insert([
                         "iduser"=>$user->iduser,
                         "name"=>$request->nama_lengkap,
                         "picture"=>$photo,
                         "dateofbirth"=>$request->tgl_lahir,
                         "placeofbirth"=>$request->tempat_lahir,
                         "address"=>$request->alamat,
                         "addressalt"=>$request->alamat_alt,
                         "gender"=>$request->jk,
                         "id_jabatan"=>$request->jabatan_id,
                         "notelpalt"=>"",
                         "sekolah"=>"",
                         "id_propinsi"=>$request->propinsi_id,
                         "id_kabupaten"=>$request->kabupaten_id,
                         "id_kecamatan"=>$request->kecamatan_id,
                         "id_kelurahan"=>$request->kelurahan_id,
                         "status"=>""
                   ]);
                   return redirect('home');
             }else{

                return view('create')->with(['error_mail'=>'email already exists','propinsi'=>$propinsi]);
             }
 
        }else{
         
        return view('create')->with(['error'=>'password not match','propinsi'=>$propinsi]);

         }  

         
    }


    public function update($iduser,request $request)
    {
            $user = DB::table('detail_user')->select('picture')->where('iduser',$iduser)->first();
          
   

                    $rand = rand(10,100);
                    if($request->photo != null){
                        $url = $this->url->to('/img/'.$user->picture);
                        if($user->picture !="")
                        {    
                       unlink('img/'.$user->picture); 
                        }
                            $photo = $rand.'.'.$request->photo->getClientOriginalExtension();
                    $request->photo->move(public_path('img/'), $photo);
                    }else{
                    $photo = "";
                    }


            DB::table('detail_user')
            ->where('iduser',$iduser)
           ->update([
            "name"=>$request->nama_lengkap,
             "picture"=>$photo,
            "dateofbirth"=>$request->tgl_lahir,
            "placeofbirth"=>$request->tempat_lahir,
             "address"=>$request->alamat,
             "addressalt"=>$request->alamat_alt,
             "gender"=>$request->jk,
            "id_jabatan"=>$request->jabatan_id,
             "notelpalt"=>"",
            "sekolah"=>"",
             "id_propinsi"=>$request->propinsi_id,
             "id_kabupaten"=>$request->kabupaten_id,
             "id_kecamatan"=>$request->kecamatan_id,
             "id_kelurahan"=>$request->kelurahan_id,
            "status"=>""     
           ]);    

            return redirect('home');

    }


    public function destory($iduser){
       $user = DB::table('detail_user')->select('picture')->where('iduser',$iduser)->first();
       $url = $this->url->to('/img/'.$user->picture);
       
        if($user->picture !="")
        {    
            unlink('img/'.$user->picture); 
        } 

        DB::table('user')->where('iduser',$iduser)->delete();           
        DB::table('detail_user')->where('iduser',$iduser)->delete();

        return redirect('home');
    }


    public function kabupaten(request $request){

       $kabupaten = DB::table('kabupaten')->where('propinsi_id',$request->id)->get();
       return $kabupaten;

    }


     public function kecamatan(request $request){

       $kecamatan = DB::table('kecamatan')->where('kabupaten_id',$request->id)->get();
       return $kecamatan;

    }


      public function kelurahan(request $request){

       $kelurahan = DB::table('kelurahan')->where('kecamatan_id',$request->id)->get();
       return $kelurahan;

    }


   


}
