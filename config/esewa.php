<?php

return[
    'SCD'=>env('APP_ENV')=='local'? 'EPAYTEST' :get_meta_by_key('esewa_scd'),
    'form_url'=>env('APP_ENV')=='local'?'https://uat.esewa.com.np/epay/main':'https://esewa.com.np/epay/main',
    'transaction_url'=>env('APP_ENV')=='local'?'https://uat.esewa.com.np/epay/transrec':'https://esewa.com.np/epay/transrec'
];
