<!-- 장바구니 영역 -->
<div class="cart position-relative">
        <div class="container padding pb-5">
            <div class="sticky-top bg-white text-center text-lg-left py-2">
                <div class="mb-3">
                    <span class="fx-5 font-weight-light text-red">장바구니</span>
                </div>
                <div class="cart-head d-flex text-center text-muted border-bottom py-3">
                    <div class="image">이미지</div>
                    <div class="info text-center">상품 정보</div>
                    <div class="price">가격</div>
                    <div class="count">구매 개수</div>
                    <div class="total">총합</div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-list-wrap">
                        <div class="cart-list">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 d-flex justify-content-between">
                <div>
                    <span class="text-muted fx-2">총 합계</span>
                    <span class="ml-3 fx-5 text-red cart-total">20,000</span>
                    <span class="ml-1">원</span>
                </div>
                <div class="ml-5">
                    <button class="btn-submit" data-target="#buy-modal" data-toggle="modal">구매하기</button>
                </div>
            </div>
        </div>
    </div>
    <!-- / 장바구니 영역 -->

    <!-- 스토어 영역 -->
    <input type="checkbox" id="drag-area" checked hidden>
    <div class="store position-relative">
        <div class="container padding pt-5">
            <div class="sticky-top bg-white row justify-content-between align-items-end border-bottom mb-5 py-3">
                <div class="col-lg-7 col-12 text-center text-lg-left mb-4 mb-lg-0">
                    <span class="fx-5 font-weight-light text-red">스토어</span>
                </div>
                <div class="col-lg-5 col-12 d-flex align-items-end">
                    <div class="search">
                        <span class="icon"><i class="fa fa-search"></i></span>
                        <input type="text" placeholder="검색어를 입력하세요">
                    </div>
                    <label for="drag-area" class="d-inline-block text-red ml-3">
                        <i class="fa fa-shopping-cart fa-2x"></i>
                    </label>
                </div>
                <div class="drag-box d-flex justify-content-center align-items-center">
                    <div class="text-center text-white">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                        <p class="text-white fx-n2 mt-3">이곳에 상품을 놓아주세요</p>
                    </div>
                </div>
            </div> 
            <div class="store-list row">
                <div class="col-lg-4 col-md-4 col-12 mb-5">
                    <div class="store-item">
                        <div class="image">
                            <img src="images/products/product_1.jpg" title="상품 이미지" alt="상품 이미지">
                        </div>
                        <div class="p-3 d-flex justify-content-between align-items-end">
                            <div>
                                <div class="p-name fx-n3 text-muted">마틸라</div>
                                <div class="p-brand mt-1 fx-3">마틸라</div>
                            </div>
                            <div>
                                <div>
                                    <span class="p-price fx-5 text-red">17,100</span>
                                    <span class="ml-1">원</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / 스토어 영역 -->

    <!-- 구매하기 모달 -->
    <div id="buy-modal" class="modal fade" tabindex="-1" role="dialog">
        <form class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="fx-2 text-red">상품 구매</div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">구매자 이름</label>
                        <input type="text" id="username" class="form-control" placeholder="이름을 입력하세요">
                    </div>
                    <div class="form-group">
                        <label for="address">배송지 주소</label>
                        <input type="text" id="address" class="form-control" placeholder="주소을 입력하세요">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button class="btn bg-red text-white">구매 완료</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- / 구매하기 모달 -->

    <!-- 구매 내역 모달 -->
    <div id="purchase-modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="text-center">
                        <img title="구매 내역" alt="구매 내역">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / 구매 내역 모달 -->