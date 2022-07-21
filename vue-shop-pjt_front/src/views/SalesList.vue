<template>
  <main class="mt-3">
    <div class="container">
      <div class="float-end mb-1">
        <router-link class="nav-link" to="/create">
          <button type="button" class="btn btn-dark">제품등록</button>
        </router-link>
      </div>
 
      <table class="table table-bordered">
        <thead>
          <tr>
            <th></th>
            <th>제품명</th>
            <th>제품가격</th>
            <th>배송비</th>
            <th>추가 배송비</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(product, idx) in productList" :key="product.id">
            <td><img v-if="product.path !== null" :src="`/static/img/${product.id}/1/${product.path}`"></td>
            <td><span>{{ product.product_name }}</span></td>
            <td><span>{{ product.product_price }}</span></td>
            <td><span>{{ product.delivery_price }}</span></td>
            <td><span>{{ product.add_delivery_price }}</span></td>
            <td>
              <!--
              <router-link class="nav-link" :to="{ path: '/image_insert', query: {product_id: product.id} }">
                <button type="button" class="btn btn-info me-1">사진등록</button>
              </router-link>
              -->
              <button type="button" class="btn btn-info me-1" @click="goToImageInsert(idx)">사진등록</button>
              <router-link class="nav-link" :to="{ path: '/update', query: {product_id: product.id} }">
                <button type="button" class="btn btn-warning me-1">수정</button>
              </router-link>              
              <button type="button" class="btn btn-danger" @click="delSalesList(product.id)">삭제</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </main> 
</template>

<script>
export default {
  data() {
    return {
      productList: [],
    }
  },
  methods: {
    async getProductList() {
      this.productList = await this.$get('/api/productList2', {});
      console.log(this.productList);
    },
    goToImageInsert(idx) {
      this.$store.commit('sallerSelectedProduct', this.productList[idx]);
      this.$router.push( {path: '/image_insert'} );
    },
    async delSalesList(id) {
             this.$swal.fire({
                title: '정말 삭제하시겠습니까?',
                showCancelButton: true,
                confirmButtonText: `삭제`,
                cancelButtonText: `취소`
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const result = await this.$get(`/api/delProduct/${id}`)
                    console.log(result);
                    this.getProductList();
                    this.$swal.fire('삭제되었습니다!', '', 'success');
                }
            });
        }
  },
  created() {
    this.getProductList();
  }
}
</script>

<style scoped>
  td:first-child {
    position:relative;
    width: 100px;
  }
  img {
    position:absolute;
    max-width:100%; max-height:100%;
    width:auto; height:auto;
    margin: auto;
    top:0; bottom:0; left:0; right:0;
    padding: 10px;
  }
</style>