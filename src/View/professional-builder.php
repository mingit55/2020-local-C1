<!-- 전문가 영역 -->
<div class="container py-5">
    <div class="py-3 mb-5 border-bottom">
        <div class="text-center">
            <strong class="fx-4 text-red">전문가 목록</strong>
            <p class="mt-3 fx-n2 text-muted">당신의 인테리어를 책임질 전문적인 시공사</p>
        </div>
    </div>
    <div class="row">
        <?php foreach($builders as $builder):?>
            <div class="col-lg-6 mb-3">
                <div class="review-item">
                    <div class="row">
                        <div class="col-lg-5">
                            <img src="/upload/user-image/<?=$builder->photo?>" alt="전문가 이미지" title="전문가 이미지">
                        </div>
                        <div class="col-lg-7 mt-4 mt-lg-0">
                            <div class="fx-n2 text-muted">시공 전문가</div>
                            <div class="mt-1 fx-3 font-weight-bold"><?=$builder->user_name?>(<?=$builder->user_id?>)</div>
                            <div class="mt-3">
                                <span class="text-muted fx-n2">평점</span>
                                <div class="d-inline-block text-red ml-3">
                                    <?php for($i = 0; $i < ($builder->scoreCount == 0 ? 0 : (int)(floor($builder->scoreTotal / $builder->scoreCount))); $i++):?>
                                        <i class="fa fa-star"></i>
                                    <?php endfor;?>
                                    <?php for(; $i < 5; $i++):?>
                                        <i class="fa fa-star-o"></i>
                                    <?php endfor;?>
                                </div>
                            </div>
                            <div class="mt-5">
                                <button class="red-btn modal-open" data-toggle="modal" data-target="#review-modal" data-id="<?=$builder->id?>">시공 후기작성</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>
<!-- / 전문가 영역 -->

<!-- 리뷰 영역 -->
<div class="review-table container py-5">
    <div class="border-bottom">
        <div class="text-center mb-4">
            <strong class="fx-4 text-red">리뷰 목록</strong>
        </div>
        <div class="review-table-head">
            <div class="image">이미지</div>
            <div class="content">내용</div>
            <div class="price">비용</div>
            <div class="writer">작성자</div>
            <div class="score">평점</div>
        </div>
    </div>
    <div>
        <?php foreach($reviews as $review):?>
            <div class="review-table-item">
                <div class="image">
                    <img src="/upload/user-image/<?=$review->b_photo?>" alt="전문가 이미지">
                </div>
                <div class="content">
                    <div class="text-left px-4">
                        <strong><?=$review->builder_name?>(<?=$review->builder_id?>)</strong>
                        <p class="mt-2 text-muted fx-n2"><?=$review->content?></p>
                    </div>
                </div>
                <div class="price">
                    <span class="fx-2"><?=number_format($review->price)?> </span>
                    <span class="fx-n2 text-muted">원</span>
                </div>
                <div class="writer">
                    <?=$review->user_name?>(<?=$review->user_id?>)
                </div>
                <div class="score">
                    <div class="text-red">
                        <?php for($i = 0; $i < $review->score; $i ++):?>
                            <i class="fa fa-star"></i>
                        <?php endfor;?> 
                        <?php for(; $i < 5; $i ++):?>
                            <i class="fa fa-star-o"></i>
                        <?php endfor;?> 
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>
<!-- / 리뷰 영역 -->


<!-- 후기 작성 모달 -->
<div id="review-modal" class="modal fade">
    <div class="modal-dialog">
        <form action="/reviews" method="post" class="modal-content">
            <input type="hidden" id="builder_id" name="builder_id">
            <div class="modal-header">
                <span class="text-red fx-3">시공 후기작성</span>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="price">시공 비용</label>
                    <input type="text" id="price" name="price" class="form-control" placeholder="시공 비용을 입력하세요">
                </div>
                <div class="form-group">
                    <label for="score">평점</label>
                    <select name="score" id="score" class="form-control">
                        <option value="1">1점</option>
                        <option value="2">2점</option>
                        <option value="3">3점</option>
                        <option value="4">4점</option>
                        <option value="5">5점</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="content">후기</label>
                    <textarea id="content" name="content" class="form-control" placeholder="시공 전문가에 대한 간단한 후기를 남겨주세요" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button class="red-btn">작성 완료</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function(){
        $(".modal-open").on("click", function(e){
            let bid = parseInt(this.dataset.id);
            $("#builder_id").val(bid);
        });
    });
</script>
<!-- / 후기 작성 모달 -->
