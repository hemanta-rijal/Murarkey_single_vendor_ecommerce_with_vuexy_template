
namespace App\Modules\Cart\Requests;


use App\Http\Requests\BaseRequest;

class CheckoutFromBuyNowRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'user.name' => 'required',
            'user.address' => 'required',
            'user.phone_number' => 'required',
            'user.city' => 'required',

            'item.product_id' => 'required|exists:products,id',
            'item.qty' => 'required|numeric',

            'payment_method' => 'required'
        ];
    }
}