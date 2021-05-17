{!! BootForm::openHorizontal(['md' => [4, 8]])->action(route('admin.users.update', $data['user']['id']))->multipart()->put() !!}
{!! BootForm::bind($data) !!}

<div class="row">
    <div class="col-md-8">
        {!! BootForm::text('First Name*', 'user[first_name]') !!}
        {!! BootForm::text('Last Name', 'user[last_name]') !!}
        {!! BootForm::email('Email*', 'user[email]') !!}
        {!! BootForm::text('Phone No*', 'user[phone_number]') !!}
        {!! BootForm::password('Password', 'user[password]')->helpBlock('Keep blank if you don\'t want to change') !!}
        {!! BootForm::password('Confirm Password', 'user[password_confirmation]') !!}
        {!! BootForm::checkbox('Verified', 'user[verified]') !!}
        {!! BootForm::text('Role', 'user[role]')->disabled() !!}
    </div>
</div>
@if(strpos($data['user']['role'] , 'seller'))
    <div class="panel panel-default"
         id="seller-div">
        <div class="panel-heading">Seller Info</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-8">

                    {!! BootForm::text('Position','seller[position]') !!}

                    @include('partials.numbers-input', ['data' => ['seller' => $data['seller']]])

                    {!! BootForm::text('Skype Id','seller[skype]') !!}


                    {!! BootForm::text('Viber ID','seller[viber]') !!}



                    {!! BootForm::text('Whatsapp ID','seller[whatsapp]') !!}


                    {!! BootForm::text('WeChat ID','seller[wechat]') !!}
                </div>
            </div>
        </div>
    </div>
@endif


<div class="row">
    {!! BootForm::submit('update' , null)->class("btn btn-primary pull-right")->style('margin-right:5%') !!}
</div>

{!! BootForm::close() !!}

