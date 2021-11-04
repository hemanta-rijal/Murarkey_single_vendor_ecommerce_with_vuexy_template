<!--List group with tabs Starts-->
<section id="list-group-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Group Navigation</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <p>
                            You can activate a list group navigation without writing any JavaScript by simply specifying
                            <code> data-toggle="list"</code> or on an element. Use these data attributes on
                            .list-group-item.
                        </p>
                        <div class="row mt-1">
                            <div class="col-md-4 col-sm-12">
                                <div class="list-group" id="list-tab" role="tablist">
                                    @foreach(get_root_categories() as $category_id=>$category)
                                        {{-- {{$category->slug}} --}}
                                        <a class="list-group-item list-group-item-action active"
                                           id="list-{{$category->slug}}-list" data-toggle="list"
                                           href="#{{$category->slug}}" role="tab" aria-controls="list-home">Home</a>
                                        <a class="list-group-item list-group-item-action" id="list-profile-list"
                                           data-toggle="list" href="#list-profile" role="tab"
                                           aria-controls="list-profile">Profile</a>
                                        <a class="list-group-item list-group-item-action" id="list-messages-list"
                                           data-toggle="list" href="#list-messages" role="tab"
                                           aria-controls="list-messages">Messages</a>
                                        <a class="list-group-item list-group-item-action" id="list-settings-list"
                                           data-toggle="list" href="#list-settings" role="tab"
                                           aria-controls="list-settings">Settings</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 mt-1">
                                <div class="tab-content" id="nav-tabContent">

                                    <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                                         aria-labelledby="list-home-list">
                                        <div class="list-group" id="list-tab" role="tablist">
                                            <a class="list-group-item list-group-item-action active" id="list-home-list"
                                               data-toggle="list" href="#list-home"
                                               role="tab" aria-controls="list-home">Home</a>
                                            <a class="list-group-item list-group-item-action" id="list-profile-list"
                                               data-toggle="list" href="#list-profile"
                                               role="tab" aria-controls="list-profile">Profile</a>
                                            <a class="list-group-item list-group-item-action" id="list-messages-list"
                                               data-toggle="list" href="#list-messages"
                                               role="tab" aria-controls="list-messages">Messages</a>
                                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                               data-toggle="list" href="#list-settings"
                                               role="tab" aria-controls="list-settings">Settings</a>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="list-profile" role="tabpanel"
                                         aria-labelledby="list-profile-list">
                                        <div class="list-group" id="list-tab" role="tablist">
                                            <a class="list-group-item list-group-item-action active" id="list-home-list"
                                               data-toggle="list" href="#list-home"
                                               role="tab" aria-controls="list-home">Home</a>
                                            <a class="list-group-item list-group-item-action" id="list-profile-list"
                                               data-toggle="list" href="#list-profile"
                                               role="tab" aria-controls="list-profile">Profile</a>
                                            <a class="list-group-item list-group-item-action" id="list-messages-list"
                                               data-toggle="list" href="#list-messages"
                                               role="tab" aria-controls="list-messages">Messages</a>
                                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                               data-toggle="list" href="#list-settings"
                                               role="tab" aria-controls="list-settings">Settings</a>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="list-messages" role="tabpanel"
                                         aria-labelledby="list-messages-list">
                                        <div class="list-group" id="list-tab" role="tablist">
                                            <a class="list-group-item list-group-item-action active" id="list-home-list"
                                               data-toggle="list" href="#list-home"
                                               role="tab" aria-controls="list-home">Home</a>
                                            <a class="list-group-item list-group-item-action" id="list-profile-list"
                                               data-toggle="list" href="#list-profile"
                                               role="tab" aria-controls="list-profile">Profile</a>
                                            <a class="list-group-item list-group-item-action" id="list-messages-list"
                                               data-toggle="list" href="#list-messages"
                                               role="tab" aria-controls="list-messages">Messages</a>
                                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                               data-toggle="list" href="#list-settings"
                                               role="tab" aria-controls="list-settings">Settings</a>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="list-settings" role="tabpanel"
                                         aria-labelledby="list-settings-list">
                                        <div class="list-group" id="list-tab" role="tablist">
                                            <a class="list-group-item list-group-item-action active" id="list-home-list"
                                               data-toggle="list" href="#list-home"
                                               role="tab" aria-controls="list-home">Home</a>
                                            <a class="list-group-item list-group-item-action" id="list-profile-list"
                                               data-toggle="list" href="#list-profile"
                                               role="tab" aria-controls="list-profile">Profile</a>
                                            <a class="list-group-item list-group-item-action" id="list-messages-list"
                                               data-toggle="list" href="#list-messages"
                                               role="tab" aria-controls="list-messages">Messages</a>
                                            <a class="list-group-item list-group-item-action" id="list-settings-list"
                                               data-toggle="list" href="#list-settings"
                                               role="tab" aria-controls="list-settings">Settings</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--List group with tabs Ends-->