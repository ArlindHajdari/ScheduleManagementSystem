<?php

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Faculty;
use Illuminate\Database\QueryException;

class FacultyComposer
{
    public $faculty;

    public function __construct()
    {
        try{
            $this->faculty=Faculty::pluck('faculty','id')->toArray();
        }
        catch(QueryException $e){
            return response()->json([
                'fails'=>true,
                'title'=>'Gabim në databazë!',
                'msg'=>'Të dhëna të caktuara nuk mundën të nxirren nga databaza!'
            ],400);
        }
    }

    public function compose(View $view)
    {
        $view->with('faculty',$this->faculty);
    }
}
