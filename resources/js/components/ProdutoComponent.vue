<template>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Sales</th>
                    <th>More</th>
                </tr>
            </thead>
            <tbody v-if="produtos && produtos.length">
                <tr v-for="produto of produtos">
                    <td>
                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                        {{ produtos.nome }}
                    </td>
                    <td>R$ {{ produtos.preco }}</td>
                    <td>
                        <small class="text-success mr-1">
                            <i class="fas fa-arrow-up"></i>
                            12%
                        </small>
                        12,000 Sold
                    </td>
                    <td>
                        <a href="#" class="text-muted">
                            <i class="fas fa-search"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                produtos: [],
                errors: []
            }
        },

        created() {
            axios.get(`http://localhost:8080/html/php/laravel/sis-contratos/public/index.php/api/produtos`).then(response => {
                this.produtos = response.data;
            })
            .catch(e => {
                this.errors.push(e);
            })
        }
}
</script>
