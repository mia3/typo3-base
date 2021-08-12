<template>
  <div class="baseInput">
    <input
      class="baseInput__field"
      v-model="value"
      :placeholder="placeholder"
      :name="name"
      :type="type"
      :required="required"
    >
    <div class="baseInput__border"></div>
  </div>
</template>

<script>
  export default {
    name: 'base-input',
    props: ['placeholder', 'name', 'type', 'required'],
    data: function () {
      return {
        value: ''
      };
    },
    mounted() {

    }
  };
</script>

<style lang="scss" scoped>
  @import '../../../Styles/Variables';

  .baseInput
  {
    position: relative;
  }

  .baseInput__field
  {
    background: rgba(0, 0, 0, 0.05);
    border: none;
    box-shadow: none;
    box-sizing: border-box;
    line-height: 2em;
    padding: calc(0.5rem + 1px) 1rem 0.5rem 1rem;
    transition: background-color .6s ease, box-shadow 0.5s ease-in-out;
    width: 100%;
    appearance: none;
    font-size: 1rem;
    font-family: var(--font-family);
  }

  .baseInput__field:focus
  {
    outline: 0;
  }

  .baseInput__border::after
  {
    background: transparent;
    bottom: 0;
    content: '';
    height: 3px;
    left: 50%;
    position: absolute;
    transform: translateX(-50%);
    transition: 0.4s;
    width: 0;
  }

  .baseInput__field:focus + .baseInput__border::after
  {
    background: linear-gradient(300deg, rgba(75, 17, 58, 1) 0%, rgba(26, 70, 136, 1) 100%); /* w3c */
    transition: 0.4s;
    width: 100%;
  }
</style>
