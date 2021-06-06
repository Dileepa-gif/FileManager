<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
     * @return array


     */

    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'start' => 'date_format:Y-m-d H:i:s|before:end',
            'end' => 'date_format:Y-m-d H:i:s|after:start',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'enter a valid title',
            'title.min' => 'Event title should contain more than 03 characters',
            'start.date_format' => 'Fill in a valid start date!',
            'start.before' => 'The start date /time must be less than the end date!',
            'end.date_format' => 'Fill in a valid end date!',
            'end.after' => 'The end date /time must be greater than the start date!',
        ];
    }
}
