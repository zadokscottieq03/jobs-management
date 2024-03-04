<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Work extends Model

{
	protected $table = "works";

	protected $dates = ['ended_at'];



	/*
	|----------------------------------------------------------------
	|	Validation rules
	|----------------------------------------------------------------
	*/
	public $rules = array(

		'name'		=> 'required',
        'desc'		=> 'required',
    );


      /*
	|----------------------------------------------------------------
	|	Validate data for add & extend & update records
	|----------------------------------------------------------------
	*/
    public function validate($data,$type){
       
        $ruleType = $this->rules;

        $validator = Validator::make($data,$ruleType);

        if($validator->fails()){
            return $validator;
        }
	}

}