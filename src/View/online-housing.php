<!-- 온라인 하우징 -->
<div class="container padding">
    <div class="sticky-top text-center py-3 mb-5 border-bottom">
        <div class="mb-n4">
            <span class="fx-6 font-weight-bold">Online Housing</span>
        </div>
        <div class="text-right">
            <button class="border-btn" data-toggle="modal" data-target="#write-modal">
                글쓰기
                <i class="fa fa-pencil"></i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="housing-item border">
                <div class="image">
                    <img src="/images/housing/1_before.jpg" alt="인테리어 이미지" title="인테리어 이미지">
                    <img src="/images/housing/1_after.jpg" alt="인테리어 이미지" title="인테리어 이미지">
                </div>
                <div class="py-3 px-3">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <div>
                            <span class="fx-n3 text-muted">유저1(user1)</span>
                            <span class="fx-n3 text-muted ml-1">2020년 05월 23일</span>
                        </div>
                        <div class="text-red">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p>원룸 자취방 집들이, 이렇게 하면 해결할 수 있어요!</p>
                    </div>
                    <div class="mt-5 d-flex justify-content-between align-items-center">
                        <small class="text-muted">이 게시글의 평점은?</small>
                        <button class="red-btn fx-n1">평점 주기</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / 온라인 하우징 -->

<!-- 글쓰기 모달 -->
<div id="write-modal" class="modal fade">
    <div class="modal-dialog">
        <form action="/knowhow" method="post" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <strong class="fx-3 text-red">글쓰기</strong>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="before_img">Before 이미지</label>
                    <div class="custom-file">
                        <input type="file" id="before_img" class="custom-file-input">
                        <label for="before_img" class="custom-file-label">파일을 선택하세요</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="after_img">After 이미지</label>
                    <div class="custom-file">
                        <input type="file" id="after_img" class="custom-file-input">
                        <label for="after_img" class="custom-file-label">파일을 선택하세요</label>
                    </div>
                </div>
                <div class="form-group">
                    <textarea name="contents" id="contents" cols="30" rows="10" class="form-control" placeholder="나만의 노하우를 작성해 보세요"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <div class="red-btn" type="submit">
                        작성 완료
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- / 글쓰기 모달 -->