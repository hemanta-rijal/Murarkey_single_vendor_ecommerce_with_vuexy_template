<?php

namespace Modules\JoinMurarkey\Requests;

use App\Http\Requests\BaseRequest;

class CreateJoinMurarkeyRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'full_name' => 'required|string',
            'email' => 'required|string',
            'phone_number' => 'required|string',
            'viber_number' => 'string',
            'preferred_work' => 'string',
            'preferred_location' => 'string',
            'about' => 'string| max:500',

        ];
    }
}
