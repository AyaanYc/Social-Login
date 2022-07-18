<template>
  <main class="mt-3">
    <div class="container">
        <div class="float-end mb-1">
            <button type="button" class="btn btn-dark" @click="goToInsert">제품등록</button>
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
            <tr :key="i" v-for="(product, i) in productList"></tr>
                <td>
                    <img v-if="product.path!=null" :src="`/download/${product.id}/${product.path}`" style="height:50px;width:auto;" />
                </td>
                <td>{{product.product_name}}</td>
                <td>{{product.product_price}}</td>
                <td>{{product.delivery_price}}</td>
                <td>{{product.add_delivery_price}}</td>
                <td>
                    <button type="button" class="btn btn-info me-1" @click="goToImageInsert(product.id);">사진등록</button>
                    <button type="button" class="btn btn-warning me-1" @click="goToUpdate(product.id);">수정</button>
                    <button type="button" class="btn btn-danger me-1" @click="deleteProduct(product.id);">삭제</button>
                </td>
        </tbody>
    </table>
    </div>
  </main>
</template>

<script>
export default {

}
</script>

<style>

</style>