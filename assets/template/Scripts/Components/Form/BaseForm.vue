<template>
  <form class="baseForm" :method="method" :action="action" @submit.prevent="onSubmit">
    <slot/>
    <div class="baseForm__response" v-if="htmlResponse" v-html="htmlResponse"></div>
  </form>
</template>

<script>
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
        $.ajax(this.action, {
          type: this.method,
          data: $(this.$el).serialize()
        }).then(res => {
          this.htmlResponse = res.data.html;
        });
      }
    }
  };
</script>
