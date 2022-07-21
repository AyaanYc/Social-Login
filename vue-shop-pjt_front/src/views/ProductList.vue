<template>
  <main class="mt-3">
    <h1>ProductList</h1>
    <div class="container">
      <div class="row mb-2">
        <div class="col-12">
          <select calss="form-select" @change="changeCate1" v-model="selectedCate1">
            <option value="" selected>전체</option>
            <option v-for="item in cate1List" :key="item.cate_nm">
              {{ item.cate_nm }}
            </option>
          </select>

          <select calss="form-select" @change="changeCate2" v-model="selectedCate2" v-if="selectedCate1 !== ''">
            <option value="" selected>전체</option>
            <option v-for="item in cate2List" :key="item.cate_nm">
              {{ item.cate_nm }}
            </option>
          </select>

          <select calss="form-select" @change="getProductList" v-model="selectedCate3" v-if="selectedCate2 !== ''">
            <option value="0" selected>전체</option>
            <option v-for="item in cate3List" :key="item.id" :value="item.id">
              {{ item.cate_nm }}
            </option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-6" :key="product.id" v-for="product in productList">
          <div class="card" style="width: 18rem">
            <a style="cursor: pointer" @click="goToDetail(product.id)">
              <img :src="`/static/img/${product.id}/${product.type}/${product.path}`" alt="이미지" class="card-img-top" />
            </a>
            <div class="card-body">
              <h5 class="card-title">{{ product.product_name}}</h5>
              <p class="card-text">
                <span class="badge bg-dark text-white mr-1">{{ product.cate1 }}</span>
                <span class="badge bg-dark text-white mr-1">{{ product.cate2 }}</span>
                <span class="badge bg-dark text-white">{{ product.cate3 }}</span>
              </p>
              <div class="d-flex justify-content-between aling-items-center">
                <div class="btn-group" role="group">
                  <button class="btn btn-sm btn-outline-secondary">장바구니 담기</button>
                  <button class="btn btn-sm btn-outline-secondary">주문하기</button>
                </div>
                <small class="text-dark">{{ product.product_price }}원</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      productList: [],
      cate1List: [],
      cate2List: [],
      cate3List: [],
      selectedCate1: '',
      selectedCate2: '',
      selectedCate3: 0,
    }
  },
  methods: {
    changeCate1() {
      this.selectedCate2 = '';
      this.selectedCate3 = 0;
      this.cate2List = [];
      this.cate3List = [];
      this.getCate2List(this.selectedCate1);
      this.getProductList();
    },
    changeCate2() {
      this.selectedCate3 = 0;
      this.cate3List = [];
      this.getCate3List(this.selectedCate1, this.selectedCate2);
      this.getProductList();
    },
    
    async getProductList() {      
      const param = {};
      if(this.selectedCate3 > 0) {
        param['cate3'] = this.selectedCate3;
      } else {
        if(this.selectedCate1 !== '') {
          param['cate1'] = this.selectedCate1;
        }
        if(this.selectedCate2 !== '') {
          param['cate2'] = this.selectedCate2;
        }
      }      
      this.productList = await this.$get('/api/productList', param);
    },
    async getCate1List() {
      this.cate1List = await this.$get('/api/cate1List', {});
    },
    async getCate2List(cate1) {
      this.cate2List = await this.$get(`/api/cate2List/${cate1}`, {});
    },
    async getCate3List(cate1, cate2) {
      this.cate3List = await this.$get(`/api/cate3List/${cate1}/${cate2}`, {});
    }
  },
  created() {
    this.getProductList();
    this.getCate1List();
  }
}
</script>
<style scoped>
  img {
    width: 200px;
    height: 200px;
  }
  .card {
    margin: 20px;
  }
</style>>