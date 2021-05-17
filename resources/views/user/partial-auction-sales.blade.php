<table class="table table-responsive">
    <thead>
    <tr>
        <th>User</th>
        <th>Price</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $order)
        <tr>
            @if($order->user)
            <td><a class=" popover1 " data-toggle="popover" data-placement="left"
                   title="{{ $order->user->phone_number }}, {{ $order->user->email }}">{{ $order->user->name }}</a></td>
            @else
                <td>DELETED USER</td>
            @endif

            <td>{{ $order->price }}</td>

            <td>
                <form method="POST" action="{{ route('user.auction-sales.change-status', $order) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-{{ $order->cancelled ? 'info' : 'danger' }}">{{ $order->cancelled ? 'Approve' : 'Cancel' }}</button>
                </form>
                <br>
                <form method="POST" action="{{ route('user.auction-sales.send-notification', $order) }}">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">Send Notification</button>
                </form>


            </td>
        </tr>
    @endforeach

    </tbody>

</table>