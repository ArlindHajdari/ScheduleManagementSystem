<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use View;
use Validator;
use DB;

class FacultyController extends Controller
{
    public function index()
    {
        try {
            $faculty = Faculty::all();
            $a = 0;
            return view('Menaxho.Fakultetet.panel')->with(['faculty' => $faculty, 'a' => $a]);

        }catch(QueryException $e) {
            return response()->json([
                'fails'=>true,
                'title' => 'Gabim ne server',
                'msg' => $e->getMessage(),
                'msg1' => 'Për arsye të caktuar, nuk mundëm të kontaktojmë me serverin'
            ],500);
        }
    }

    public function create()
    {
        return View::make('menaxho.fakultetet.panel');
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'faculty' => 'bail|required|alpha|max:250|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json([
                    'fails'=>'true',
                    'errors'=>$validator->getMessageBag()->toArray()
                ],400);

        }else{
            $faculty = new Faculty;
            $faculty->faculty = $request->faculty;
            if($faculty->save()){
                return response()->json([
                        'fails'=>'true',
                        'title'=>'Sukses',
                        'msg'=>'Te dhenat u regjistruan me sukses'
                    ],200);
            }else{
                return response()->json([
                    'fails'=>'true',
                    'title'=>'Gabim',
                    'msg'=>'Gabim gjatë insertimit të të dhënave!'
                ],400);
            }
        }
    }

    public function show(Request $request)
    {
        DB::enableQueryLog();
        try{
            $faculty = Faculty::where('faculty','like','%'.$request->search.'%')->paginate(15);
            return view('Menaxho.Fakultetet.panel')->with('faculty',$faculty);
        }
        catch(QueryException $e){
            return response()->json([
                'fails'=>true,
                'title' => 'Gabim ne server',
                'msg' => $e->getMessage()
            ],500);
        }
    }

    public function edit(Request $request, $id)
    {
        try{
            $validation = Validator::make($request->all(),[
                'faculty' => 'bail|required|alpha|max:190'
            ]);

            if($validation->fails()){
                return response()->json([
                    'fails'=>true,
                    'errors'=>$validation->getMessageBag()->toArray()
                ],400);
            }

            $faculty = Faculty::find($id);

            $faculty->faculty = $request->faculty;

            if($faculty->save()){
                return response()->json([
                    'success'=>true,
                    'title'=>'Sukses',
                    'msg' => 'Të dhënat u ndryshuan me sukses!'
                ],200);
            }else{
                return response()->json([
                    'fails'=>true,
                    'title'=>'Gabim internal',
                    'msg'=>'Ju lutemi kontaktoni mbështetësit e faqes!'
                ],500);
            }

        }catch (QueryException $e){
            return response()->json([
                'fails'=>true,
                'title' => 'Gabim ne server',
                'msg' => $e->getMessage(),
                'msg1' => 'Për arsye të caktuar, nuk mundëm të kontaktojmë me serverin'
            ],500);
        }
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        $faculty = Faculty::find($id);
        $faculty->delete();

        return redirect('FacultyPanel');
    }
}
