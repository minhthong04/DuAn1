<?php include_once "header.php"; ?>

<div class="bg-light py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-0"><a href="index.php">Trang chủ</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Liên hệ</strong></div>
        </div>
    </div>
</div>
<div class="site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Liên hệ với chúng tôi</h2>
            </div>
            <div class="col-md-7">
                <form action="#" method="post">
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">Tên của bạn: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_fname" name="c_fname">
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Họ của bạn: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_lname" name="c_lname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_email" class="text-black">Email của bạn: <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="c_email" name="c_email" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_subject" class="text-black">Tiêu đề </label>
                                <input type="text" class="form-control" id="c_subject" name="c_subject">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_message" class="text-black">Tin Nhắn </label>
                                <textarea name="c_message" id="c_message" cols="30" rows="7" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block" value="Gửi tin nhắn">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-5 ml-auto">
                <div class="p-4 border mb-3">
                    <span class="d-block text-primary h6 text-uppercase">Hà Nội</span>
                    <p class="mb-0">Tòa nhà FPT Polytechnic, đường Trịnh Văn Bô, Phương Canh, Nam Từ Liêm, Hà Nội</p>
                </div>
                <div class="p-4 border mb-3">
                    <span class="d-block text-primary h6 text-uppercase">Hồ Chí Minh</span>
                    <p class="mb-0">778/B1 Nguyễn Kiệm, Phường 4, Quận Phú Nhuận, TP. Hồ Chí Minh</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "footer.php"; ?>