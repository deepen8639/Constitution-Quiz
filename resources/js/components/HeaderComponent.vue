<template>
    <div class="container-fluid bg-dark mb-3">
        <div class="container">
            <nav class="navbar navbar-dark">
                <span class="navbar-brand mb-0 h1">Constitution Quiz</span>
                <div>
                  <router-link v-bind:to="{name: 'constitution.home'}">
                    <button class="btn btn-success">home</button>
                    </router-link>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
    export default {
      mounted() {
            console.log('HeaderComponent mounted.')
        }
    }
</script>
