<?php
$carts = getCartForUser();

?>


{{--    @csrf--}}
{{--    <input value="{{ (int) str_replace(',','', $carts['total'])}}" name="tAmt" type="hidden">--}}
{{--    <input value="{{ (int) str_replace(',','', $carts['total'])}}" name="amt" type="hidden">--}}
{{--    <input value="0" name="txAmt" type="hidden">--}}
{{--    <input value="0" name="psc" type="hidden">--}}
{{--    <input value="0" name="pdc" type="hidden">--}}
{{--    <input value="EPAYTEST" name="scd" type="hidden">--}}
{{--    <input value="ee2c3ca1-696b-4cc5-a6be-2c40d92" name="pid" type="hidden">--}}
{{--    <input value="{{route('esewa.verify')}}?q=su" type="hidden" name="su">--}}
{{--    <input value="{{route('esewa.verify')}}?q=fu" type="hidden" name="fu">--}}
    <div class="order-btn d-flex justify-content-center mt-5">
        <button type="submit" class="site-btn place-btn">Place Order</button>
    </div>
</form>