<!-- 시공 견적 요청 -->
<div class="estimate container full-height py-5">
    <div class="sticky-top bg-white py-3">
        <div class="position-relative text-right mb-4">
            <div class="position-center">
                <strong class="fx-4 text-red">시공 견적 요청</strong>
            </div>
            <button class="border-btn" data-toggle="modal" data-target="#request-modal">견적 요청</button>
        </div>
        <div class="estimate-head">
            <div class="writer">요청인</div>
            <div class="start_date">시공일</div>
            <div class="content">내용</div>
            <div class="status">상태</div>
            <div class="count">견적 개수</div>
            <div class="etc"></div>
        </div>
    </div>
    <div class="estimate-list">
        <?php foreach($requests as $req) :?>
        <div class="estimate-item">
            <div class="writer"><?=$req->user_name?>(<?=$req->user_id?>)</div>
            <div class="start_date"><?= date("Y년 m월 d일", strtotime($req->start_date)) ?></div>
            <div class="content">
                <div class="px-3">
                    <p class="text-left"><?=nl2br(htmlentities($req->content))?></p>
                </div>
            </div>
            <div class="status">
                <span><?=$req->sid ? "완료": "진행 중"?></span>
            </div>
            <div class="count">
                <span class="fx-2 font-weight-lighter"><?=$req->count?></span> 
                <span class="fx-n2 text-muted">개</span>
            </div>
            <div class="etc">
                <?php if(user()->type === "BUILDER" && array_search($req->id, $myResponse) == false && $req->sid == false): ?>
                    <button class="red-btn response-btn" data-toggle="modal" data-target="#response-modal" data-id="<?=$req->id?>">견적 보내기</button>
                <?php elseif(user()->id == $req->uid): ?>
                    <button class="red-btn view-btn" data-id="<?=$req->id?>">견적 보기</button>
                <?php endif;?>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
<!-- / 시공 견적 요청 -->

<?php if(user()->type === "BUILDER"):?>
<!-- 보낸 견적 리스트 -->
<div class="estimate container py-5">
    <div class="sticky-top bg-white py-3">
        <div class="text-center mb-4">
            <strong class="fx-4 text-red">보낸 견적 리스트</strong>
        </div>
        <div class="estimate-head">
            <div class="writer">요청인</div>
            <div class="start_date">시공일</div>
            <div class="content">내용</div>
            <div class="status">선택 여부</div>
            <div class="count">입력한 비용</div>
            <div class="etc"></div>
        </div>
    </div>
    <div class="estimate-list">
        <?php foreach($response as $res):?>
            <div class="estimate-item">
                <div class="writer"><?=$res->user_name?>(<?=$res->user_id?>)</div>
                <div class="start_date"><?= date("Y년 m월 d일", strtotime($res->start_date)) ?></div>
                <div class="content">
                    <div class="px-3">
                        <p class="text-left"><?=nl2br(htmlentities($res->content))?></p>
                    </div>
                </div>
                <div class="status">
                    <span><?=$res->status?></span>
                </div>
                <div class="count">
                    <span class="fx-2 font-weight-lighter"><?=number_format($res->price)?></span> 
                    <span class="fx-n2 text-muted">원</span>
                </div>
                <div class="etc">
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>
<!-- / 보낸 견적 리스트 -->
<?php endif;?>

<!-- 견적 요청 모달 -->
<div id="request-modal" class="modal fade">
    <div class="modal-dialog">
        <form action="/estimate/request" method="post" class="modal-content">
            <div class="modal-header">
                <strong class="fx-3">견적 요청하기</strong>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="start_date">시공일</label>
                    <input type="date" id="start_date" name="start_date" class="form-control">
                </div>
                <div class="form-group">
                    <label for="content">내용</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control" placeholder="시공 규모 및 상세 내용을 정확하게 기재해 주세요"></textarea>
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
<!-- / 견적 요청 모달 -->

<!-- 견적 보내기 모달 -->
<div id="response-modal" class="modal fade">
    <div class="modal-dialog">
        <form action="/estimate/response" method="post" class="modal-content">
            <input type="hidden" id="request_id" name="rid">
            <div class="modal-header">
                <strong class="fx-3 text-red">견적 보내기</strong>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="price">가격</label>
                    <input type="text" id="price" class="form-control" name="price" placeholder="시공 가격을 제시하세요">
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button class="red-btn">입력 완료</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- / 견적 보내기 모달 -->

<!-- 견적 보기 모달 -->
<div id="view-modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong class="fx-3 text-red">견적 보기</strong>
            </div>   
            <div class="modal-body">
                
            </div>
        </div>
    </div>
</div>
<!-- /견적 보기 모달 -->

<script>
    $(function(){
        // # 견적 보내기 모달
        $(".response-btn").on("click", function(e){
            let id = $(this).data("id");
            $("#request_id").val(id);
        });


        // # 견적 보기 모달
        let req_id;
        $(".view-btn").on("click", function(){
            req_id = $(this).data("id");
            $.getJSON("/estimate/response?id=" + req_id, function(res){
                let {result, estimates, request} = res;

                if(result){
                    $("#view-modal .modal-body").html("");
                        if(estimates.length > 0)
                        estimates.forEach(est => {
                            let $elem = $(`<div class="d-flex align-items-center justify-content-between py-2 border-bottom">
                                                <div>
                                                    <strong class="fx-1">${est.user_name}</strong>
                                                    <small class="text-muted ml-2">${est.user_id}</small>
                                                    <span class="ml-4 text-muted fx-n2">
                                                        <b class="text-red fx-3">${est.price.toLocaleString()}</b>
                                                        원
                                                    </span>
                                                </div>
                                                <div>
                                                    ${
                                                        !request.sid ?
                                                        `<button class="red-btn select-btn" data-id="${est.id}">선택</button>`
                                                        : request.sid == est.id ?
                                                        `<span class="text-red">선택한 견적</span>`
                                                        : ""
                                                    }
                                                </div>
                                            </div>`);
                            $("#view-modal .modal-body").append($elem);
                        });
                    else 
                        $("#view-modal .modal-body").html("<p class='text-center text-muted py-3'>견적이 존재하지 않습니다.</p>");
                    $("#view-modal").modal('show');
                }
                else {
                    alert(res.message);
                }
            });
        });

        // # 견적 선택하기
        $("#view-modal").on("click", ".select-btn", function(){
            let res_id = $(this).data("id");
            
            $.post("/estimate/select", {req: req_id, res: res_id}, (res) => {
                alert(res.message);
                if(res.result){ 
                    location.reload();
                }
            });
        });
    });
</script>