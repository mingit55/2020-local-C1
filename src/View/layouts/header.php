<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>내 집꾸미기</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/fontawesome/css/font-awesome.min.css">
    <script src="jquery-3.4.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <?= $import ?>
    <script>
        $(function(){
            $(".custom-file-input").on("change", function(){
                $(this).siblings("label").text(this.files[0].name);
            });
        });
    </script>
</head>
<body>
    <!-- 헤더 영역 -->
    <header>
        <div class="container h-100">
            <div class="d-flex justify-content-between align-items-center h-100">
                <a href="/" class="align-middle">
                    <img src="images/logo-2.svg" alt="내 집꾸미기" title="내 집꾸미기" height="50">
                </a>
                <nav class="d-none d-lg-flex">
                    <div class="nav-item"><a href="/">홈</a></div>
                    <div class="nav-item"><a href="/online-housing">온라인 집들이</a></div>
                    <div class="nav-item"><a href="/store">스토어</a></div>
                    <div class="nav-item"><a href="/#">전문가</a></div>
                    <div class="nav-item"><a href="/#">시공 견적</a></div>
                </nav>
                <div class="auth d-none d-lg-flex">
                    <?php if(!user()):?>
                    <div class="auth-item"><a href="/#" data-target="#sign-in" data-toggle="modal">로그인</a></div>
                    <div class="auth-item"><a href="/#" data-target="#sign-up" data-toggle="modal">회원가입</a></div> 
                    <?php else :?>
                        <span class="fx-n2 mr-3"><?=user()->user_name?>(<?=user()->user_id?>)</span>
                        <a href="/logout" class="fx-n2">로그아웃</a>
                    <?php endif;?>
                </div>
                <div class="menu d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="menu-box">
                    <div class="d-flex flex-column py-1">
                        <a class="py-2 pl-5 border-bottom" href="/">홈</a>
                        <a class="py-2 pl-5 border-bottom" href="/online-housing">온라인 집들이</a>
                        <a class="py-2 pl-5 border-bottom" href="/store">스토어</a>
                        <a class="py-2 pl-5 border-bottom" href="/#">전문가</a>
                        <a class="py-2 pl-5 border-bottom" href="/#">시공 견적</a>
                        <div class="pl-5 py-2 text-muted">
                            <?php if(!user()): ?>
                                <a class="fx-n2 pr-3" href="/#" data-target="#sign-in" data-toggle="modal">로그인</a>
                                <a class="fx-n2" href="/#" data-target="#sign-up" data-toggle="modal">회원가입</a>
                            <?php else : ?>
                                <span class="fx-n2 pr-3"><?=user()->user_name?>(<?=user()->user_id?>)</span>
                                <a class="fx-n2" href="/logout">로그아웃</a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- / 헤더 영역 -->

    <!-- 회원가입 모달 -->
    <div id="sign-up" class="modal fade">
        <div class="modal-dialog">
            <form class="modal-content" action="/sign-up" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <strong class="fx-4 text-red">회원가입</strong>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">아이디</label>
                        <input type="text" id="user_id" class="form-control" name="user_id" placeholder="아이디를 입력하세요">
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="비밀번호를 입력하세요">
                    </div>
                    <div class="form-group">
                        <label for="user_name">이름</label>
                        <input type="text" id="user_name" class="form-control" name="user_name" placeholder="이름 입력하세요">
                    </div>
                    <div class="form-group">
                        <label for="photo">사진</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="photo" class="custom-file-input" name="photo" accept="image/*" aria-describedby="File">
                                <label for="photo" class="custom-file-label">파일을 선택하세요</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <img src="/images/captcha.png" alt="캡챠 이미지" class="w-100">
                        <input type="text" id="captcha" class="form-control" name="captcha" placeholder="상단의 문자를 입력하세요">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button class="btn btn-danger">회원가입</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- /회원가입 모달 -->

    <!-- 로그인 모달 -->
    <div id="sign-in" class="modal fade">
        <div class="modal-dialog">
            <form class="modal-content" action="/sign-in" method="post">
             <div class="modal-header">
                    <strong class="fx-4 text-red">로그인</strong>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="user_id">아이디</label>
                        <input type="text" id="user_id" class="form-control" name="user_id" placeholder="아이디를 입력하세요">
                    </div>
                    <div class="form-group">
                        <label for="password">비밀번호</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="비밀번호를 입력하세요">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-right">
                        <button class="btn btn-danger">로그인</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- / 로그인 모달 -->