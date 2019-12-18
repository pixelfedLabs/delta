<template>
<div>
    <header>
    <div class="navbar navbar-expand-lg navbar-light bg-transparent">
      <div class="container d-flex justify-content-between navbar-nav mr-auto my-4">
        <a href="/" class="navbar-brand d-flex align-items-center">
          <img src="/img/logo.svg" width="40px" class="mr-2">
          <strong translated class="text-uppercase font-ptsn">pixelfed</strong>
        </a>
      </div>
    </div>
    </header>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
