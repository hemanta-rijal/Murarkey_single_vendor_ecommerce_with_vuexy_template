 @if(Auth::guard('web')->check()) 
                @if(getWishlistForUser())
                <div class="cart-hover">
                  <div class="select-items">
                    <table>
                      <tbody>
                        @foreach (getWishlistForUser() as $wish)
                        <tr>
                          <td class="si-pic">
                            <img src="{{$wish->options['photo']}}" alt="{{$wish->name}}" />
                          </td>
                          <td class="si-text">
                            <a href="" class="product-selected">
                              <p>Rs. {{$wish->price}}</p>
                              <h6>{{$wish->name}}</h6>
                            </a>
                          </td>
                          <td class="si-close">
                            <i class="ti-close"></i>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>

                  <div class="select-button">
                    <a href="{{route('wishlist.view')}}" class="primary-btn view-card">View Wishlists</a>
                  </div>
                </div>
                @endif
              @endif