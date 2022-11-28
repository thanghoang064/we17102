<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
//        //nơi  viết validate
//        dd(123);
        $rules = [];
        // lấy ra trên phương thức đang hoạt động
        $currentAction = $this->route()->getActionMethod();
        switch ($this->method()) :
            case 'POST':
                switch ($currentAction) {
                    case 'add' :
                        $rules = [
                           "email"=>"required|unique:users",
                           "name"=> "required",
                           "password" =>"required"
                        ] ;
                        break;
                    default:
                        break;
                }
                break;
        endswitch;

        return $rules;
    }
    public function messages()
    {
        return [
            'email.required'=>'bắt buộc phải nhập email',
            'name.required'=>'bắt buộc phải nhập name',
            'email.unique'=>'Email đã tồn tại'
        ];
    }
}
