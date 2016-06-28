html+=        '<div class="item item-carousel">';
html+=            '<div class="products">';

html+=                '<div class="product">';
html+=                    '<div class="product_image">';
html+=                        '<div class="image">';
html+=                           '<a href="detail.php?'+$string_vNO + 'cod='+ item['codigo_producto'] +'"><img  src="img_productos/'+item['imagen']+'.jpg" alt="'+item['nombre_producto']+'"></a>';
html+=                        '</div><!-- /.image -->';

html+=                        '<div class="tag new"><span>new</span></div>';
html+=                    '</div><!-- /.product_image -->';

html+=                    '<div class="product_info text-left">';
html+=                        '<h3 class="name">';
html+=                            '<a href="detail.php?'+$string_vNO + 'cod='+ item['codigo_producto'] +'">'+item['nombre_producto']+'</a>';
html+=                                '</h3>';
html+=                            '<div class="rating rateit-small"></div>';
html+=                        '<div class="id_product">';
html+=                            '<span class="value">'+ item['codigo_producto'] +'</span>';
html+=                        '</div>';  

html+=                        '<div class="product_price">';
html+=                            '<span class="price">'+item['pvp']+'</span>';
html+=                            '<span class="price_before_discount">'+item['pvp_incrementado']+'</span>';
html+=                        '</div><!-- /.product_price -->';

html+=                    '</div><!-- /.product_info -->';
html+=                    '<div class="cart clearfix">';

html+=                        '<div class="action">';
html+=                            '<ul class="list-unstyled">';
html+=                                '<li class="add_cart_button btn-group">';
html+=                                    '<button type="button" data-toggle="dropdown" class="btn btn-primary icon">';
html+=                                        '<i class="fa fa-shopping-cart"></i>';
html+=                                    '</button>';
html+=                                    '<button type="button" class="btn btn-primary add_button" data_valor_oferta ="'+data_valor_oferta+'" data-value="'+ item['codigo_producto'] +'">Añadir al carrito</button>';

html+=                                '</li>';

html+=                                '<li class="lnk wishlist">';
html+=                                    '<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Wishlist" href="#">';
html+=                                        '<i class="fa fa-heart"></i>';
html+=                                    '</a>';
html+=                                '</li>';

html+=                                '<li class="lnk">';
html+=                                    '<a class="btn btn-primary" data-toggle="tooltip" data-placement="right" title="Add to Compare" href="#">';
html+=                                        '<i class="fa fa-retweet"></i>';
html+=                                    '</a>';
html+=                                '</li>';
html+=                            '</ul>';
html+=                        '</div><!-- /.action -->';
html+=                    '</div><!-- /.cart -->';
html+=                '</div><!-- /.product -->';

html+=            '</div><!-- /.products -->';
html+=        '</div><!-- /.item -->';