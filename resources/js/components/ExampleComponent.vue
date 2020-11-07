<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12" v-if="posts && posts.length">
                <div class="card" v-for="post of posts">
                    <div class="card-header">{{ post.title }}</div>
                    <div class="card-body">{{ post.body }}</div>
                </div>
            </div>
        </div>
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

        // Fetches posts when the component is created.
        created() {
            axios.get(`http://jsonplaceholder.typicode.com/posts`)
            .then(response => {
            // JSON responses are automatically parsed.
            this.posts = response.data
            })
            .catch(e => {
            this.errors.push(e)
            })

            // async / await version (created() becomes async created())
            //
            // try {
            //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
            //   this.posts = response.data
            // } catch (e) {
            //   this.errors.push(e)
            // }
        }
}
</script>
