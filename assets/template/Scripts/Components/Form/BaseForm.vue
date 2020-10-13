<template>
  <form class="baseForm" :method="method" :action="action" @submit.prevent="onSubmit">
    <slot/>
    <div class="baseForm__response" v-if="htmlResponse" v-html="htmlResponse"></div>
  </form>
</template>

<script>
  import axios from 'axios';
  import $ from 'jquery';

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
        axios({
          method: this.method,
          url: this.action,
          data: $(this.$el).serialize()
        }).then(res => {
          this.htmlResponse = res.data.html;
        });
      }
    }
  };
</script>
