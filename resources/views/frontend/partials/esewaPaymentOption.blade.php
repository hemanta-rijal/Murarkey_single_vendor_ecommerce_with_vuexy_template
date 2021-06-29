<?php
$user = auth('web')->user();
$session_id = session()->getId();
?>

    <input value="{{ $amount}}" name="tAmt" type="hidden">
    <input value="{{ $amount}}" name="amt" type="hidden">
    <input value="0" name="txAmt" type="hidden">
    <input value="0" name="psc" type="hidden">
    <input value="0" name="pdc" type="hidden">
    <input value="EPAYTEST" name="scd" type="hidden">
    <input value="{{$session_id}}" name="pid" type="hidden">
    <input value="{{$url}}?q=su" type="hidden" name="su">
    <input value="{{$url}}?q=fu" type="hidden" name="fu">

<script>
    console.log('<?php echo $session_id?>')
</script>