@extends('companies.show.layout')

@section('sub-styles')
    @if(auth()->guest())
        <link rel="stylesheet" href="/assets/css/remodal.css">
        <link rel="stylesheet" href="/assets/css/remodal-default-theme.css">
    @endif
@endsection
@section('sub-content')
    <div class="tab_filter_box p-t-25 bg_white">

        <div class="row p-l-30">
            <h3 class="pum_title black p-l-10">Contact Information</h3>
            <div class="col-md-3">
                @include('partials.seller-contact', ['seller' => $company->owner->seller])
                <p class="text-center p-t-10"><i>Admin</i></p>
            </div>
            <div class="col-md-9">
                <div id="pum_contact_form" class="p-t-0 form_res_fix">
                    <div class="panel panel-default no_border">
                        <div class="panel-heading">
                            <h2 class="panel-title section-heading no-margin p-l-30 p-t-20">Send an email too this
                                seller</h2>
                        </div>
                        <div class="panel-body">
                            {{ Form::open(['class' => 'p-b-30']) }}
                            <div class="form-horizontal">
                                <?php if (Session::has('contact_us_message')): ?>
                                <div class="alert alert-success"
                                     role="alert"><?php echo Session::get('contact_us_message');?></div>
                                <?php endif;?>

                                <?php if($errors->count() > 0): ?>
                                <div class="form-group">
                                    <label class="col-md-3 control-label f-w-400"></label>
                                    <div class="col-md-9">
                                        <?php foreach($errors->all() as $error): ?>
                                        <p class="warning_box plz_fill">
                                            <?php echo $error; ?>
                                        </p>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                                <?php endif;?>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="red">*</span> Name</label>
                                    <div class="col-md-9">
                                        {{ Form::text('name',null,['class' => 'form-control', 'required']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="red">*</span> Email
                                        Address</label>
                                    <div class="col-md-9">
                                        {{ Form::email('email',null,['class' => 'form-control', 'required']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Company Name</label>
                                    <div class="col-md-9">
                                        {{ Form::text('company',null,['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Website</label>
                                    <div class="col-md-9">
                                        {{ Form::text('website',null,['class' => 'form-control']) }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="red">*</span> Subject</label>
                                    <div class="col-md-9">
                                        {{ Form::text('subject',null,['class' => 'form-control', 'required']) }}
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="red">*</span> Message</label>
                                    <div class="col-md-9">
                                        {{ Form::textarea('message', null,['class' => 'form-control height-150', 'required','rows'=>"4"]) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label"><span class="red"></span></label>
                                    <div class="col-md-8">
                                        {!! Recaptcha::render() !!}
                                        <button class="btn btn-info pcolor_bg no_border pull-right m-t-21 m-r-42">
                                            Send
                                        </button>

                                    </div>
                                </div>


                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="tab_filter_box p-t-25 bg_white">
        <h3 class="text-center">Associate Sales</h3>
        <div class="row" style="padding:0 30px;">
            @foreach($company->associate_sellers as $seller)
                <div class="col-md-3">
                    @include('partials.seller-contact', ['seller' => $seller])
                    <p class="text-center p-t-10"><i>Associate {{ ucfirst(readNumber($loop->index + 1)) }}</i></p>
                </div>
            @endforeach
        </div>
    </div>
    @if(auth()->check())
        <div id="app">
            <chat-app :chat_data="chatAppData"></chat-app>
        </div>
        <audio id="message-notification" src="/assets/sounds/message-beep.mp3" autostart="false"></audio>
    @else
        @include('partials.login')
    @endif

@endsection

@section('sub-scripts')
    @if(auth()->check())
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/vendor/jquery.ui.widget.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.iframe-transport.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/ajax-upload/js/jquery.fileupload.js') }}"></script>
    @endif

    @if(auth()->guest())
        <script src="https://cdnjs.cloudflare.com/ajax/libs/remodal/1.0.6/remodal.min.js"></script>
        <script>
            function showLoginForm() {
                var inst = $('[data-remodal-id=login-modal]').remodal();
                inst.open();
            }

            @if($errors->has('email') || $errors->has('password'))
                showLoginForm();
            @endif
        </script>
    @else
        <script>
            function createConversation(userId) {
                app.createConversation(userId);
            }

            function initUploadAttachment(conservation_id) {
                var c_id = conservation_id;

                $('#file-' + c_id).fileupload({
                    url: '/user/store-message',
                    formData: {
                        'conversation_id': c_id,
                        'type': 'attachment',
                        '_token': '{{ csrf_token() }}'
                    },
                    submit: function (e, data) {
                        if (data.files[0].size > 10485760) {
                            alert('File is too big(More than 10 MB).');
                            return false;
                        }

                        return true;
                    },
                    done: function (e, data) {
                        console.log('done');
                    },
                    error: function (e, data) {
                        alert('Something went wrong');
                    }
                });
            }
        </script>
    @endif
@endsection