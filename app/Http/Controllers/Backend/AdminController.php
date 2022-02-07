<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Helpers\ResponseFormatter;
use DB;
use File;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Dosen;
use App\Rules\CurrentPassword;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.index',[
            'title'         => 'Daftar Admin',
            'breadcrumb'    => 'admin',
            'url'           => '/admin',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreRequest $request)
    {
        try{
            $validated = $request->validated();
            $destinationPath = public_path('/uploads/');
            $defaultFile     = 'default.png';

            if(isset($validated['foto'])) {
                $file = $validated['foto'];
                if(!empty($validated->oldfoto)) {
                    $pathFile = $destinationPath.$validated['oldfoto'];
                    if(File::exists($pathFile)){
                        File::delete($pathFile);
                    }
                }

                $setFile = str_replace(' ', '', strtolower($validated['nama']));
                $filename = date("dmY").'_'.$setFile.'.'.$file->getClientOriginalExtension();
                if(!File::exists($destinationPath.$filename)){
                    $file->move($destinationPath, $filename);
                }
            }else{
                if($defaultFile != $validated['oldfoto']) {
                    $filename = $validated['oldfoto'];
                } else {
                    $filename = $defaultFile;
                }
            }
            Admin::insert([
                'nik'       => $validated['nik'],
                'nip'       => $validated['nip'],
                'nama'      => $validated['nama'],
                'email'     => $validated['email'],
                'foto'      => $filename,
                'password'  => Hash::make($validated['password']),
                'status'    => $validated['status']
            ]);
                    
            return ResponseFormatter::success(
                'store data successfully',
                200
            );
        }catch(\Exception $e){
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'store data failed', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, $id)
    {
        DB::beginTransaction();      
        try{          
            $ids                = \Crypt::decrypt($id);
            $validated          = $request->validated();
            $destinationPath    = public_path('/uploads/');
            $defaultFile        = 'default.png';

            
            if(isset($validated['foto'])) {
                $file = $validated['foto'];
                if(isset($validated['oldfoto'])) {
                    $pathFile = $destinationPath.$validated['oldfoto'];
                    if(File::exists($pathFile)){
                        File::delete($pathFile);
                    }
                }

                $setFile = str_replace(' ', '', strtolower($validated['nama']));
                $filename = date("dmY").'_'.$setFile.'.'.$file->getClientOriginalExtension();
                if(!File::exists($destinationPath.$filename)){
                    $file->move($destinationPath, $filename);
                }
            }else{
                if($defaultFile != $validated['oldfoto']) {
                    $filename = $validated['oldfoto'];
                } else {
                    $filename = $defaultFile;
                }
            }
            Admin::where('nik',$ids)->update([
                'nik'                       => $validated['nik'],
                'nip'                       => $validated['nip'],
                'nama'                      => $validated['nama'],
                'foto'                      => $filename,
                'email'                     => $validated['email'],
                'status'                    => $validated['status']
            ]);
            DB::commit();
            return ResponseFormatter::success(
                'store data successfully',
                200
            );
        }catch(\Exception $e){
            DB::rollback();
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'store data failed', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try{
            $ids  = \Crypt::decrypt($id);
            $data = Admin::where('nik',$ids)->first();
            if($data) {
                if($data->foto != 'default.png') {
                    $pathFile = public_path('/uploads/').$data->foto;
                    if(File::exists($pathFile)){
                        File::delete($pathFile);
                    }
                }
                $data->delete();
               // $data->delete(['nik'=>$id]);
            }
         
            return ResponseFormatter::success(
                'store data successfully',
                200
            );
         
        } catch (\Throwable $e) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ],'store data failed', 500);
        }     
    }


    /**
     * show profil admin
     */
    public function indexPassword(){
        return view('Profil.indexPassword',[
            'title'         => 'Reset Password',
            'subTitle'      => 'Amankan akun Anda dengan kombinasi password yang baik',
            'breadcrumb'    => 'Reset Password',
            'url'           => '/reset-password',
        ]);
    }


     /**
     * MERESET PASSWORD ADMIN 
     * @param Request $request,$id
     * @return \Illuminate\Http\Json
     */
    public function updatePassword(Request $request){
        $rules = [
            'current_password'      => ['required', 'string', new CurrentPassword()],
            'password'              => ['required','string','min:8','confirmed'],
        ];

        $messages = [
            'current_password.required' => 'Password lama wajib diisi',
            'password.required'         => 'Password wajib diisi',
            'password.min'              => 'Password minimal 6',
            'password.confirmed'        => 'Password tidak sama dengan konfirmasi password',
        ];

        $this->validate($request, $rules, $messages);
        DB::beginTransaction();  
        try {
            $password   = $request->password;
            if(Auth::guard('admin')->check()){
                Admin::where('nik',Auth::guard('admin')->user()->nik)->update(['password'=> Hash::make($password)]);
                \Session::flash('status','success');
                \Session::flash('message','Password berhasil diupdate!!');
                DB::commit();
                return redirect()->route('admin.index.password');
            }else{
                Dosen::where('nik',Auth::guard('dosen')->user()->nik)->update(['password'=> Hash::make($password)]);
                \Session::flash('status','success');
                \Session::flash('message','Password berhasil diupdate!!');
                DB::commit();
                return redirect()->route('dosen.index.password');
            }
        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('status','error');
            \Session::flash('message','Password gagal diupdate!!');
            if(Auth::guard('admin')->check()){
                return redirect()->route('admin.index.password');
            }else{
                return redirect()->route('dosen.index.password');
            }
        }
    }
    
}
