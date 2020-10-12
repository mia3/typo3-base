<template>
  <form class="baseForm" :method="method" :action="action" @submit.prevent="onSubmit">
    <slot/>
  </form>
</template>

<script>
  export default {
    name: 'base-form',
    props: [
      'method',
      'action',
    ],
    data: function () {
      return {};
    },
    mounted() {
alert('foo')
    },
    methods: {
      onSubmit() {
        console.log('TODO: Send form to server and check result.');
      },
    },
  };
</script>

<style scoped>

</style>
