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
            <td><img src=""></td>
            <td>{{ product.product_name }}</td>
            <td>{{ product.product_price }}</td>
            <td>{{ product.delivery_price }}</td>
            <td>{{ product.add_delivery_price }}</td>
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
      productList: []
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
                    const result = await this.$post('/api/delProduct', id)
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

<style>

</style>