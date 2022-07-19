<template>
  <main class="mt-3">
    <div class="container">
      <h2 class="text-center">제품 사진 등록</h2>
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품ID</label>
        <div class="col-md-9"></div>
      </div>
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품명</label>
        <div class="col-md-9"></div>
      </div>
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">섬네일이미지</label>
        <div class="col-md-9">
          <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-2">
              <div class="position-relative">
                <img src="" class="img-fluid" alt="" />
                <div class="position-absolute top-0 end-0" style="cursor: pointer">X</div>
              </div>
            </div>
          </div>
        </div>
        <input type="file" class="form-control" accept="image/png,image/jpeg" />
        <div class="alert alert-secondary" role="alert">
          <ul>
            <li>이미지 사이즈 : 350-350</li>
            <li>파일 사이즈 : 1M 이하</li>
            <li>파일 확장자 : png, jpg만 가능</li>
          </ul>
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품이미지</label>
        <div class="col-md-9">
          <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-2">
              <div class="position-relative">
                <img src="" class="img-fluid" alt="" />
                <div class="position-absolute top-0 end-0" style="cursor: pointer">X</div>
              </div>
            </div>
          </div>
          <input type="file" class="form-control" accept="image/png,image/jpeg" />
          <div class="alert alert-secondary" role="alert">
            <ul>
              <li>최대 5개 가능</li>
              <li>이미지 사이즈 : 700*700</li>
              <li>파일 사이즈 : 1M 이하</li>
              <li>파일 확장자 : png, jpg만 가능</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품설명이미지</label>
        <div class="col-md-9">
          <div class="row">
            <div class="col-lg-6 col-md-8">
              <input type="file" class="form-control" accept="image/png,image/jpeg" />
              <div class="alert alert-secondary" role="alert">
                <ul>
                  <li>파일 사이즈 : 5M 이하</li>
                  <li>파일 확장자 : png, jpg만 가능</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 col-md-8">
              <div class="position-relative">
                <img src="" class="img-fluid" alt="" />
                <div class="position-absolute top-0 end-0" style="cursor: pointer">X</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mb-3 row m-auto">
        <button type="button" class="btn btn-lg btn-dark">확인</button>
      </div>
    </div>
  </main>
</template>

<script>
export default {};
</script>

<style></style>