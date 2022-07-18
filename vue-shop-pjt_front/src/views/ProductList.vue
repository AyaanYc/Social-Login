<template>
  <main class="mt-3">
    <h1>ProductList</h1>
    <div class="container">
      <div class="row mb-2">
        <div class="col-12">
          <select name="" id="" class="form-select">
            <option selected></option>
            <option value="1">노트북</option>
            <option value="2">모니터</option>
            <option value="3">마우스/키보드</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6">
          <div class="card" style="width: 18rem">
            <a style="cursor: pointer">
              <img src="" alt="" class="card-img-top" />
            </a>
            <div class="card-body">
              <h5 class="card-title"></h5>
              <p class="card-text">
                <span class="badge bg-dark text-white mr-1"></span>
                <span class="badge bg-dark text-white mr-1"></span>
                <span class="badge bg-dark text-white"></span>
              </p>
              <div class="d-flex justify-content-between aling-items-center">
                <div class="btn-group" role="group">
                  <button class="btn btn-sm btn-outline-secondary">장바구니 담기</button>
                  <button class="btn btn-sm btn-outline-secondary">주문하기</button>
                </div>
                <small class="text-dark">원</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>