<template>
  <main class="mt-3">
    <div class="container">
      <h2 class="text-center">제품등록</h2>
      
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품명</label>
        <div class="col-md-9">
          <input type="text" class="form-control" ref="product_name" v-model="product.product_name">
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">제품가격</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input type="number" class="form-control" ref="product_price" v-model="product.product_price">
            <span class="input-group-text">원</span>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">배송비</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input type="number" class="form-control" ref="delivery_price" v-model="product.delivery_price">
            <span class="input-group-text">원</span>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">추가배송비(도서산간)</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input type="number" class="form-control" v-model="product.add_delivery_price">
            <span class="input-group-text">원</span>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">카테고리</label>
        <div class="col-md-9">
          
          <div class="row">
            <div class="col-auto">              
              <select class="form-select" v-model="cate1" @change="changeCate1">
                <option :key="name" v-for="(value, name) of categoryObj">{{ name }}</option>
              </select>
            </div>
            
            <div class="col-auto" v-if="cate1 !== ''">
              <select class="form-select" v-model="cate2" @change="changeCate2">
                <option :key="name" v-for="(value, name) of categoryObj[cate1]">{{ name }}</option> <!--객체라서 of-->
              </select>
            </div>

            <div class="col-auto" v-if="cate2 !== ''">
              <select class="form-select" v-model="product.category_id">
                <option :value="cate.id" :key="cate.id" v-for="cate in categoryObj[cate1][cate2]">{{ cate.value }}</option>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">태그</label>
        <div class="col-md-9">
          <input type="text" class="form-control" v-model="product.tags">
        </div>
      </div>
      
      <div class="mb-3 row">
        <label class="col-md-3 col-form-label">출고일</label>
        <div class="col-md-9">
          <div class="input-group mb-3">
            <input type="number" class="form-control" ref="outbound_days" v-model="product.outbound_days">
            <span class="input-group-text">일 이내 출고</span>
          </div>
        </div>
      </div>

      <div class="mb-3 row">
        <div class="col-6 d-grid p-1">
          <button type="button" class="btn btn-lg btn-dark" @click="goToList">취소</button>
        </div>
        <div class="col-6 d-grid p-1">
          <button type="button" class="btn btn-lg btn-danger" @click="productInsert">저장</button>
        </div>
      </div>

    </div>
  </main>
</template>

<script>
export default {
  data() {
    return {
      product: {
        product_name: '컴퓨터',
        product_price: 11200,
        delivery_price: 3000,
        add_delivery_price: 100,
        tags: '#모니터',
        outbound_days: 3,
        category_id: '5',
        seller_id: 1
      },      
      categoryObj: {},    
      cate1: '',
      cate2: '',
      cate3: '',
    };
  },
  created() {
    this.getCategoryList();
  },
  methods: {
    async getCategoryList() {
      const categoryList = await this.$get('/api/categoryList', {});
      console.log(categoryList);
      let cate1 = '';
      let cate2 = '';      
      categoryList.forEach(item => {
        if(item.cate1 !== cate1) {
          cate1 = item.cate1;
          this.categoryObj[cate1] = {};
          cate2 = '';          
        }

        if(item.cate2 !== cate2) {
          cate2 = item.cate2;
          this.categoryObj[cate1][cate2] = [];
        }     
        const obj = {
          id: item.id,
          value: item.cate3
        }   
        this.categoryObj[cate1][cate2].push(obj);
      });      
    },
    changeCate1() {
      this.cate2 = '';
      this.product.category_id = '';
    },
    changeCate2() {
      this.product.category_id = '';
    },
    productInsert() {
      if(this.product.product_name.trim() === '' ) {
        this.$refs.product_name.focus()
        return this.$swal('제품명은 필수 입력값입니다.')
      }

      if(this.product.product_price === '' || this.product.product_price === 0) {
        this.$refs.product_price.focus()
        return this.$swal('제품 가격을 입력하세요.')
      }

      if(this.product.delivery_price === '' || this.product.delivery_price === 0) {
        this.$refs.delivery_price.focus()
        return this.$swal('배송료를 입력하세요.')
      }

        if(this.product.category_id === '') {
          return this.$swal('카테고리를 선택해주세요.');
        }

      if(this.product.outbound_days === '' || this.product.outbound_days === 0) {
        this.$refs.outbound_days.focus()
        return this.$swal('출고일을 입력하세요.')
      }

      this.$swal.fire({
        title: '정말 등록 하시겠습니까?',
        showCancelButton: true,
        confirmButtonText: '등록',
        cancelButtonText: '취소',
      }).then(async result => {
        if(result.isConfirmed) {
          const res = this.$post('/api/productInsert', this.product)
          console.log(res);
          this.$swal.fire('저장되었습니다.', '', 'success')
          this.$router.push( {path: '/sales'} );
        }
      });
    }
  }
}
</script>

<style>

</style>