<?php


namespace Modules\Companies\Requests;


use App\Http\Requests\BaseRequest;
use App\Models\Company;
use App\Models\CompanyHasImage;

class UploadImageRequest extends BaseRequest
{
    public function rules()
    {
        $rules = [
            'file' => 'required|file|max:4096|image|image_size:',
            'name' => 'required',
            'type' => 'required|in:company-photo,cover-photo,logo'
        ];

        switch (request('type')) {
            case 'logo':
                $rules['file'] .= '>=' . Company::DEFAULT_LOGO_SIZE . ',' . '>=' . Company::DEFAULT_LOGO_SIZE;
                break;
            default:
                $rules['file'] .= '>=' . implode(',>=', CompanyHasImage::$size[request('type')]);
                break;
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];
        switch (request('type')) {
            case 'logo':
                $messages['image_size'] = 'The logo must be :width wide and :height tall.';
                break;
            case 'cover-photo':
                $messages['image_size'] = 'The cover photo must be :width wide and :height tall.';
                break;
            default:
                $messages['image_size'] = 'The company photo must be :width wide and :height tall.';
                break;
        }

        return $messages;
    }
}