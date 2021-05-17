<?php

namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;
use App\Models\CompanyHasImage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;
use Modules\Companies\Contracts\CompanyService;
use Modules\Companies\Requests\UpdateLogoPhotosRequest;
use Modules\Companies\Requests\UploadBase64ImageRequest;
use Modules\Companies\Requests\UploadImageRequest;
use Modules\Products\Contracts\ProductService;


class CompanyController extends Controller
{
    private $companyService;
    private $productService;

    public function __construct(CompanyService $companyService, ProductService $productService)
    {
        $this->companyService = $companyService;
        $this->productService = $productService;
    }

    //Active Company
    public function logoPhotos()
    {
        $company = auth()->user()->seller->company;

        return view('user.company.logo-photos', compact('company'));
    }

    public function editLogoPhotos()
    {
        $company = auth()->user()->seller->company;

        return view('user.company.logo-photos-edit', compact('company'));
    }

    public function updateLogoPhotos(UpdateLogoPhotosRequest $request)
    {
        $data = $request->all();

        $this->companyService->updateLogoPhotos($data);

        return redirect('/user/company/logo-photos');
    }

    public function removeImage($image)
    {
        $this->companyService->removeImage($image);

        return back();
    }

    public function productShowcase(Request $request)
    {
        $perPage = $request->per_page ?? 10;
        $type = $request->type;
        $search = $request->search;
        $userId = null;

        $products = $this->productService->getPaginated($type, $search, $perPage, auth()->user()->seller->company_id, $userId);

        $products->load(['trade_infos' => function ($query) {
            $query->orderBy('moq');
        }]);

        return view('user.company.product-showcase', compact('products', 'perPage'));
    }

    public function uploadImage(UploadImageRequest $request)
    {
       $path =  $this->companyService->uploadImage($request->name, $request->file);

        return map_storage_path_to_link($path);
    }

    public function updateProductShowcase(Request $request)
    {
        $value = $request->get('featured');
        $productId = $request->get('product_id');
        $companyId = auth()->user()->seller->company_id;

        $this->productService->updateFeatured($value, $productId, $companyId);

        return back();
    }
    
    
    public function base64UploadImage(UploadBase64ImageRequest $request)
    {
        $companyImage = CompanyHasImage::find($request->id);
        $pieces = explode('/', storage_app_path($companyImage->image));
        $pieces[count($pieces) - 1] = 'cropped_' . $pieces[count($pieces) - 1];
        ImageManagerStatic::make($request->base64_image_data)->save(implode('/', $pieces));
        $companyImage->modification_details = $request->get('modification_details');
        $companyImage->save();

        return $request->modification_details;
    }
}
