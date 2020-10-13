<template>
  <form class="baseForm" :method="method" :action="action" @submit.prevent="onSubmit">
    <template v-if="htmlResponse" v-html="htmlResponse">
      <div class="baseForm__response" v-html="htmlResponse"></div>
    </template>
    <template v-else>
      <slot/>
    </template>
  </form>
</template>

<script>
  import axios from 'axios'
  import $ from 'jquery'

  export default {
    name: 'base-form',
    props: [
      'method',
      'action'
    ],
    data: function () {
      return {
        htmlResponse: ''
      }
    },
    methods: {
      onSubmit() {
        axios({
          method: this.method,
          url: this.action,
          data: $(this.$el).serialize()
        }).then(res => {
          console.log(res)
          this.htmlResponse = res.data.email
        })
      }
    }
  }
</script>

<style scoped>
  .baseForm__response
  {
    border: 3px solid #2ecc40;
    padding: 15px;
  }
</style>
