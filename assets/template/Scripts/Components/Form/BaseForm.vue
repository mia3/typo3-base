<template>
  <form class="baseForm" :method="method" :action="action" @submit.prevent="onSubmit">
    <slot/>
    <div class="baseForm__response" v-if="htmlResponse" v-html="htmlResponse"></div>
  </form>
</template>

<script>
  import axios from 'axios';

  export default {
    name: 'base-form',
    props: ['method', 'action'],
    data: function () {
      return {
        htmlResponse: ''
      };
    },
    methods: {
      onSubmit() {
        const formData = new FormData(this.$el);
        axios({
          method: this.method,
          url: this.action,
          data: formData
        }).then(res => {
          this.htmlResponse = res.data;
        }).catch(error => {
          console.log(error)
          this.htmlResponse = 'Server error. Please try again.';
        });
      }
    }
  };
</script>
