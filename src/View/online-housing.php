<!-- 온라인 하우징 -->
<div class="container py-5">
    <div class="py-3 mb-5 border-bottom">
        <div class="text-center mb-n4">
            <strong class="fx-4 text-red">온라인 집들이</strong>
            <p class="mt-3 fx-n2 text-muted">다양한 사람들의 인테리어 노하우를 만나보세요</p>
        </div>
        <div class="text-right">
            <button class="border-btn" data-toggle="modal" data-target="#write-modal">
                글쓰기
                <i class="fa fa-pencil"></i>
            </button>
        </div>
    </div>
    <div class="row">
        <?php foreach($knowhows as $knowhow):?>
            <div class="col-lg-4 mb-4">
                <div id="knowhow-<?=$knowhow->id?>" class="housing-item border">
                    <div class="image">
                        <img src="/upload/knowhow/<?=$knowhow->before_img?>" alt="인테리어 이미지" title="인테리어 이미지">
                        <img src="/upload/knowhow/<?=$knowhow->after_img?>" alt="인테리어 이미지" title="인테리어 이미지">
                    </div>
                    <div class="py-3 px-3">
                        <div class="d-flex align-items-center justify-content-between mt-2">
                            <div>
                                <span class="fx-n3 text-muted"><?=$knowhow->user_name?>(<?=$knowhow->user_id?>)</span>
                                <span class="fx-n3 text-muted ml-1"><?= date("Y년 m월 d일", strtotime($knowhow->created_at)) ?></span>
                            </div>
                            <div class="text-red score-star">
                                <?php for($i = 0; $i < ($knowhow->scoreCount == 0 ? 0 : (int)($knowhow->scoreTotal / $knowhow->scoreCount)); $i++): ?>
                                    <i class="fa fa-star"></i>  
                                <?php endfor;?>
                                <?php for(; $i < 5; $i ++): ?>
                                    <i class="fa fa-star-o"></i>  
                                <?php endfor;?>
                            </div>
                        </div>
                        <div class="mt-2">
                            <p><?=$knowhow->content?></p>
                        </div>
                        <?php if(array_search($knowhow->id, $myReview) === false && $knowhow->uid != user()->id):?>
                        <div class="mt-5 d-flex justify-content-between align-items-center">
                            <small class="text-muted">이 게시글의 평점은?</small>
                            <button class="score-btn red-btn fx-n1" data-id="<?=$knowhow->id?>">평점 주기</button>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>
<!-- / 온라인 하우징 -->

<!-- 글쓰기 모달 -->
<div id="write-modal" class="modal fade">
    <div class="modal-dialog">
        <form action="/knowhows" method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <strong class="fx-3 text-red">글쓰기</strong>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="before_img">Before 이미지</label>
                    <div class="custom-file">
                        <input type="file" id="before_img" class="custom-file-input" name="before_img">
                        <label for="before_img" class="custom-file-label">파일을 선택하세요</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="after_img">After 이미지</label>
                    <div class="custom-file">
                        <input type="file" id="after_img" class="custom-file-input" name="after_img">
                        <label for="after_img" class="custom-file-label">파일을 선택하세요</label>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="나만의 노하우를 작성해 보세요"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button class="red-btn">
                        작성 완료
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- / 글쓰기 모달 -->

<!-- 평점 주기 모달 -->
<div id="score-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3">
                    <small class="text-muted">이 게시글의 평점을 남겨주세요!</small>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button class="score-label red-btn" data-value="1">
                            <span class="fx-3"><i class="fa fa-star"></i></span> 
                            1
                        </button>
                    </div>
                    <div class="col text-center">
                        <button class="score-label red-btn" data-value="2">
                            <span class="fx-3"><i class="fa fa-star"></i></span> 
                            2
                        </button>
                    </div>
                    <div class="col text-center">
                        <button class="score-label red-btn" data-value="3">
                            <span class="fx-3"><i class="fa fa-star"></i></span> 
                            3
                        </button>
                    </div>
                    <div class="col text-center">
                        <button class="score-label red-btn" data-value="4">
                            <span class="fx-3"><i class="fa fa-star"></i></span> 
                            4
                        </button>
                    </div>
                    <div class="col text-center">
                        <button class="score-label red-btn" data-value="5">
                            <span class="fx-3"><i class="fa fa-star"></i></span> 
                            5
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        let kid;    // 노하우 아이디
        let score;  // 스코어 값

        $(".score-btn").on("click", function(){
            kid = parseInt(this.dataset.id);
            $("#score-modal").modal('show');
        });

        $("#score-modal .score-label").on("click", function(){
            score = parseInt($(this).data("value"));
            
            $.post("/knowhows/score", {kid, score}, res => {
                if(res.result){
                    let html = "";
                    let score = Math.floor(res.total / res.count);

                    for(var i = 0; i < score; i++){
                        html += "<i class='fa fa-star'></i>\n";
                    }
                    
                    for(; i < 5; i++){
                        html += "<i class='fa fa-star-o'></i>\n";
                    }

                    $(`#knowhow-${kid} .score-star`).html(html);
                    $("#score-modal").modal('hide');

                    $(".score-btn[data-id='"+kid+"']").parent().remove();
                } else {
                    alert(res.message);
                }
            });
        });
    });
</script>

<!-- / 평점 주기 모달 -->