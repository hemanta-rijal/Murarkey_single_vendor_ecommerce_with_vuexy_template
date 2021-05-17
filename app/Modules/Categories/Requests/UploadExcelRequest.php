<?php


namespace Modules\Categories\Requests;


use App\Http\Requests\BaseRequest;

class UploadExcelRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'excel_file' => 'required|file'
        ];
    }

}