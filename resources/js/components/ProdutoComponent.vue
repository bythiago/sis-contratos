<template>
    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-12" v-if="posts && posts.length">
                <div class="card" v-for="post of posts">
                    <div class="card-header">{{ post.title }}</div>
                    <div class="card-body">{{ post.body }}</div>
                </div>
            </div>
        </div>
    </div> -->
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
            <tbody v-if="posts && posts.length">
                <tr v-for="post of posts">
                    <td>
                        <img src="https://adminlte.io/themes/v3/dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                        {{ post.nome }}
                    </td>
                    <td>$13 USD</td>
                    <td>
                        <small class="text-success mr-1">
                            <i class="fas fa-arrow-up"></i>
                            12%
                        </small>
                        {{ preco.preco }}
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
                posts: [],
                errors: []
            }
        },

        created() {
            axios.get(`http://localhost:8080/html/php/laravel/sis-contratos/public/index.php/api/produtos`).then(response => {
                this.posts = response.data;
            })
            .catch(e => {
                this.errors.push(e);
            })
        }
}
</script>
