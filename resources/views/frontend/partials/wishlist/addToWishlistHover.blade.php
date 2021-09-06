
             @if(Auth::guard('web')->check()) 

                  <div class="select-items">
                    <table>
                      <tbody>
                        @foreach (getWishlistForUser() as $wish)
                        <tr>
                          <td class="si-pic">
                            @isset($wish->options['photo'])
                            <img src="{{$wish->options['photo']}}" alt="{{$wish->name}}" />
                            @endisset
                          </td>
                          <td class="si-text">
                            <a href="" class="product-selected">
                              <p>{{convert($wish->price)}}</p>
                              <h6>{{$wish->name}}</h6>
                            </a>
                          </td>
                          <td class="si-close">
                            <a href="{{route('wishlist.view')}}" >
                            <i class="ti-close"></i>
                            </a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                  <div class="select-button">
                    <a href="{{route('wishlist.view')}}" class="primary-btn view-card">View Wishlists</a>
                  </div>
            @endif