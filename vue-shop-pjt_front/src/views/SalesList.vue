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
                    <th>추가배송비</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr :key="idx" v-for="(item, idx) in salesList">
                    <td>
                        <!-- <img v-if="product.path!=null" :src="`/download/${product.id}/${product.path}`" style="height:50px;width:auto;" /> -->
                    </td>
                    <td>{{ item.product_name }}</td>
                    <td>{{ item.product_price }}</td>
                    <td>{{ item.delivery_price }}</td>
                    <td>{{ item.add_delivery_price }}</td>
                    <td>
                        <button type="button" class="btn btn-info me-1" >사진등록</button>
                        <button type="button" class="btn btn-warning me-1" >수정</button>
                        <button type="button" class="btn btn-danger me-1" @click="delSalesList(item.id)">삭제</button>
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
            salesList: {}
        }
    },
    created() {
        this.getSalesList();
    },
    methods: {
        async getSalesList() {
            this.salesList = await this.$get('/api/productList2', {});
            console.log(this.salesList);
       },

        async delSalesList(id) {
            const result = await this.$post('/api/delProduct', id)
            console.log(result);
            this.getSalesList()
        }
    }
}
</script>

<style>

</style>