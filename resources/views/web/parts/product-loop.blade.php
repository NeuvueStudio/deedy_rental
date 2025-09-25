 @forelse($products as $product)
     <div class="col-sm-3">
         <div class="product-cart-wrap mb-30">
             <div class="product-img-action-wrap p-4 custom-height">
                 <div class="product-img product-img-zoom">
                     <a href="{{ route('shop.product_detail', $product->id) }}">
                         <img class="default-img" src="{{ asset('upload/product_images') . '/' . $product->image_name }}"
                             alt="" />
                     </a>
                 </div>
             </div>
             <div class="product-content-wrap p-4">
                 <h2 class="product-title-border-bottom">
                     <a href="{{ route('shop.product_detail', $product->id) }}">{{ $product->category }}</a>
                 </h2>
                 <div class="product-card-bottom">
                     <div class="product-price">
                         @if (isset($formattedPrices[$product['id']]))
                             <span>{{ $formattedPrices[$product['id']] }}</span>
                         @else
                             Price not available
                         @endif
                     </div>
                 </div>
                 
             </div>
         </div>
     </div>
 @empty
     <p>No products found{{ isset($search) ? ' for "' . $search . '"' : '' }}.</p>
 @endforelse
